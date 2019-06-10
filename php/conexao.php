<?php

function conectarBD(){
    try {
        $pdo = new PDO('mysql:host=localhost;dbname=biblioteca', 'root', '');
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    } catch(PDOException $e) {
        exit();
    }
    return $pdo;
}
?>