<?php
require_once "db.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = trim($_POST["username"]);
    // Хешируем пароль БЕЗ trim (пробелы в пароле могут быть важны)
    $pass = password_hash($_POST['password'], PASSWORD_DEFAULT);
    $invite = trim($_POST["invite"]);

    try {
        // 1. Проверяем логин
        $stmt = $pdo->prepare("SELECT id FROM users WHERE username = ?");
        $stmt->execute([$username]);
        if ($stmt->fetch()) {
            die("Ошибка: Пользователь с таким логином уже существует");
        }

        // 2. Проверяем инвайт
        $stmt = $pdo->prepare("SELECT id FROM applications WHERE invite_code = ? AND status = 'approved'");
        $stmt->execute([$invite]);
        $application = $stmt->fetch();

        if (!$application) {
            die("Ошибка: Неверный инвайт-код или заявка еще не одобрена");
        }

        // 3. Создаем пользователя
        $sql = "INSERT INTO users (username, password_hash, app_id) VALUES (?, ?, ?)";
        $stmt = $pdo->prepare($sql);
        // Добавляем ID заявки, чтобы связать юзера с его анкетой
        $stmt->execute([$username, $pass, $application['id']]);
        // НОВАЯ СТРОЧКА: помечаем инвайт как использованный
        $updateSql = "UPDATE applications SET status = 'used' WHERE id = ?";
        $updateStmt = $pdo->prepare($updateSql);
        $updateStmt->execute([$application['id']]);

        echo "Регистрация успешна! Теперь вы можете <a href='login.php'>войти</a>";
    } catch (PDOException $e) {
        die("Ошибка базы данных: " . $e->getMessage());
    }
} else {
    header("Location: register.php");
}
