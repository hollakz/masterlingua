<?php
require __DIR__ . '/include/database.php';
require __DIR__ . '/include/auth.php';

$query = "SELECT * FROM users WHERE role = 'student'";
$stmt = $pdo->query($query);
$students = $stmt->fetchAll(PDO::FETCH_ASSOC);
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
<div class="container">
<div class="row">
    <?php if(!empty($students)): ?>
        <?php foreach ($students as $student): ?>
            <div class="col-6 col-sm-3">
            <div class="card mt-2">
                <img src="../uploads/students/student-stub.jpg" class="card-img-top" alt="Студент-заглушка">

                <div class="card-body">
                    <h5 class="card-title"><?php echo $student['first_name']; ?> <?php echo $student['last_name']; ?></h5>
                    <p class="card-text"> <span class="badge bg-secondary"><?php echo $student['level']; ?></span> <?php echo (new DateTime())->diff(new DateTime($student['date_of_birth']))->y;?> года </p>
                    <a href="/admin/student.php?id=<?php echo $student['id']?>" class="btn btn-primary">Редактировать</a>
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
