<?php

if ($_SERVER['REQUEST_METHOD']==="POST"){
    $id = $_POST['idEdit'];
    $username = $_POST['usernameEdit'];
    
    require "dbh.inc.php";

    if (is_input_empty($username)){
            echo '<script type="text/javascript">
              alert("Username cannot be kept empty!");
              window.location.href = "../index.php";
                </script>';
            exit();
        }

    $query = "UPDATE people SET username=:username WHERE id=:id;";
    $stmt = $pdo->prepare($query);
    $stmt->bindParam(":username", $username);
    $stmt->bindParam(":id", $id);
    $stmt->execute();
    
    require "config_session.inc.php";
    $pdo=null;
    $stmt=null;    
    header("Location: ../index.php?update=success");
    die();

}else{
    header("Location: ../index.php");
    die();
}

function is_input_empty($username){
    if (empty($username)){
        return true;
    }else{
        return false;
    }
}