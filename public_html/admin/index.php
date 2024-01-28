<?php
require __DIR__ . '/include/database.php';
require __DIR__ . '/include/auth.php';

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
    <title>Админка. Главная страница</title>
</head>
<body>
<?php require __DIR__ . '/include/navbar.php'; ?>
<div class="container-fluid">
    <div class="row justify-content-center">
        <div class="col-12 col-md-6">
            <div class="registration pt-3">

                <?php if (in_array($user['role'], ['teacher'])): ?>
                    <h3 class="text-center">Личный кабинет учителя</h3>
                    <div class="lead text-center">
                        Добро пожаловать, <strong><?php echo $user['first_name'] . ' ' . $user['last_name'] ?>.
                    </div>
                <?php endif; ?>

                <?php if (in_array($user['role'], ['student'])): ?>
                <h3 class="text-center">Личный кабинет студента</h3>
                <div class="lead text-center">
                    Добро пожаловать, <strong><?php echo $user['first_name'] . ' ' . $user['last_name'] ?>.</strong>
                </div>
                <br>
                <table class="table">
                    <thead>
                    <tr>
                        <th scope="col">Количество оплаченных
                            занятий:
                        </th>
                        <th scope="col">Ваш уровень:</th>
                    </tr>
                    </thead>
                    <tbody class="table-group-divider">
                    <tr>
                        <td><?php echo $user['paid_for_classes'] ?? 0; ?></td>
                        <td><span class="badge bg-secondary"><?php echo $user['level'] ?></span></td>
                    </tr>
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
