<? session_start(); // Включаем работу с сессиями
// Если в сессии уже есть ID пользователя, значит он залогинен
if (isset($_SESSION['user_id'])) {
    header("Location: /social/feed.php"); // Улетает в соцсеть
    exit;
}

// Если кода выше не сработало, PHP пойдет дальше и покажет HTML ниже
?>
<!DOCTYPE html>
<html lang="ru">

<head>
    <meta charset="UTF-8">
    <title>Вступить в сообщество</title>
</head>

<body>
    <h1>Подать заявку на доступ</h1>
    <form id="mainForm" action="send_app.php" method="POST">
        <p>Ваше полное имя: <input type="text" name="full_name" required></p>
        <p>Телеграм: <input type="text" name="telegram" required></p>
        <p>Почему вы хотите к нам? <br>
            <textarea name="about" rows="5" cols="30" required></textarea>
        </p>
        <button type="submit">Отправить заявку</button>
    </form>
</body>

</html>

<script>
    // Находим все инпуты и текстовые области
    const form = document.getElementById('mainForm');
    const inputs = document.querySelectorAll('#mainForm input, #mainForm textarea');
    // Для каждого поля вешаем слушатель "потери фокуса" (blur)
    inputs.forEach(input => {
        input.addEventListener('blur', function() {
            this.value = this.value.trim();
            console.log('Пробелы убраны в поле:', this.name); // Для проверки в консоли
        });
    });
    form.addEventListener('submit', function(event) {
        let hasError = false;
        inputs.forEach(input => {
            if (input.value === "") {
                hasError = true;
                input.style.borderColor = 'red'; // Подсветим поле красным
            } else {
                input.style.borderColor = ''; // Сбросим цвет, если всё ок

            }
        });
        if (hasError) {
            event.preventDefault();
            alert('Пожалуйста, заполните все обязательные поля.');
        }
    });
</script>