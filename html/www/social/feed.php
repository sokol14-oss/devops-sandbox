<?php
session_start();
require_once "db.php";
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit;
}
$stmt = $pdo->prepare("SELECT username FROM users WHERE id = ?");
$stmt->execute([$_SESSION['user_id']]);
$me = $stmt->fetchColumn();
?>
<h1>Привет, <?= htmlspecialchars($me) ?>! ✨</h1>
<a href="logout.php">Выйти</a>
<hr>
<form method="post" id="messageForm" action="send_message.php">
    <textarea name="message" placeholder="опубликовать"></textarea>
    <button type="submit">Отправить</button>
</form>
<hr>

<h3>Лента сообщений:</h3>

<?php
$sql = "SELECT * FROM messages JOIN users on messages.user_id=users_id";
