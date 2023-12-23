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

$answerQuery = "SELECT * FROM answers WHERE task_id = {$id}";
$stmt = $pdo->query($answerQuery);
$answer = $stmt->fetch(PDO::FETCH_ASSOC);

if (isset($_POST['mark'])) {
    $mark = $_POST['mark'];
    $markedAt = (new \DateTime())->format('Y-m-d H:i:s');

    try {
        $sqlUpdate = 'UPDATE answers SET mark = :mark, marked_at = :markedAt WHERE task_id = :taskId';
        $stmt = $pdo->prepare($sqlUpdate);
        $stmt->bindValue(':mark', (int)$mark);
        $stmt->bindValue(':markedAt', $markedAt);
        $stmt->bindValue(':taskId', (int)$id);
        $stmt->execute();
        header("Location: /admin/teacher_show_task.php?id={$id}") ;
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
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

                <table class="table table-bordered mt-4">
                    <tr>
                        <th class="table-light">Title</th>
                        <td><?php echo $task['title']; ?></td>
                    </tr>
                    <tr>
                        <th class="table-light">Description</th>
                        <td><?php echo $task['description']; ?></td>
                    </tr>
                </table>

            </div>
        </div>
    </div>
    <div class="container">
        <div class="container-fluid">
            <div class="row justify-content-center">
                <div class="col-12 col-md-6">
                    <?php if ($answer): ?>
                        <div class="tasks pt-3">
                            <h3 class="text-center">Ответ на задания</h3>
                            <table class="table table-success table-striped table-bordered mt-4">
                                <tr>
                                    <th class="table-light">id</th>
                                    <td><?php echo $answer['id']; ?></td>
                                </tr>
                                <tr>
                                    <th class="table-light">text</th>
                                    <td><?php echo $answer['text']; ?></td>
                                </tr>
                                <tr>
                                    <th class="table-light">Дата</th>
                                    <td><?php echo $answer['created_at']; ?></td>
                                </tr>
                                <?php if (isset($answer['mark'], $answer['marked_at'])): ?>
                                    <tr>
                                        <th class="table-light">Оценка</th>
                                        <td><?php echo $answer['mark']; ?></td>
                                    </tr>
                                    <tr>
                                        <th class="table-light">Дата оценки</th>
                                        <td><?php echo $answer['marked_at']; ?></td>
                                    </tr>
                                <?php else: ?>
                                    <tr>
                                        <td colspan="2">
                                            <form action="" method="post">
                                                <input id="mark" name="mark" type="number" min="2" max="5">
                                                <button type="submit">Оценить задание</button>
                                            </form>
                                        </td>
                                    </tr>

                                <?php endif; ?>
                            </table>
                        </div>
                <?php else: ?>
                    <div>Студен еще не ответил на задание.</div>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js"
            integrity="sha384-HwwvtgBNo3bZJJLYd8oVXjrBZt8cqVSpeBNS5n7C8IVInixGAoxmnlMuBnhbgrkm"
            crossorigin="anonymous"></script>
</body>
</html>
