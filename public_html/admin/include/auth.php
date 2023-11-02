<?php

function displayAuth()
{
    header('WWW-Authenticate: Basic realm="Restricted Area"');
    header('HTTP/1.0 401 Unauthorized');
    echo "Нет доступа в админку <br> <a href='/'>Вернуться на главную страницу</a><br><a href='/admin'>Попробовать еще раз</a>";
    exit;
}

$username = $_SERVER['PHP_AUTH_USER'] ?? null;
$password = $_SERVER['PHP_AUTH_PW'] ?? null;

// если логин или пароль не переданы, показываем окно аутентификации
if (!isset($username, $password)) {
    displayAuth();
}

// логин и пароль переданы, ищем пользователя в базе по логину
try {
    $sql = 'SELECT * FROM users WHERE username like :username';
    $statement = $pdo->prepare($sql);
    $statement->bindValue(':username', $username);
    $statement->execute();
    $user = $statement->fetch(PDO::FETCH_ASSOC);
    $level = $user['level'];

} catch (PDOException $e) {
    echo "Error: " . $e->getMessage();
    exit();
}

// если пользователь не найден в базе или найден, но пароль не совпадает, показываем окно аутентификации
if (!$user || ($user['password'] !== $password)) {
    displayAuth();
}
