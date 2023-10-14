<?php
$pdo = new PDO('sqlite:C:\Users\holla\PhpstormProjects\masterlingua\database\database.sqlite');
$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

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
<table class="table table-bordered">
    <thead>
    <tr>
        <th scope="col">id</th>
        <th scope="col">username</th>
        <th scope="col">password</th>
        <th scope="col">level</th>
        <th scope="col">role</th>
        <th scope="col">first_name</th>
        <th scope="col">last_name</th>
        <th scope="col">date_of_birth</th>
    </tr>
    </thead>
    <tbody>
    <tbody>
    <?php foreach ($students as $student) { ?>
        <tr>
            <?php foreach ($student as $col_value) { ?>
                <td><?php echo $col_value ?></td>
            <?php } ?>
        </tr>
    <?php } ?>
    </tbody>
    </tbody>
<!--    <tbody>-->
<!--    <tr>-->
<!--        <th scope="row">1</th>-->
<!--        <td>--><?php //echo $student['username']?><!--</td>-->
<!--        <td>--><?php //echo $student['level']?><!--</td>-->
<!--        <td>--><?php //echo $student['role']?><!--</td>-->
<!--        <td>--><?php //echo $student['first_name']?><!--</td>-->
<!--        <td>--><?php //echo $student['last_name']?><!--</td>-->
<!--        <td>--><?php //echo $student['date_of_birth']?><!--</td>-->
<!--    </tr>-->
<!--    </tbody>-->
</table>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-HwwvtgBNo3bZJJLYd8oVXjrBZt8cqVSpeBNS5n7C8IVInixGAoxmnlMuBnhbgrkm"
        crossorigin="anonymous"></script>
</body>
</html>
