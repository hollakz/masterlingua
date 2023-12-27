<?php
require __DIR__ . '/include/database.php';
require __DIR__ . '/include/auth.php';

$id = $_GET['id'] ?? null;
if (!$id) {
    exit('Ошибка: неверный идентификатор страницы.');
}

if ($user['role'] !== 'teacher') {
    exit('Ошибка: доступ запрещен.');
}

$query = "SELECT t.title, t.description
          FROM tasks t
          WHERE t.id = {$id}";

$stmt = $pdo->query($query);
$task = $stmt->fetch(PDO::FETCH_ASSOC);

$editMessage = '';
$editError = false;

if (($_SERVER['REQUEST_METHOD'] === 'POST') && isset($_POST["editTask"])) {

    $title = $_POST['title'];
    $description = $_POST['description'];

    if (!empty($title) && !empty($description)) {
        try {
            $sqlUpdate = "UPDATE tasks SET title = :title, description = :description WHERE id = {$id}";
            $stmt = $pdo->prepare($sqlUpdate);
            $stmt->bindValue(':title', $title);
            $stmt->bindValue(':description', $description);
            $stmt->execute();
            echo '<script>
                alert("Задание отредактировано")
                document.location = "/admin/teacher_tasks.php"
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
                <h3 class="text-center">Просмотр задания</h3>
                <form action="" method="post">
                <table class="table table-bordered mt-4">
                    <tr>
                        <th class="table-light"><label for="title" class="form-label">Title</label>
                        </th>

                        <td>

                            <input type="text" class="form-control" id="title" name="title" minlength="1"
                                   maxlength="10" required="required" value="<?php echo $task['title']; ?>">
                        </td>
                    </tr>
                    <tr>
                        <th class="table-light"><label for="description" class="form-label">Description</label></th>
                        <td>
                            <textarea class="form-control" id="description" name="description" required="required" value="<?php echo $task['description']; ?>">
                            </textarea>
                        </td>
                    </tr>
                </table>
                <button type="submit" class="btn btn-primary" name="editTask">Редактировать задание</button>
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
