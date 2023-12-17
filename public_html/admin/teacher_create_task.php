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
$formSubmit = false;
$errorMessage = null;

if (isset($_POST['title'], $_POST['description'])) {
    $formSubmit = true;
    $studentId = $_GET['id'];
    $teacherId = $user['id'];
    $title = trim($_POST['title']);
    $description = trim($_POST['description']);
    if (empty($title) || empty($description)) {
        $errorMessage = 'Вы не заполнили форму';
    } else {
        //TODO INSERT QUERY
        header("Location: /admin/students.php") ;
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
                <h3 class="text-center">Назначить задание</h3>
                <?php if ($formSubmit && !empty($errorMessage)): ?>
                    <div class="alert alert-danger" role="alert">
                        <?php echo $errorMessage; ?>
                    </div>
                <?php endif; ?>
                <form action="" method="post">
                    <table class="table table-bordered mt-4">
                        <tr>
                            <th class="table-light">Title</th>
                            <td>
                                <div class="form-floating">
                                    <input class="form-control w-100" type="text" id="title"
                                           name="title">
                                    <label for="title">Впишите тему задания</label>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <th class="table-light">Description</th>
                            <td>
                                <div class="form-floating">
                <textarea class="form-control h-100" id="description"
                           name="description"></textarea>
                                    <label for="description">Впишите задание</label>
                                </div>
                            </td>
                        </tr>
                    </table>
                    <button type="submit" class="btn btn-primary mt-2">Назначить</button>
                </form>
            </div>
        </div>
    </div>
    <!--    <div class="container">-->
    <!--        <div class="container-fluid">-->
    <!--            <div class="row justify-content-center">-->
    <!--                <div class="col-12 col-md-6">-->
    <!--                    --><?php //if ($answer): ?>
    <!--                        <div class="tasks pt-3">-->
    <!--                            <h3 class="text-center">Ответ на задания</h3>-->
    <!--                            <table class="table table-success table-striped table-bordered mt-4">-->
    <!--                                <tr>-->
    <!--                                    <th class="table-light">id</th>-->
    <!--                                    <td>--><?php //echo $answer['id']; ?><!--</td>-->
    <!--                                </tr>-->
    <!--                                <tr>-->
    <!--                                    <th class="table-light">text</th>-->
    <!--                                    <td>--><?php //echo $answer['text']; ?><!--</td>-->
    <!--                                </tr>-->
    <!--                                <tr>-->
    <!--                                    <th class="table-light">Дата</th>-->
    <!--                                    <td>--><?php //echo $answer['created_at']; ?><!--</td>-->
    <!--                                </tr>-->
    <!--                                --><?php //if (isset($answer['mark'], $answer['marked_at'])): ?>
    <!--                                    <tr>-->
    <!--                                        <th class="table-light">Оценка</th>-->
    <!--                                        <td>--><?php //echo $answer['mark']; ?><!--</td>-->
    <!--                                    </tr>-->
    <!--                                    <tr>-->
    <!--                                        <th class="table-light">Дата оценки</th>-->
    <!--                                        <td>--><?php //echo $answer['marked_at']; ?><!--</td>-->
    <!--                                    </tr>-->
    <!--                                --><?php //else: ?>
    <!--                                    <tr>-->
    <!--                                        <td colspan="2">-->
    <!--                                            <form action="" method="post">-->
    <!--                                                <input id="mark" name="mark" type="number" min="2" max="5">-->
    <!--                                                <button type="submit">Оценить задание</button>-->
    <!--                                            </form>-->
    <!--                                        </td>-->
    <!--                                    </tr>-->
    <!---->
    <!--                                --><?php //endif; ?>
    <!--                            </table>-->
    <!--                        </div>-->
    <!--                    --><?php //endif; ?>
    <!--                </div>-->
    <!--            </div>-->
    <!--        </div>-->
    <!--    </div>-->


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js"
            integrity="sha384-HwwvtgBNo3bZJJLYd8oVXjrBZt8cqVSpeBNS5n7C8IVInixGAoxmnlMuBnhbgrkm"
            crossorigin="anonymous"></script>
</body>
</html>
