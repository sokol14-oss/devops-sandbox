<!DOCTYPE html>
<html lang="ru">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Авторизация</title>
</head>

<body>
    <h3>Войти</h3>
    <form action="do_login.php" method="post" id="authForm">
        <p>Введите логин</p>
        <input type="text" name="username" required>
        <p>Ввведите пароль</p>
        <input type="password" name="password" id="pass" required>
        <button type="submit">Войти</button>
    </form>
    <div id="error-msg" style="color: red;"></div>
</body>
<script>
    const urlParams = new URLSearchParams(window.location.search);
    if (urlParams.has('error')) {
        document.getElementById('error-msg').innerText = "Неверный логин или пароль!";
    }
</script>

</html>