<?php
require __DIR__ . '/include/database.php';
require __DIR__ . '/include/auth.php';

$id = $_GET['id'];
$query = "SELECT t.title, t.description, u.first_name AS teacher_first_name, u.last_name AS teacher_last_name 
          FROM tasks t 
          JOIN users u ON t.teacher_id = u.id 
          WHERE t.id = $id";
$stmt = $pdo->query($query);
$task = $stmt->fetch(PDO::FETCH_ASSOC);

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

                <table class="table table-bordered mt-4">
                    <tr>
                        <th class="table-light">Title</th>
                        <td><?php echo $task['title']; ?></td>
                    </tr>
                    <tr>
                        <th class="table-light">Description</th>
                        <td><?php echo $task['description']; ?></td>
                    </tr>
                    <tr>
                        <th class="table-light">Teacher</th>
                        <td><?php echo $task['teacher_first_name'] . ' ' . $task['teacher_last_name']; ?></td>
                    </tr>
                </table>

            </div>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-HwwvtgBNo3bZJJLYd8oVXjrBZt8cqVSpeBNS5n7C8IVInixGAoxmnlMuBnhbgrkm"
        crossorigin="anonymous"></script>
</body>
</html>
