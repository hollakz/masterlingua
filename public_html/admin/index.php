<?php
$username = $_SERVER['PHP_AUTH_USER'] ?? null;
$password = $_SERVER['PHP_AUTH_PW'] ?? null;

function displayAuth()
{
    header('WWW-Authenticate: Basic realm="Restricted Area"');
    header('HTTP/1.0 401 Unauthorized');
    echo "Нет доступа в админку <br> <a href='/'>Вернуться на главную страницу</a><br><a href='/admin'>Попробовать еще раз</a>";
    exit;
}

// если логин или пароль не переданы, показываем окно аутентификации
if (!isset($username, $password)) {
    displayAuth();
}

// логин и пароль переданы, ищем пользователя в базе по логину
try {
    $pdo = new PDO('sqlite:C:\Users\holla\PhpstormProjects\masterlingua\database\database.sqlite');
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $sql = 'SELECT * FROM users WHERE username like :username';
    $statement = $pdo->prepare($sql);
    $statement->bindValue(':username', $username);
    $statement->execute();
    $userData = $statement->fetch(PDO::FETCH_ASSOC);
    $level = $userData['level'];


} catch (PDOException $e) {
    echo "Error: " . $e->getMessage();
    exit();
}


// если пользователь не найден в базе или найден, но пароль не совпадает, показываем окно аутентификации
if (!$userData || ($userData['password'] !== $password)) {
    displayAuth();
}

// если мы дошли до этой точки, аутентификация пройдена успешно
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet"
          integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">
    <title>TEST BOOTSTRAP ADMIN</title>
</head>
<body class="page-title">
<nav class="navbar navbar-expand-lg bg-body-tertiary">
    <div class="container-fluid">
        <a class="navbar-brand" href="/">Главная страница </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                <li class="nav-item">
                    <span class="nav-link active" aria-current="page" >Ваш уровень: <?php echo $level ?></span>
                </li>
            </ul>
        </div>
    </div>
</nav>
<div class="title m-2">
    <div class="alert alert-success">
        Добро пожаловать, <?php echo $username ?>, ваш уровень: <?php echo $level ?>.
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-HwwvtgBNo3bZJJLYd8oVXjrBZt8cqVSpeBNS5n7C8IVInixGAoxmnlMuBnhbgrkm"
        crossorigin="anonymous"></script>

</body>
</html>
