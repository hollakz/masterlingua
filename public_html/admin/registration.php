<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet"
          integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">
    <title>Document</title>
</head>
<body>

<div class="container p-5">
    <h3 class="position-absolute top-0 start-50 translate-middle-x">Регистрация</h3>
<form action="" class="offset-md-1 position-absolute top-30 start-50 translate-middle-x" method="post">
    <div class="col-md-7 mb-3">
        <label for="username" class="form-label">E-mail</label>
        <input type="email" class="form-control" name="username"  id="username" aria-describedby="emailHelp" maxlength="20">
        <div id="emailHelp" class="form-text">Мы никогда не передадим ваш адрес электронной почты кому-либо еще.</div>
    </div>
    <div class="col-md-7 mb-3">
        <label for="password" class="form-label">Пароль</label>
        <input type="password" class="form-control" id="password" name="password">
    </div>
    <button type="submit" class="btn btn-primary" name="register">Зарегистрироваться</button>
</form>
</div>
</body>
</html>
<?php
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["register"])) {
    $username = $_POST["username"];
    $password = $_POST["password"];

    $pdo = new PDO('sqlite:C:\Users\holla\PhpstormProjects\masterlingua\database\database.sqlite');
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $sqlInsert = "INSERT INTO users (username, password) VALUES (:username, :password)";
    $stmt = $pdo->prepare($sqlInsert);
    $stmt->bindValue(':username', $username);
    $stmt->bindValue(':password', $password);
    $stmt->execute();

    $pdo = null;
    echo "Регистрация прошла успешно!";
}
?>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-HwwvtgBNo3bZJJLYd8oVXjrBZt8cqVSpeBNS5n7C8IVInixGAoxmnlMuBnhbgrkm"
        crossorigin="anonymous"></script>