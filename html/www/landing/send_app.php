<?php
require_once 'db.php'; // Подключаем базу

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // 1. Получаем данные и обрезаем пробелы (как мы учили)
    $name  = trim($_POST['full_name'] ?? '');
    $tg    = trim($_POST['telegram'] ?? '');
    $about = trim($_POST['about'] ?? '');

    // 2. Проверяем на пустоту
    if (empty($name) || empty($tg) || empty($about)) {
        die("Ошибка: Все поля должны быть заполнены. <a href='index.php'>Назад</a>");
    }

    // 3. Записываем в базу (блок try-catch)
    try {
        $checkSql = "SELECT id FROM applications WHERE telegram = ?";
        $checkStmt = $pdo->prepare($checkSql);
        $checkStmt->execute([$tg]);
        if ($checkStmt->fetch()) {
            die("Ошибка: Заявка с таким Telegram уже подана! Ожидайте решения.");
            header("Location: index.php");
            exit();
        }
        $sql = "INSERT INTO applications (full_name, telegram, about_text) VALUES (?, ?, ?)";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([$name, $tg, $about]);

        // 4. Перенаправляем на страницу благодарности
        header("Location: thanks.html");
        exit();
    } catch (PDOException $e) {
        // Если база выдаст ошибку (например, нет таблицы)
        die("Ошибка базы данных: " . $e->getMessage());
    }
} else {
    // Если зашли на страницу просто так (GET-запрос)
    header("Location: index.php");
    exit();
}
