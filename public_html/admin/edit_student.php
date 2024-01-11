<?php
require __DIR__ . '/include/database.php';
require __DIR__ . '/include/auth.php';

$id = $_GET['id'] ?? null;

$query = "SELECT * FROM users WHERE id = $_GET[id]";
$stmt = $pdo->query($query);
$student = $stmt->fetch(PDO::FETCH_ASSOC);


$editMessage = '';
$editError = false;

if (($_SERVER['REQUEST_METHOD'] === 'POST') && isset($_POST["register"])) {

    $username = mb_substr($_POST['username'] ?? '', 0, 20);
    $password = password_hash($_REQUEST['password'], PASSWORD_BCRYPT, ['cost' => 12]);
    $level = mb_substr($_POST['level'] ?? '', 0, 10);
    $role = mb_substr($_POST['role'] ?? '', 0, 10);
    $first_name = mb_substr($_POST['first_name'] ?? '', 0, 20);
    $last_name = mb_substr($_POST['last_name'] ?? '', 0, 20);
    $date_of_birth = mb_substr($_POST['date_of_birth'] ?? '', 0, 20);
    $paid_for_classes = mb_substr($_POST['paid_for_classes'] ?? '', 0, 20);


    if (!empty($username) && !empty($password) && !empty($first_name) && !empty($last_name) && !empty($date_of_birth)) {

        try {

            $sqlInsert = "UPDATE users SET username = :username, password = :password, level = :level, role = :role, first_name = :first_name, last_name = :last_name, date_of_birth = :date_of_birth, paid_for_classes = :paid_for_classes WHERE id = :id";
            $stmt = $pdo->prepare($sqlInsert);
            $stmt->bindValue(':username', strtolower($username));
            $stmt->bindValue(':password', $password);
            $stmt->bindValue(':level', $level);
            $stmt->bindValue(':role', $role);
            $stmt->bindValue(':first_name', $first_name);
            $stmt->bindValue(':last_name', $last_name);
            $stmt->bindValue(':date_of_birth', $date_of_birth);
            $stmt->bindValue(':paid_for_classes', $paid_for_classes);
            $stmt->bindValue(':id', $id);
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
<?php require __DIR__ . '/include/navbar.php'; ?>
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
                               aria-describedby="emailHelp" minlength="1" maxlength="20" required="required"
                               value="<?php echo $student['username']; ?>">
                    </div>

                        <div class="mb-3">
                            <label for="password" class="form-label">Пароль</label>
                            <input type="password" class="form-control" id="password" name="password" minlength="1"
                                   maxlength="10" value="<?php echo $student['password']; ?>">
                        </div>
                    <div class="mb-3">
                        <span>Текущая роль: <?php echo $student['role']?></span>
                        <select class="form-select mt-2 mb-2 " name="role" id="role" required="required">
                            <option value="student">student</option>
                            <option value="teacher">teacher</option>
                        </select>
                    </div>

                    <div class="mb-3">
                        <span>Текущий уровень: <?php echo $student['level'] ?></span>
                        <select class="form-select mt-2 mb-2 " name="level" id="level" required="required">
                            <option value="A1">A1</option>
                            <option value="A2">A2</option>
                            <option value="B1">B1</option>
                            <option value="B2">B2</option>
                            <option value="C1">C1</option>
                            <option value="C2">C2</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <span>Выберите оставшееся количество занятий</span>
                        <select class="form-select mt-2 mb-2 " name="paid_for_classes" id="paid_for_classes"
                                required="required">
                            <option value="1">1</option>
                            <option value="2">2</option>
                            <option value="3">3</option>
                            <option value="4">4</option>
                            <option value="5">5</option>
                            <option value="6">6</option>
                            <option value="7">7</option>
                            <option value="8">8</option>
                        </select>
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
                    <a class="btn btn-light inline-block" href="/admin/students.php" role="button">Сброс</a>
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
