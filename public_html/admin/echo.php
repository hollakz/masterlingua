<?php
require __DIR__ . '/include/database.php';
require __DIR__ . '/include/auth.php';


$usersQuery = "SELECT * FROM users u WHERE u.role = 'student'";
$users = $pdo->query($usersQuery)->fetchAll(PDO::FETCH_ASSOC);

$usersLangsQuery = "SELECT ul.user_id, ln.name AS lang_name, lv.name AS level_name, lv.description AS level_description
FROM user_lang ul
JOIN languages ln ON ln.id = ul.lang_id
JOIN levels lv on lv.id = ul.level_id";
$userLangRows = $pdo->query($usersLangsQuery)->fetchAll(PDO::FETCH_ASSOC);

$userLangMap = [];
foreach ($userLangRows as $userLangRow) {
    $userLangMap[$userLangRow['user_id']][] = $userLangRow;
}
?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>

<div>
    <?php foreach ($users as $user): ?>
        <div style="border: 1px solid black; padding: 5px;">
            <?php echo $user['last_name'] . ' ' . $user['first_name']; ?>
            <?php if (isset($userLangMap[$user['id']])): ?>
                <div style="border: 1px solid black; padding: 5px;">
                    <?php foreach ($userLangMap[$user['id']] as $userLang): ?>
                        <p>Язык: <?php echo $userLang['lang_name']; ?>, Уровень: <?php echo $userLang['level_name']; ?> </p>
                    <?php endforeach; ?>
                </div>
            <?php endif; ?>
        </div>
    <?php endforeach; ?>

</div>

</body>
</html>