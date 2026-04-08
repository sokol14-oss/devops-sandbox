<?php
$host = 'localhost';
$db   = 'social_net';
$user = 'admin_social_net'; 
$pass = 'Voper484'; 

try {
    $pdo = new PDO("mysql:host=$host;dbname=$db;charset=utf8", $user, $pass);
    // Настраиваем PDO так, чтобы он кидал ошибки, если что-то не так
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Ошибка подключения: " . $e->getMessage());
}
