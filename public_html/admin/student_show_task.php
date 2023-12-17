<?php
require __DIR__ . '/include/database.php';
require __DIR__ . '/include/auth.php';

$id = $_GET['id'] ?? null;
if (!$id) {
    exit('Ошибка: неверный идентификатор страницы.');
}
$query = "SELECT t.title, t.description, u.first_name AS teacher_first_name, u.last_name AS teacher_last_name 
          FROM tasks t 
          JOIN users u ON t.teacher_id = u.id 
          WHERE t.id = {$id}";
$stmt = $pdo->query($query);
$task = $stmt->fetch(PDO::FETCH_ASSOC);

$answerQuery = "SELECT * FROM answers WHERE task_id = {$id}";
$stmt = $pdo->query($answerQuery);
$answer = $stmt->fetch(PDO::FETCH_ASSOC);

if (($_SERVER['REQUEST_METHOD'] === 'POST') && isset($_POST['answerText'])) {
    $text = $_POST['answerText'];

    try {

        $sqlInsert = "INSERT INTO answers (text, task_id, created_at) VALUES (:text, :taskId, :createdAt)";
        $stmt = $pdo->prepare($sqlInsert);
        $stmt->bindValue(':text', $text);
        $stmt->bindValue(':taskId', $id);
        $stmt->bindValue(':createdAt', (new \DateTime())->format('Y-m-d H:i:s'));
        $stmt->execute();
        header("Location: /admin/student_student_show_task.php?id={$id}") ;
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
                    <tr>
                        <th class="table-light">Teacher</th>
                        <td><?php echo $task['teacher_first_name'] . ' ' . $task['teacher_last_name']; ?></td>
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
                                        <td>Оценка</td>
                                        <td>Вам еще не поставили оценку.</td>
                                    </tr>
                                <?php endif; ?>
                            </table>
                        </div>
                    <?php else: ?>
                        <p>Вы еще не ответили на это задание.</p>
                    <?php endif; ?>
                </div>
            </div>
        </div>
        <?php if(!$answer): ?>
        <form action="" method="post">
            <div class="form-floating">
                <textarea class="form-control" id="answerText"
                          style="height: 100px" name="answerText"></textarea>
                <label for="answerText">Впишите свой ответ</label>
            </div>
            <button type="submit" class="btn btn-primary mt-2">Отправить ответ</button>
        </form>
        <?php endif; ?>
    </div>


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js"
            integrity="sha384-HwwvtgBNo3bZJJLYd8oVXjrBZt8cqVSpeBNS5n7C8IVInixGAoxmnlMuBnhbgrkm"
            crossorigin="anonymous"></script>
</body>
</html>
