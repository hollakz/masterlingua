<?php
$username = $_SERVER['PHP_AUTH_USER'] ?? null;
$password = $_SERVER['PHP_AUTH_PW'] ?? null;

// если логин или пароль не переданы, показываем окно аутентификации
if (!isset($username, $password)) {
    header('WWW-Authenticate: Basic realm="Restricted Area"');
    header('HTTP/1.0 401 Unauthorized');
    echo 'Authentication required';
    exit;
}

// логин и пароль переданы, ищем пользователя в базе по логину
try {
    $pdo = new PDO('sqlite:/Users/pavelchervov/PhpstormProjects/masterlingua/database/database.sqlite');
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $sql = 'SELECT * FROM users WHERE username like :username';
    $statement = $pdo->prepare($sql);
    $statement->bindValue(':username', $username);
    $statement->execute();
    $userData = $statement->fetch(PDO::FETCH_ASSOC);

} catch (PDOException $e) {
    echo "Error: " . $e->getMessage();
    exit();
}

// если пользователь не найден в базе или найден, но пароль не совпадает, показываем окно аутентификации
if (!$userData || ($userData['password'] !== $password)) {
    header('WWW-Authenticate: Basic realm="Restricted Area"');
    header('HTTP/1.0 401 Unauthorized');
    echo 'Authentication required';
    exit;
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

<div class="container col-6">

</div>
<div class="container">
        <nav class="navbar bg-body-tertiary m-5">
            <div class="container-fluid">
                <a class="navbar-brand" href="/">Главная страница </a>
                <button type="button" class="btn btn-warning">Logout</button>
            </div>
        </nav>
        <div class="alert alert-success">
            Добро пожаловать, <?php echo $username ?>!
        </div>
</div>

<div class="container">

</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-HwwvtgBNo3bZJJLYd8oVXjrBZt8cqVSpeBNS5n7C8IVInixGAoxmnlMuBnhbgrkm"
        crossorigin="anonymous"></script>

</body>
</html>
