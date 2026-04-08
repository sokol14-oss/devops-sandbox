<?php
session_start();
session_destroy(); // Очищаем все данные сессии
header("Location: login.php"); // Выкидываем на вход
exit;
