<?php
require __DIR__ . '/include/database.php';
$hasError = false;

$username = $_POST['username'] ?? null;
$password = $_POST['password'] ?? null;


if (($_SERVER['REQUEST_METHOD'] === 'POST')) {

    $username= trim($username);
    $password= trim($password);

    if (empty($username) || empty($password)) {
        $errorText = "вы не заполнили password или username";
        $hasError = true;
    } else {
        try {
            $sql = 'SELECT username, password FROM users WHERE username like :username';
            $statement = $pdo->prepare($sql);
            $statement->bindValue(':username', $username);
            $statement->execute();
            $user = $statement->fetch(PDO::FETCH_ASSOC);
            if (!$user || !password_verify($password, $user['password'])) {
                $hasError =true;
                $errorText = "Пользователь с таким username не найден или password введен не правильно. ";
            } else {
                // авторизация прошла успешно
                session_start();
                $_SESSION['username'] = $username;
                header('Location: ./index.php');
            }
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
        }
    }
}
?>

<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Авторизация</title>
    <!-- Подключаем стили Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet"
          integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">
</head>
<body>

<!-- Форма для ввода логина и пароля -->
<div class="container">
    <div class="row justify-content-center">
        <div class="col-sm-8 col-md-6 col-lg-4 pt-5">
            <?php if ($hasError): ?>
                <div class="alert alert-danger" role="alert">
                    <?php echo $errorText; ?>
                </div>
            <?php endif; ?>
            <form class="form-signin" method="post">
                <h2 class="form-signin-heading text-center">Authorization</h2>
                <label for="inputUsername" class="sr-only mb-2">Login</label>
                <input type="text" id="inputUsername" name="username" class="form-control" placeholder="Логин" required autofocus>
                <label for="inputPassword" class="sr-only mt-2 mb-2">Password</label>
                <input type="password" id="inputPassword" name="password" class="form-control" placeholder="Пароль" required>
                <button class="btn btn-primary btn-block mt-3" type="submit">Enter</button>
                <a class="btn btn-light inline-block mt-3 d-md-inline-block" href="./login.php" role="button">Reset</a>
            </form>
        </div>
    </div>
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-HwwvtgBNo3bZJJLYd8oVXjrBZt8cqVSpeBNS5n7C8IVInixGAoxmnlMuBnhbgrkm"
        crossorigin="anonymous"></script>
</body>
</html>