<?php
$pdo = new PDO('sqlite:C:\Users\holla\PhpstormProjects\masterlingua\database\database.sqlite');
$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

$query = "SELECT * FROM users WHERE id = 7";
$stmt = $pdo->query($query);
$student = $stmt->fetch(PDO::FETCH_ASSOC);

$editMessage = '';
$editError = false;

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
            $editMessage = 'Изменения прошли успешно!';
        } catch (PDOException $e) {

            $editError = true;
            if (str_contains($e->getMessage(), 'UNIQUE')) {
                $editMessage = 'Пользователь с таким username уже существует, придумайте другой username.';
            } else {
                $editMessage = 'Ошибка , обратитесь в службу поддержки!';
            }
        }
    } else {
        $editError = true;
        $editMessage = 'Вы не заполнили все поля!';
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
    <title>Изменение данных студента</title>
</head>
<body>
<div class="container-fluid">
    <div class="row justify-content-center">
        <div class="col-12 col-md-6">

            <div class="registration pt-3">
                <h3 class="text-center">Изменение данных студента</h3>

                <?php if (!empty($editMessage)): ?>
                    <div class="alert <?php if ($editError): ?>alert-danger<?php else: ?>alert-success<?php endif; ?>"
                         role="alert">
                        <?php echo $editMessage; ?>
                        <?php if (!$editError): ?><a href="/admin">В админку</a><?php endif; ?>
                        <button type="button" class="btn-close float-end" data-bs-dismiss="alert"
                                aria-label="Close"></button>
                    </div>

                <?php endif; ?>

<form action="" method="post">
    <div class="mb-3">
        <label for="username" class="form-label">Username</label>
        <input type="text" class="form-control" name="username" id="username"
               aria-describedby="emailHelp" minlength="1" maxlength="20" required="required" value="<?php echo $student['username']; ?>">
        <div id="emailHelp" class="form-text">Мы никогда не передадим ваш адрес электронной почты
            кому-либо еще.
        </div>
    </div>
    <div class="mb-3">
        <label for="password" class="form-label">Пароль</label>
        <input type="password" class="form-control" id="password" name="password" minlength="1"
               maxlength="10" required="required" value="<?php echo $student['password']; ?>">
    </div>
    <div class="mb-3">
        <label for="first_name" class="form-label">First name</label>
        <input type="text" class="form-control" id="first_name" name="first_name" minlength="1"
               maxlength="10" required="required" value="<?php echo $student['first_name']; ?>">
    </div>
    <div class="mb-3">
        <label for="last_name" class="form-label">Last name</label>
        <input type="text" class="form-control" id="last_name" name="last_name" minlength="1"
               maxlength="10" required="required" value="<?php echo $student['last_name']; ?>">
    </div>
    <div class="mb-3">
        <label for="date_of_birth" class="form-label">Date of birth</label>
        <input type="date" class="form-control" id="date_of_birth" name="date_of_birth" minlength="1"
               maxlength="10" required="required" value="<?php echo $student['date_of_birth']; ?>">
    </div>
    <button type="submit" class="btn btn-primary" name="register">Изменить</button>
    <a class="btn btn-light inline-block" href="/admin/student.php" role="button">Сброс</a>
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
