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
    $comment = $_POST['comment'];

    try {
        $sqlUpdate = 'UPDATE answers SET mark = :mark, marked_at = :markedAt, comment = :comment WHERE task_id = :taskId';
        $stmt = $pdo->prepare($sqlUpdate);
        $stmt->bindValue(':mark', (int)$mark);
        $stmt->bindValue(':markedAt', $markedAt);
        $stmt->bindValue(':comment', $comment);
        $stmt->bindValue(':taskId', (int)$id);
        $stmt->execute();
        header("Location: /admin/teacher_show_task.php?id={$id}");
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
                <h3 class="text-center">Homework</h3>
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
                            <h3 class="text-center">Answer to the task</h3>
                            <table class="table table-success table-striped table-bordered mt-4">
                                <tr>
                                    <th class="table-light">Task number</th>
                                    <td><?php echo $answer['id']; ?></td>
                                </tr>
                                <tr>
                                    <th class="table-light">Text</th>
                                    <td><?php echo $answer['text']; ?></td>
                                </tr>
                                <tr>
                                    <th class="table-light">Date</th>
                                    <td><?php echo $answer['created_at']; ?></td>
                                </tr>
                                <?php if (isset($answer['mark'], $answer['marked_at'], $answer['comment'])): ?>
                                    <tr>
                                        <th class="table-light">Grade</th>
                                        <td><?php echo $answer['mark']; ?></td>
                                    </tr>
                                    <tr>
                                        <th class="table-light">Date of assessment</th>
                                        <td><?php echo $answer['marked_at']; ?></td>
                                    </tr>
                                    <tr>
                                        <th class="table-light">Комментарий к заданию</th>
                                        <td><?php echo $answer['comment']; ?></td>
                                    </tr>
                                <?php else: ?>
                                    <tr>
                                        <td colspan="2">
                                            <form action="" method="post">
                                                <div class="form-floating mb-2">
                                                    <textarea class="form-control h-100" id="mark"
                                                              name="comment"></textarea>
                                                    <label for="comment">Впишите комментарий к заданию</label>
                                                </div>
                                                <input id="mark" name="mark" type="number" min="2" max="5">
                                                <button type="submit">Оценить задание</button>
                                            </form>
                                        </td>
                                    </tr>
                                <?php endif; ?>
                            </table>
                        </div>
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
