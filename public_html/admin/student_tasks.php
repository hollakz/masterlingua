<?php
require __DIR__ . '/include/database.php';
require __DIR__ . '/include/auth.php';

$query = "SELECT tasks.id, tasks.title, tasks.description, users.first_name, users.last_name, a.id AS has_answer, a.mark
FROM tasks
JOIN users ON tasks.teacher_id = users.id
LEFT JOIN answers a on tasks.id = a.task_id
WHERE tasks.student_id = $user[id]";
$stmt = $pdo->query($query);
$tasks = $stmt->fetchAll(PDO::FETCH_ASSOC);
$pdo = null;

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
    <title>Студенты</title>
</head>
<body>
<?php require __DIR__ . '/include/navbar.php'; ?>
<div class="container overflow-visible">
    <div class="row row-cols-2 row-cols-lg-5 g-2 g-lg-3 align-items-stretch mx-auto">
        <?php if (!empty($tasks)): ?>
            <?php foreach ($tasks as $task): ?>
                <div class="col-sm-12 col-md-6 col-lg-4">
                    <div class="card mt-2 h-100">
                        <img src="../uploads/students/student-stub.jpg" class="card-img-top" alt="Студент-заглушка">
                        <div class="card-body flex-column">
                            <h5 class="card-title">Тема задания: <br> <?php echo $task['title']; ?></h5>

                            <p class="card-text">
                                Учитель: <?php echo $task["first_name"] . " " . $task["last_name"]; ?></p>
                            <p class="card-text">
                                Оценка:
                                <?php if($task['mark']): ?>
                                    <?php if($task['mark'] <= 2): ?>
                                        <span class="badge bg-danger"><?php echo $task['mark']?></span>
                                    <?php elseif($task['mark'] == 3): ?>
                                        <span class="badge bg-warning"><?php echo $task['mark']?></span>
                                    <?php else: ?>
                                        <span class="badge bg-success"><?php echo $task['mark']?></span>
                                    <?php endif; ?>
                                <?php endif; ?>
                            </p>
                            <a href="/admin/student_show_task.php?id=<?php echo $task['id'] ?>" class="btn btn-primary">Homework</a>
                            <?php if ($task['has_answer']) : ?>
                                <span class="bi bi-calendar-check"><svg xmlns="http://www.w3.org/2000/svg" width="28" height="28" fill="currentColor" class="bi bi-calendar-check" viewBox="0 0 16 16">
                                    <path d="M10.854 7.146a.5.5 0 0 1 0 .708l-3 3a.5.5 0 0 1-.708 0l-1.5-1.5a.5.5 0 1 1 .708-.708L7.5 9.793l2.646-2.647a.5.5 0 0 1 .708 0"/>
                                    <path d="M3.5 0a.5.5 0 0 1 .5.5V1h8V.5a.5.5 0 0 1 1 0V1h1a2 2 0 0 1 2 2v11a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2V3a2 2 0 0 1 2-2h1V.5a.5.5 0 0 1 .5-.5M1 4v10a1 1 0 0 0 1 1h12a1 1 0 0 0 1-1V4z"/>
                                </svg></span>
                            <?php endif; ?>

                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        <?php else: ?>
            <div class="alert">Студенты не найдены</div>
        <?php endif; ?>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-HwwvtgBNo3bZJJLYd8oVXjrBZt8cqVSpeBNS5n7C8IVInixGAoxmnlMuBnhbgrkm"
        crossorigin="anonymous"></script>
</body>
</html>

