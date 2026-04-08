<?php
require_once 'db.php';
$id = $_GET['id'] ?? null;
if ($id) {
    // 1. Получаем данные заявки одним махом
    $stmt = $pdo->prepare("SELECT status, invite_code FROM applications WHERE id = ?");
    $stmt->execute([$id]);
    $app = $stmt->fetch(PDO::FETCH_ASSOC);

    if (!$app) die("Заявка не найдена");

    if ($app['status'] === 'approved') {
        header("Location: admin.php");
        exit;
    }

    // 2. Генерируем инвайт (просто создаем его, шанс совпадения 1 на миллион)
    $invite = bin2hex(random_bytes(5));

    // 3. Обновляем базу
    $sql = "UPDATE applications SET status = 'approved', invite_code = ? WHERE id = ?";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$invite, $id]);
} else {
    // Этот блок работает, только если ID ПУСТОЙ (например, зашли на страницу просто так)
    die("Ошибка: ID не передан!");
}

// Возвращаемся в админку, чтобы увидеть результат
header("Location: admin.php");
exit;
