<?php
require __DIR__ . '/include/database.php';
require __DIR__ . '/include/auth.php';

$query = "SELECT id, first_name, last_name, date_of_birth, avatar FROM  users WHERE role = 'teacher'";
$stmt = $pdo->query($query);
$teachers = $stmt->fetchAll(PDO::FETCH_ASSOC);
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
    <title>Преподаватели</title>
</head>
<body>
<?php require __DIR__ . '/include/navbar.php'; ?>
<div class="container overflow-visible">
    <div class="row row-cols-2 row-cols-lg-5 g-2 g-lg-3 align-items-stretch mx-auto">
        <?php if (!empty($teachers)): ?>
            <?php foreach ($teachers as $teacher): ?>
                <div class="col-7">
                    <div class="card mt-2">
                        <img src="../avatar_images/<?php echo $teacher['avatar']; ?>"
                             class="card-img-top img-fluid rounded" alt="Преподаватель">
                        <div class="card-body flex-column">
                            <h5 class="card-title"><?php echo $teacher['first_name'] . ' ' . $teacher['last_name']; ?></h5>
                            <p class="card-text"><?php $age = (new DateTime())->diff(new DateTime($teacher['date_of_birth']))->y;
                                echo $age . ' ' . (($age % 10 == 1 && $age % 100 != 11) ? 'год' : (($age % 10 >= 2 && $age % 10 <= 4 && ($age % 100 < 10 || $age % 100 >= 20)) ? 'года' : 'лет'));
                                ?> </p>
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
