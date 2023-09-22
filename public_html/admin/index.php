<?php
$email = $_SERVER['PHP_AUTH_USER'] ?? null;
$password = $_SERVER['PHP_AUTH_PW'] ?? null;

$db = new SQLite3('C:/Users/holla/PhpstormProjects/masterlingua/database/database.sqlite');

$email = 'paulchervov';
$statement = $db->prepare("SELECT * FROM users WHERE email = :sql");
$statement->bindValue(':email', '$sql');
$result = $statement->execute();                                                                                                                                                                       $user = $result->fetchArray(SQLITE3_ASSOC);
//$userData = $result->fetchArray(SQLITE3_ASSOC);
var_dump($sql);
exit;



if (isset($users[$email]) && $users[$email] === $password) {

} else {
    header('WWW-Authenticate: Basic realm="My Realm"');
    header('HTTP/1.0 401 Unauthorized');
    echo "<div>Нет доступа в админку.<br>
            <a href='/admin/index.php'>Попробовать еще раз</a><br>
            <a href='/'>На главную</a>
        </div>";
    exit;
}
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
    <?php
    echo "<h1>Добро пожаловать в личный кабинет!</h1>";
    ?>
</div>
<div class="container">
    <nav class="navbar bg-body-tertiary m-5">
        <div class="container-fluid">
            <a class="navbar-brand" href="/">Главная страница </a>
            <button type="button" class="btn btn-warning">Logout</button>
        </div>
    </nav>
</div>

<div class="container">
    <div class="row">
        <div class="col">
            <div class="card">
                <img src="..." class="card-img-top" alt="...">

                <div class="card-body">
                    <h5 class="card-title">Card title</h5>
                    <p class="card-text">Some quick example text to build on the card title and make up the bulk of the
                        card's content.</p>
                    <a href="#" class="btn btn-primary">Go somewhere</a>
                </div>
            </div>
        </div>
        <div class="col">
            <div class="card">
                <img src="..." class="card-img-top" alt="...">

                <div class="card-body">
                    <h5 class="card-title">Card title</h5>
                    <p class="card-text">Some quick example text to build on the card title and make up the bulk of the
                        card's content.</p>
                    <a href="#" class="btn btn-primary">Go somewhere</a>
                </div>
            </div>
        </div>
        <div class="col">
            <div class="card">
                <img src="..." class="card-img-top" alt="...">

                <div class="card-body">
                    <h5 class="card-title">Card title</h5>
                    <p class="card-text">Some quick example text to build on the card title and make up the bulk of the
                        card's content.</p>
                    <a href="#" class="btn btn-primary">Go somewhere</a>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-HwwvtgBNo3bZJJLYd8oVXjrBZt8cqVSpeBNS5n7C8IVInixGAoxmnlMuBnhbgrkm"
        crossorigin="anonymous"></script>

</body>
</html>