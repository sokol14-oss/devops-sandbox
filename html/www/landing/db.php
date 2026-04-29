<?php
$host = "db";
$db   = getenv('DB_NAME');
$user = getenv('DB_USER'); 
$pass = getenv('PASSWORD_USER'); 

try {
    $pdo = new PDO("mysql:host=$host;dbname=$db;charset=utf8", $user, $pass);
    // Настраиваем PDO так, чтобы он кидал ошибки, если что-то не так
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Ошибка подключения: " . $e->getMessage());
}
