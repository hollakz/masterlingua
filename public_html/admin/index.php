<?php
$users = [
    'paulchervov' => 'pa$$worLd102',
    'hollakz' => 'Coca-Holla42',
    'olga' => 'olga-0-conor-99',
];

$user = $_SERVER['PHP_AUTH_USER'] ?? null;
$password = $_SERVER['PHP_AUTH_PW'] ?? null;

if (isset($users[$user]) && $users[$user] === $password) {
    echo "<div>Добро пожаловать в админку, {$user}!</div>";
} else {
    header('WWW-Authenticate: Basic realm="My Realm"');
    header('HTTP/1.0 401 Unauthorized');
    echo "<div>Нет доступа в админку.<br>
            <a href='/admin/index.php'>Попробовать еще раз</a><br>
            <a href='/'>На главную</a>
        </div>";
    exit;
}

