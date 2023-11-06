<?php
require __DIR__ . '/include/database.php';

$registrationMessage = '';
$registrationError = false;

if (($_SERVER['REQUEST_METHOD'] === 'POST') && isset($_POST["register"])) {

    $username = mb_substr($_POST['username'] ?? '', 0, 20);
    $password = mb_substr($_POST['password'] ?? '', 0, 10);
    $first_name = mb_substr($_POST['first_name'] ?? '', 0, 20);
    $last_name = mb_substr($_POST['last_name'] ?? '', 0, 20);
    $date_of_birth = mb_substr($_POST['date_of_birth'] ?? '', 0, 20);

    if (!empty($username) && !empty($password) && !empty($first_name) && !empty($last_name) && !empty($date_of_birth)) {

        try {

            $sqlInsert = "INSERT INTO users (username, password, level, role, first_name, last_name, date_of_birth) VALUES (:username, :password, :level, :role, :first_name, :last_name, :date_of_birth)";
            $stmt = $pdo->prepare($sqlInsert);
            $stmt->bindValue(':username', strtolower($username));
            $stmt->bindValue(':password', $password);
            $stmt->bindValue(':level', 'A1');
            $stmt->bindValue(':role', 'student');
            $stmt->bindValue(':first_name', $first_name);
            $stmt->bindValue(':last_name', $last_name);
            $stmt->bindValue(':date_of_birth', $date_of_birth);
            $stmt->execute();
            $registrationMessage = 'Регистрация прошла успешно!';
        } catch (PDOException $e) {

            $registrationError = true;
            if (str_contains($e->getMessage(), 'UNIQUE')) {
                $registrationMessage = 'Пользователь с таким username уже существует, придумайте другой username.';
            } else {
                $registrationMessage = 'Ошибка регистрации, обратитесь в службу поддержки!';
            }
        }
    } else {
        $registrationError = true;
        $registrationMessage = 'Вы не заполнили все поля!';
    }
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
    <title>Админка. Регистрация.</title>
</head>
<body>

<div class="container-fluid">
    <div class="row justify-content-center">
        <div class="col-12 col-md-6">

            <div class="registration pt-3">
                <h3 class="text-center">Регистрация</h3>

                <?php if (!empty($registrationMessage)): ?>
                    <div class="alert <?php if ($registrationError): ?>alert-danger<?php else: ?>alert-success<?php endif; ?>"
                         role="alert">
                        <?php echo $registrationMessage; ?>
                        <?php if (!$registrationError): ?><a href="/admin">В админку</a><?php endif; ?>
                        <button type="button" class="btn-close float-end" data-bs-dismiss="alert"
                                aria-label="Close"></button>
                    </div>

                <?php endif; ?>

                <form action="" method="post">
                    <div class="mb-3">
                        <label for="username" class="form-label">Username</label>
                        <input type="text" class="form-control" name="username" value="<?php echo isset($_POST['username']) ? $_POST['username'] : ''; ?>" id="username"
                               aria-describedby="emailHelp" minlength="1" maxlength="20" required="required" >
                        <div id="emailHelp" class="form-text">Мы никогда не передадим ваш адрес электронной почты
                            кому-либо еще.
                        </div>
                    </div>
                    <div class="mb-3">
                        <label for="password" class="form-label">Пароль</label>
                        <input type="password" class="form-control" id="password" name="password" minlength="1"
                               maxlength="10" required="required" value="<?php echo isset($_POST['password']) ? $_POST['password'] : ''; ?>">
                    </div>
                    <div class="mb-3">
                        <label for="first_name" class="form-label">First name</label>
                        <input type="text" class="form-control" id="first_name" name="first_name" minlength="1"
                               maxlength="10" required="required" value="<?php echo isset($_POST['first_name']) ? $_POST['first_name'] : ''; ?>">
                    </div>
                    <div class="mb-3">
                        <label for="last_name" class="form-label">Last name</label>
                        <input type="text" class="form-control" id="last_name" name="last_name" minlength="1"
                               maxlength="10" required="required" value="<?php echo isset($_POST['last_name']) ? $_POST['last_name'] : ''; ?>">
                    </div>
                    <div class="mb-3">
                        <label for="date_of_birth" class="form-label">Date of birth</label>
                        <input type="date" class="form-control" id="date_of_birth" name="date_of_birth" minlength="1"
                               maxlength="10" required="required" value="<?php echo isset($_POST['date_of_birth']) ? $_POST['date_of_birth'] : ''; ?>">
                    </div>
                    <button type="submit" class="btn btn-primary" name="register">Зарегистрироваться</button>
                    <a class="btn btn-light inline-block" href="/admin/registration.php" role="button">Сброс</a>
                </form>

            </div>
        </div>
    </div>
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-HwwvtgBNo3bZJJLYd8oVXjrBZt8cqVSpeBNS5n7C8IVInixGAoxmnlMuBnhbgrkm"
        crossorigin="anonymous"></script>
</body>
</html>