<?php
require __DIR__ . '/include/database.php';
require __DIR__ . '/include/functions.php';

$hash = $_GET['hash'] ?? null;

if ($hash) {
    $data = simple_decrypt($hash, '~$eCrE7');
    $userId = $data['id'] ?? null;

    var_dump($data); // увидим наш массив с данными, которые мы давали на вход

    if ($userId) {
        $sql = "SELECT * FROM users WHERE id = $userId";
        $result = $pdo->query($sql);

        if($result->rowCount() == 0) {
            echo "Пользователь не найден.";
        } else {
            // Пользователь найден, показываем форму для ввода нового пароля
            if(isset($_POST['new_password'])) {
                $new_password = $_POST['new_password'];
                // Хэшируем новый пароль перед сохранением в базу данных
                $hashed_password = password_hash($new_password, PASSWORD_DEFAULT);

                // Обновляем пароль пользователя в базе данных
                $update_sql = "UPDATE users SET password = '$hashed_password' WHERE id = $userId";
                $pdo->query($update_sql);

                echo "Пароль успешно изменен.";
            } else {
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
                    <title>Восстановление доступа</title>
                </head>
                <body>
                <div class="container">
                    <div class="row justify-content-center">
                        <div class="col-sm-8 col-md-6 col-lg-4 pt-5">
                            <form class="form-signin" method="post">
                                <h2 class="form-signin-heading text-center">Восстановление доступа</h2>
                                <label for="new_password" class="sr-only mb-2">Введите новый пароль:</label>
                                <input type="password" id="new_password" name="new_password" required class="form-control" placeholder="New password" autofocus>
                                <button class="btn btn-primary btn-block mt-3" type="submit">Изменить пароль</button>
                            </form>
                        </div>
                    </div>
                </div>
                <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js"
                        integrity="sha384-HwwvtgBNo3bZJJLYd8oVXjrBZt8cqVSpeBNS5n7C8IVInixGAoxmnlMuBnhbgrkm"
                        crossorigin="anonymous"></script>
                </body>
                </html>
                <?php
            }
        }
    } else {
        echo "Недействительная ссылка для сброса.";
    }
} else {
    echo "Недействительная ссылка для сброса.";
}
?>

