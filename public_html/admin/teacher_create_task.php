<?php
require __DIR__ . '/include/database.php';
require __DIR__ . '/include/auth.php';

$studentId = $_GET['student_id'] ?? null;
if (!$studentId) {
    exit('Ошибка: неверный идентификатор страницы.');
}

if ($user['role'] !== 'teacher') {
    exit('Ошибка: доступ запрещен.');
}
$formSubmit = false;
$errorMessage = null;

if (isset($_POST['title'], $_POST['description'])) {
    $formSubmit = true;
    $teacherId = $user['id'];
    $title = trim($_POST['title']);
    $description = trim($_POST['description']);
    if (empty($title) || empty($description)) {
        $errorMessage = 'Вы не заполнили форму';
    } else {
        try {
            $createQuery = 'INSERT INTO tasks (title, description, teacher_id, student_id) VALUES (:title, :description, :teacherId, :studentId)';
            $stmt = $pdo->prepare($createQuery);
            $stmt->bindValue(':title', $title);
            $stmt->bindValue(':description', $description);
            $stmt->bindValue(':teacherId', $teacherId);
            $stmt->bindValue(':studentId', $studentId);
            $stmt->execute();
            echo '<script>
                alert("Задание назначено")
                document.location = "/admin/students.php"
            </script>';
        } catch (Exception $e) {
            $errorMessage = $e->getMessage();
        }
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

            <div class="tasks pt-3">
                <h3 class="text-center">Назначить задание</h3>
                <?php if ($formSubmit && !empty($errorMessage)): ?>
                    <div class="alert alert-danger" role="alert">
                        <?php echo $errorMessage; ?>
                    </div>
                <?php endif; ?>
                <form action="" method="post">
                    <table class="table table-bordered mt-4">
                        <tr>
                            <th class="table-light">Title</th>
                            <td>
                                <div class="form-floating">
                                    <input class="form-control w-100" type="text" id="title"
                                           name="title">
                                    <label for="title">Впишите тему задания</label>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <th class="table-light">Description</th>
                            <td>
                                <div class="form-floating">
                <textarea class="form-control h-100" id="description"
                          name="description"></textarea>
                                    <label for="description">Впишите задание</label>
                                </div>
                            </td>
                        </tr>
                    </table>
                    <button type="submit" class="btn btn-primary mt-2">Назначить</button>
                </form>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js"
            integrity="sha384-HwwvtgBNo3bZJJLYd8oVXjrBZt8cqVSpeBNS5n7C8IVInixGAoxmnlMuBnhbgrkm"
            crossorigin="anonymous"></script>
</body>
</html>
