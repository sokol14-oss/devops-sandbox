<?php
require_once 'db.php';
$sql = "SELECT * FROM applications ORDER BY created_at DESC";
$stmt = $pdo->query($sql);
$apps = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>
<!DOCTYPE html>
<html lang="ru">

<head>
    <meta charset="UTF-8">
    <title>Панель управления заявками</title>
</head>

<body>
    <h1>Список заявок на вступление</h1>
    <table>
        <tr>
            <th>ID</th>
            <th>Имя</th>
            <th>Telegram</th>
            <th>О себе</th>
            <th>Дата</th>
            <th>Статус</th>
            <th>Действие</th>
            <th>Инвайт</th>
        </tr>
        <?php foreach ($apps as $app): ?>
            <tr>
                <td><?= $app['id'] ?></td>
                <td><?= htmlspecialchars($app['full_name']) ?></td>
                <td><a href="https://t.me/<?= str_replace('@', '', $app['telegram']) ?>" target="_blank">
                        <?= htmlspecialchars($app['telegram']) ?>
                    </a></td>
                <td><?= nl2br(htmlspecialchars($app['about_text'])) ?></td>
                <td><?= $app['created_at'] ?></td>
                <td><?= $app['status'] ?></td>
                <td><?php if ($app["status"] === "pending"): ?>
                        <a href="approve.php?id=<?= $app['id'] ?>">Одобрить</a>
                    <?php else: ?>
                        <span style="color: #28a745; font-weight: bold;">✅ Одобрено</span>
                    <?php endif; ?>
                </td>
                <td>
                    <?php if ($app["invite_code"]): ?>
                        <?= htmlspecialchars($app["invite_code"]) ?>
                    <?php else: ?>
                        <span>нет инвайта</span>
                    <?php endif; ?>
                </td>

            </tr>
        <?php endforeach; ?>
    </table>
    <?php if (empty($apps)): ?>
        <p>Заявок пока нет :(</p>
    <?php endif; ?>
</body>

</html>