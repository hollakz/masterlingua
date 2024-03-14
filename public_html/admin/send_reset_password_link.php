<?php
require __DIR__ . '/include/database.php';
$hasError = false;
$errorText = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = $_POST['send_mail'] ?? null;

    if (empty($email)) {
        $errorText = "Вы не ввели ваш Email";
        $hasError = true;
    } else {
        try {
            $sql = 'SELECT email, id FROM users WHERE email = :email';
            $statement = $pdo->prepare($sql);
            $statement->bindValue(':email', $email);
            $statement->execute();
            $user = $statement->fetch(PDO::FETCH_ASSOC);

            if ($user) {
                $userId = $user['id'];
                $link = 'http://localhost:8080/admin/reset_password.php?id=' . $userId;
                $successMessage = "Ссылка для сброса пароля отправлена на ваш Email.";
            } else {
                $successMessage = "Ссылка для сброса пароля отправлена на ваш Email.";
            }
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
        }
    }
}
echo $link;
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
                <label for="inputMail" class="sr-only mb-2"></label>
                <input type="text" id="inputMail" name="send_mail" class="form-control" placeholder="Email" required autofocus>
                <button class="btn btn-primary btn-block mt-3" type="submit">Enter</button>
                <a class="btn btn-light inline-block mt-3 d-md-inline-block" href="./send_reset_password_link.php" role="button">Reset</a>
            </form>
            <?php if ($hasError): ?>
                <div class="alert alert-danger mt-3" role="alert"><?php echo $errorText; ?></div>
            <?php endif; ?>
            <?php if (isset($successMessage)): ?>
                <div class="alert alert-success mt-3" role="alert"><?php echo $successMessage; ?></div>
            <?php endif; ?>
        </div>
    </div>
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-HwwvtgBNo3bZJJLYd8oVXjrBZt8cqVSpeBNS5n7C8IVInixGAoxmnlMuBnhbgrkm"
        crossorigin="anonymous"></script>
</body>
</html>
