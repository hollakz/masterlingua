<?php
require __DIR__ . '/include/database.php';
require __DIR__ . '/include/auth.php';

if (!in_array($user['role'], ['admin', 'teacher'])) {
    exit('Ошибка: у вас нет доступа к этой странице.');
}

$id = $_GET['id'] ?? null;
if (!$id) {
    exit('Ошибка: неверный идентификатор страницы.');
}

$query = "SELECT * FROM users WHERE id = $_GET[id]";
$stmt = $pdo->query($query);
$student = $stmt->fetch(PDO::FETCH_ASSOC);

// Вывод языков для студентов.
$languages = $pdo->query('SELECT * FROM languages')->fetchAll(PDO::FETCH_ASSOC);

// Вывод уровней для студентов.
$levels = $pdo->query('SELECT * FROM levels')->fetchAll(PDO::FETCH_ASSOC);

//Вывод назначенных заданий.

$paids = $pdo->query('SELECT * FROM paid_for_classes')->fetchAll(PDO::FETCH_ASSOC);

$editMessage = '';
$editError = false;

if (($_SERVER['REQUEST_METHOD'] === 'POST') && isset($_POST["register"])) {

    $username = mb_substr($_POST['username'] ?? '', 0, 20);
    $password = isset($_POST['password']) ? password_hash($_POST['password'], PASSWORD_BCRYPT, ['cost' => 12]) : null;
    $levelId = mb_substr($_POST['level_id'] ?? '', 0, 10);
    $langId = mb_substr($_POST['lang_id'] ?? '', 0, 10);
    $quantId = mb_substr($_POST['quant_id'] ?? '', 0,10);
    $role = mb_substr($_POST['role'] ?? '', 0, 10);
    $first_name = mb_substr($_POST['first_name'] ?? '', 0, 20);
    $last_name = mb_substr($_POST['last_name'] ?? '', 0, 20);
    $date_of_birth = mb_substr($_POST['date_of_birth'] ?? '', 0, 20);
    $paid_for_classes = mb_substr($_POST['paid_for_classes'] ?? '', 0, 20);

    if (
        (($user['role'] === 'admin') && (!empty($username) && !empty($password) && !empty($levelId) && !empty($langId) && !empty($role) && !empty($first_name) && !empty($last_name) && !empty($date_of_birth) && !empty($paid_for_classes) && !empty($quantId)))
        ||
        (($user['role'] === 'teacher') && (!empty($username) && !empty($levelId) && !empty($langId) && !empty($quantId) && !empty($first_name) && !empty($last_name) && !empty($date_of_birth) && !empty($paid_for_classes)))
    ) {

        try {
            $sqlAdmin = ($user['role'] === 'admin') ? 'password = :password, role = :role,' : '';

            $sqlInsert = "UPDATE users SET username = :username, {$sqlAdmin} first_name = :first_name, last_name = :last_name, date_of_birth = :date_of_birth, paid_for_classes = :paid_for_classes WHERE id = :id";
            $stmt = $pdo->prepare($sqlInsert);
            $stmt->bindValue(':username', strtolower($username));
            if ($user['role'] === 'admin') {
                $stmt->bindValue(':password', $password);
                $stmt->bindValue(':role', $role);
            }
            $stmt->bindValue(':first_name', $first_name);
            $stmt->bindValue(':last_name', $last_name);
            $stmt->bindValue(':date_of_birth', $date_of_birth);
            $stmt->bindValue(':paid_for_classes', $paid_for_classes);
            $stmt->bindValue(':id', $id);
            $stmt->execute();

            // Сохраняем уровни
            $stmt= $pdo->prepare('INSERT INTO user_lang (user_id, lang_id, level_id, quant_id) VALUES (:userId , :langId, :levelId, :quant_id)');
            $stmt->bindValue('userId', $_GET['id']);
            $stmt->bindValue('langId', $langId);
            $stmt->bindValue('levelId', $levelId);
            $stmt->bindValue('quant_id', $quantId);
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

$stmt = $pdo->prepare('SELECT ul.id, lng.name AS language_name, lvl.name AS level_name, pfc.quantity AS quantity 
FROM user_lang ul
JOIN languages lng ON ul.lang_id = lng.id
JOIN levels lvl ON ul.level_id = lvl.id
JOIN paid_for_classes pfc ON ul.quant_id = pfc.id
WHERE user_id = :id');
$stmt->bindParam(':id', $id, PDO::PARAM_INT);
$stmt->execute();
$lngLvls = $stmt->fetchAll(PDO::FETCH_ASSOC);


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
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.2/font/bootstrap-icons.min.css">
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
                        <?php if (!$editError): ?><a href="/admin/students.php">К списку студентов</a><?php endif; ?>
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
                    <?php if (in_array($user['role'], ['admin'])): ?>
                        <div class="mb-3">
                            <label for="password" class="form-label">Пароль</label>
                            <input type="password" class="form-control" id="password" name="password" minlength="1"
                                   maxlength="10" value="<?php echo $student['password']; ?>">
                        </div>
                        <div class="mb-3">
                            <span>Роли</span>
                            <br>
                            <span>Текущая роль: <?php echo $student['role'] ?></span>
                            <select class="form-select mt-2 mb-2 " name="role" id="role" required="required">
                                <option value="student">student</option>
                                <option value="teacher">teacher</option>
                            </select>
                        </div>
                    <?php endif; ?>

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
                    <h4>Уровни языка</h4>
                    <div class="mb-3">
                        <label class="mt-2 mb-2">
                            <?php foreach ($lngLvls as $lngLvl): ?>
                                <p>
                                    <?php echo $lngLvl['language_name']. ' ' . $lngLvl['level_name']. ' ' . $lngLvl['quantity'] ?>
                                    <a href="./remove_user_lang.php?id=<?php echo $lngLvl['id']; ?>" class="btn btn-link"><i class="bi bi-x"></i></a>
                                </p>
                            <?php endforeach; ?>
                        </label>
                    </div>
                    <h4>Добавить уровень языка</h4>
                    <div class="mb-3">
                        <span>Language</span>
                        <select class="form-select mt-2 mb-2 " name="lang_id" id="langId" required="required">
                            <?php foreach ($languages as $language): ?>
                                <option value="<?php echo $language['id']?>" selected><?php echo $language['name'] ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="mb-3">
                        <span>Level</span>
                        <select class="form-select mt-2 mb-2 " name="level_id" id="levelId" required="required">
                            <?php foreach ($levels as $level): ?>
                                <option value="<?php echo $level['id']; ?>" selected><?php echo $level['name'] ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="mb-3">
                        <span>Paid of classes</span>
                        <select class="form-select mt-2 mb-2 " name="quant_id" id="quantId" required="required">
                            <?php foreach ($paids as $paid): ?>
                                <option value="<?php echo $paid['id']; ?>" selected><?php echo $paid['quantity'] ?></option>
                            <?php endforeach; ?>
                        </select>
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
