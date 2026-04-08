<?php
session_start();
require_once "db.php";
$login = trim($_POST["username"]);
$pass = $_POST["password"];
$stmt = $pdo->prepare("SELECT id, username, password_hash FROM users WHERE username = ?");
$stmt->execute([$login]);
$user = $stmt->fetch(PDO::FETCH_ASSOC);
if (!$user["username"]) {
    die("Пользователь в базе не найден!");
}
if (!password_verify($pass, $user["password_hash"])) {
    die("Пароль не подошел к хешу!");
}
if ($user && password_verify($pass, $user["password_hash"])) {
    $_SESSION["user_id"] = $user["id"];
    $_SESSION["username"] = $user["username"];
    header("Location: feed.php");
    exit;
} else {
    header("Location: login.php?error=1");
    exit;
}
