<!DOCTYPE html>
<html lang="ru">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Регистрация</title>
</head>

<body>
    <h3>Зарегистрируйтесь</h3>
    <form method="post" id="regForm" action="do_register.php">
        <p>Введите логин</p>
        <input type="text" name="username" required>

        <p>Ввведите пароль</p>
        <input type="password" name="password" id="pass" required>
        <!-- Место для вывода ошибок -->
        <div id="passError" style="color: red; font-size: 12px;"></div>

        <p>Повторите пароль</p>
        <input type="password" id="confirmPass" required>
        <p>Инвайт-код</p>
        <input type="text" name="invite" required>
        <br><br>
        <button type="submit">Зарегистрироваться</button>
    </form>

</body>
<script>
    const form = document.getElementById('regForm');
    const password = document.getElementById('pass');
    const confirmPassword = document.getElementById('confirmPass');
    s
    const passError = document.getElementById('passError');

    // Проверка сложности "на лету"
    password.addEventListener("input", function() {
        if (password.value.length < 10) {
            passError.textContent = "Пароль должен быть не менее 10 символов";
        } else if (!/\d/.test(password.value)) {
            passError.textContent = "Пароль должен содержать хотя бы одну цифру";
        } else {
            passError.textContent = ""; // Чистим, если всё ок
        }
    });

    // Подсветка совпадения
    confirmPassword.addEventListener('input', function() {
        if (password.value !== confirmPassword.value) {
            confirmPassword.style.backgroundColor = '#ffdddd';
        } else {
            confirmPassword.style.backgroundColor = '#ddffdd';
        }
    });

    // Финальная проверка при отправке
    form.addEventListener('submit', function(event) {
        let error = "";

        if (password.value.length < 10) {
            error = "Пароль слишком короткий!";
        } else if (!/\d/.test(password.value)) {
            error = "Добавьте хотя бы одну цифру!";
        } else if (password.value !== confirmPassword.value) {
            error = "Пароли не совпадают!";
        }

        if (error) {
            event.preventDefault();
            alert(error);
        }
    });
</script>

</html>