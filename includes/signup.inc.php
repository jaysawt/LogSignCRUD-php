<?php


if ($_SERVER["REQUEST_METHOD"]==="POST"){
    $username = $_POST['signupUsername'];
    $email = $_POST['signupUseremail'];
    $pwd = $_POST['signupPassword'];

    try {
        require_once "dbh.inc.php";
        // ERROR HANDLERS
        $errors = [];

        if (input_is_empty($username, $email, $pwd)){
            $errors["empty_input"] = "Fill in all the fields!";
        }
        if (is_email_invalid($email)){
            $errors["invalid_email"] = "Invalid Email used!";
        }
        if (is_username_taken($username)){
            $errors["username_taken"] = "Username already taken!";
        }
        if (is_email_registered($email)){
            $errors["email_used"] = "Email already registered!";
        }

        require_once "config_session.inc.php";

        if($errors){
            $_SESSION["error_signup"] = $errors;
            $signupData = [
                "username" => $username,
                "email" => $email
            ];

            $_SESSION["signup_data"] = $signupData;

            header("Location: ../signup.php");
            die();
        }

        create_user($username, $email, $pwd);

        header("Location: ../login.php?signup=success");
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


function input_is_empty($username, $email, $pwd){
    if (empty($username) || empty($email) || empty($pwd)){
        return true;
    }else{
        return false;
    }
}


function is_email_invalid($email){
    if(!filter_var($email, FILTER_VALIDATE_EMAIL)){
        return true;
    }else{
        return false;
    }
}

function is_username_taken($username){
    if(find_username($username)){
        return true;
    }else{
        return false;
    }
}

function is_email_registered($email){
    if(find_email($email)){
        return true;
    }else{
        return false;
    }

}

function find_username($username){
    global $pdo;
    $query = "SELECT username FROM people WHERE username = :username;";
    $stmt = $pdo->prepare($query);
    $stmt->bindParam(":username", $username);
    $stmt->execute();

    $result = $stmt->fetch(PDO::FETCH_ASSOC);
    return $result;
}

function find_email($email){
    global $pdo;
    $query = "SELECT email FROM people WHERE email = :email;";
    $stmt = $pdo->prepare($query);
    $stmt->bindParam(":email", $email);
    $stmt->execute();

    $result = $stmt->fetch(PDO::FETCH_ASSOC);
    return $result;
}


function create_user($username, $email, $pwd){
    global $pdo;
    $query = "INSERT INTO people (username, email, pwd) VALUES(:username,:email,:pwd);";
    $stmt = $pdo->prepare($query);
    $stmt->bindParam(":username", $username);
    $stmt->bindParam(":email", $email);
    $options = [
        'cost' => 12
    ];
    $hashed_pwd = password_hash($pwd,PASSWORD_BCRYPT,$options);
    $stmt->bindParam(":pwd", $hashed_pwd);
    $stmt->execute();
}