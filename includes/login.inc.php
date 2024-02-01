<?php
if ($_SERVER['REQUEST_METHOD']==="POST"){
    $username = $_POST['loginUsername'];
    $pwd = $_POST['loginPassword'];
    
    try {

        require_once "dbh.inc.php";
        // ERROR HANDLERS

        $errors = [];

        if (is_input_empty($username, $pwd)){
            $errors["empty_input"] = "Fill in all the fields!";
        }

        $result = get_user($username);

        if (is_username_wrong($result)){
            $errors["login_incorrect"] = "Incorrect username! If not signed in please sign in first";
        }

        if (!is_username_wrong($result) && is_password_wrong($pwd, $result["pwd"])){
            $errors["pwd_incorrect"] = "Incorrect password!";       
        }
        
        
        require_once "config_session.inc.php";

        if($errors){
            $_SESSION["errors_login"] = $errors;
            foreach($errors as $error){
                if ($error == 'Incorrect username! If not signed in please sign in first'){
                    header("Location: ../signup.php");
                    die();
                }else{
                    header("Location: ../login.php");
                    die();
                }
                
            }
            
            
        }

        $newSessionId = session_create_id();
        $sessionId = $newSessionId . "_" . $result["id"];
        session_id($sessionId);

        $_SESSION["user_id"] = $result["id"];
        $_SESSION["user_username"] = htmlspecialchars($result["username"]);
        $_SESSION['last_regeneration'] = time();

        header("Location: ../index.php?login=success");

        $pdo = null;
        $stmt = null;

        die();

        
    } catch (PDOException $e) {
        die("Query failed: ".$e->getMessage());
    }


}else{
    header("Location: ../index.php");
    die();
}

function is_input_empty($username, $pwd){
    if (empty($username) || empty($pwd)){
        return true;
    }else{
        return false;
    }
}

function get_user($username){
    global $pdo;
    $query = "SELECT * FROM people WHERE username = :username;"; 
    $stmt = $pdo->prepare($query);
    $stmt->bindParam(":username", $username);
    $stmt->execute();

    $result = $stmt->fetch(PDO::FETCH_ASSOC);   
    return $result;
}

function is_username_wrong($result){
    if (!$result){
        return true;
    }else{
        return false;
    }
}


function is_password_wrong($pwd, $hashedPwd){
    if (!password_verify($pwd, $hashedPwd)){
        return true;
    }else{
        return false;
    }
}