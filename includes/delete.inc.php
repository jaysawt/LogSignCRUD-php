<?php

if ($_SERVER['REQUEST_METHOD']==="POST"){
    $id = $_POST['deleteId'];
    
    require "dbh.inc.php";

    $query = "DELETE FROM people WHERE id=:id;";
    $stmt = $pdo->prepare($query);
    $stmt->bindParam(":id", $id);
    $stmt->execute();
    
    $pdo=null;
    $stmt=null;    
    header("Location: ../index.php?delete=success");
    die();

}else{
    header("Location: ../index.php");
    die();
}