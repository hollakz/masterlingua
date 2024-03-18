<?php
require __DIR__ . '/include/database.php';
require __DIR__ . '/include/auth.php';

$query = "SELECT u.id, u.username, u.first_name, u.last_name, u.level, u.date_of_birth, u.paid_for_classes, u.avatar, COUNT(t.student_id)  AS task_count, COUNT(a.mark) AS mark_count 
FROM  users u 
LEFT JOIN tasks t ON u.id = t.student_id
LEFT JOIN answers a on t.id = a.task_id
WHERE role = 'student'
GROUP BY u.id, u.username, u.first_name, u.last_name, u.level, u.date_of_birth, u.paid_for_classes, u.avatar, a.mark";
$stmt = $pdo->query($query);
$students = $stmt->fetchAll(PDO::FETCH_ASSOC);


$usersLangsQuery = "SELECT ul.user_id, ln.name AS lang_name, lv.name AS level_name, lv.description AS level_description, pfc.quantity AS quantity
FROM user_lang ul
JOIN languages ln ON ln.id = ul.lang_id
JOIN levels lv on lv.id = ul.level_id
JOIN paid_for_classes pfc ON ul.quant_id = pfc.id";
$userLangRows = $pdo->query($usersLangsQuery)->fetchAll(PDO::FETCH_ASSOC);

$studentLangGrouped = [];
foreach ($userLangRows as $userLangRow) {
    $studentLangGrouped[$userLangRow['user_id']][] = $userLangRow;
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
    <title>Студенты</title>
</head>
<body>
<?php require __DIR__ . '/include/navbar.php'; ?>
<div class="container overflow-visible">
    <div class="row row-cols-2 row-cols-lg-5 g-2 g-lg-3 align-items-stretch mx-auto">
        <?php if (!empty($students)): ?>
            <?php foreach ($students as $student): ?>
                <div class="col-7">
                    <div class="card mt-2">
                        <img src="../avatar_images/<?php echo $student['avatar']; ?>"
                             class="card-img-top img-fluid rounded" alt="Студент">
                        <div class="card-body flex-column">

                            <h5 class="card-title"><?php echo $student['first_name'] . ' ' . $student['last_name']; ?></h5>
                            <p class="card-text">

                                <?php if (isset($studentLangGrouped[$student['id']])): ?>

                                    <?php foreach ($studentLangGrouped[$student['id']] as $userLang): ?>

                                <p>Язык: <?php echo $userLang['lang_name']; ?>, Уровень: <?php echo $userLang['level_name']; ?>, Осталось занятий: <span
                                        class="badge <?php if ($userLang['quantity'] == 1) {
                                            echo 'text-bg-danger';
                                        } else {
                                            echo 'text-bg-warning';
                                        } ?>"</span><?php echo $userLang['quantity'] ?>  </p>
                                    <?php endforeach; ?>
                                <?php endif; ?>
                            <?php
                            $age = (new DateTime())->diff(new DateTime($student['date_of_birth']))->y;
                            echo $age . ' ' . (($age % 10 == 1 && $age % 100 != 11) ? 'год' : (($age % 10 >= 2 && $age % 10 <= 4 && ($age % 100 < 10 || $age % 100 >= 20)) ? 'года' : 'лет'));
                            ?> </p>
                            <p class="card-text">Назначено
                                заданий: <?php echo $student['task_count'] - $student['mark_count'] ?></p>
                            <a href="/admin/edit_student.php?id=<?php echo $student['id'] ?>" class="btn btn-primary">Редактировать</a>
                            <a href="/admin/teacher_create_task.php?student_id=<?php echo $student['id'] ?>"
                               class="btn btn-success mt-2">Назначить задание</a>
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
