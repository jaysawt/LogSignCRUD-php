<?php

$dsn = "mysql:host=localhost;dbname=users";
$dbusername = "root";
$dbpassword = "";


try {
    $pdo = new PDO($dsn,$dbusername,$dbpassword);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    echo "Could not connect to database because of ". $e;
}



/*$sql = "CREATE TABLE IF NOT EXISTS people (
                id INT(11) AUTO_INCREMENT PRIMARY KEY,
                username VARCHAR(50) NOT NULL,
                email VARCHAR(100) NOT NULL,
                password VARCHAR(255) NOT NULL
            )";


$stmt = $pdo->prepare($sql);
$stmt->execute();*/