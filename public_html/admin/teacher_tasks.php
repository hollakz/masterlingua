<?php
require __DIR__ . '/include/database.php';
require __DIR__ . '/include/auth.php';

$query = "SELECT tasks.id, tasks.title, tasks.description, users.first_name, users.last_name
FROM tasks
JOIN users ON tasks.student_id = users.id
WHERE tasks.teacher_id = $user[id]";

$stmt = $pdo->query($query);
$tasks = $stmt->fetchAll(PDO::FETCH_ASSOC);

$query_students = "SELECT u.id, u.first_name, u.last_name 
FROM users u 
LEFT JOIN tasks t ON (t.student_id = u.id) 
WHERE u.role = 'student' AND t.teacher_id = $user[id]";
$stmt_students = $pdo->query($query_students);
$students = $stmt_students->fetchAll(PDO::FETCH_ASSOC);

if  (isset($_GET['student_id'])) {
    $student_id = $_GET['student_id'];
    $query .= " AND tasks.student_id = {$student_id}";
}

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
    <title>Учитель-задание</title>
</head>
<body>
<?php require __DIR__ . '/include/navbar.php'; ?>
<div class="container">
    <select class="mt-2" name="student_id">
        <?php foreach ($students as $student): ?>
            <option value="<?php echo $student['id']; ?>"><?php echo $student['first_name'] . ' ' . $student['last_name']; ?></option>
        <?php endforeach; ?>
    </select>
</div>
<div class="container">
    <div class="row">
        <?php if (!empty($tasks)): ?>
            <?php foreach ($tasks as $task): ?>
                <div class="col-6 col-sm-3">
                    <div class="card mt-2">
                        <img src="../uploads/teachers/teacher-stub.jpeg" class="card-img-top" alt="Учитель-заглушка">

                        <div class="card-body">
                            <h5 class="card-title"><span class="badge bg-secondary"><?php echo $task['title']; ?></h5>
                            <p class="card-text">
                                Студент: <?php echo $task["first_name"] . " " . $task["last_name"]; ?></p>
                            <a href="/admin/show_task.php?id=<?php echo $task['id'] ?>" class="btn btn-primary">Просмотр
                                задания</a>
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

