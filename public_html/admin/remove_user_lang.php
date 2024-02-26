<?php
require __DIR__ . '/include/database.php';
require __DIR__ . '/include/auth.php';

$id = isset($_GET['id']) ? intval($_GET['id']) : null;

if ($id) {
    // Подготовленный запрос для удаления записи из таблицы user_lang
    $sql = "DELETE FROM user_lang WHERE id = ?";

    // Подготовка и выполнение запроса
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$id]);

    // Перенаправление на страницу, откуда был отправлен запрос
    header('Location: ' . $_SERVER['HTTP_REFERER']);
    exit();
} else {
    echo 'Неверный или отсутствующий идентификатор пользователя';
};
?>
