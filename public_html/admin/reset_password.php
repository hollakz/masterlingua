<?php
require __DIR__ . '/include/database.php';

// Проверка наличия параметра id или email в запросе
if(isset($_GET['id']) && is_numeric($_GET['id'])) {
    $user_id = $_GET['id'];
    $sql = "SELECT * FROM users WHERE id = $user_id";
} elseif(isset($_GET['email'])) {
    $email = $_GET['email'];
    $sql = "SELECT * FROM users WHERE email = '$email'";
} else {
    echo "Ошибка: Неверные параметры запроса.";
    exit;
}

$result = $pdo->query($sql);

if($result->rowCount() == 0) {
    echo "Пользователь не найден.";
} else {
    // Пользователь найден, показываем форму для ввода нового пароля
    if(isset($_POST['new_password'])) {
        $new_password = $_POST['new_password'];
        // Хэшируем новый пароль перед сохранением в базу данных
        $hashed_password = password_hash($new_password, PASSWORD_DEFAULT);

        // Обновляем пароль пользователя в базе данных
        $update_sql = "UPDATE users SET password = '$hashed_password' WHERE id = $user_id";
        $pdo->query($update_sql);

        echo "Пароль успешно изменен.";
    } else {
        ?>
        <form method="post">
            <label for="new_password">Введите новый пароль:</label>
            <input type="password" id="new_password" name="new_password" required>
            <button type="submit">Изменить пароль</button>
        </form>
        <?php
    }
}
?>

