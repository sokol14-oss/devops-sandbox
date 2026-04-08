<!DOCTYPE html>
<html lang="ru">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Наша сеть</title>
</head>

<body>
    <div class="box">
        <h1>Добро пожаловать в безопасное пространство! 🌈</h1>
        <p>Ваш внутренний IP: <?php echo $_SERVER['REMOTE_ADDR']; ?></p>
        <p>Если вы это видите — значит, WireGuard работает идеально.</p>
        <hr>
        <a href="register.php" style="color: #ff4081; font-weight: bold;">Создать аккаунт в соцсети</a>
    </div>
</body>

</html>