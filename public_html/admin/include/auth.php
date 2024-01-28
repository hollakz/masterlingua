<?php
require __DIR__ . '/database.php';
session_start();

if (!isset($_SESSION['username']) || empty($_SESSION['username'])) {
    session_destroy();
    header('Location: ./login.php');
    die();
}

try {
    $sql = 'SELECT * FROM users WHERE username like :username';
    $statement = $pdo->prepare($sql);
    $statement->bindValue(':username', $_SESSION['username']);
    $statement->execute();
    $user = $statement->fetch(PDO::FETCH_ASSOC);

    if (empty($user)) {
        session_destroy();
        header('Location: ./login.php');
        die();
    }
} catch (PDOException $e) {
    echo "Error: " . $e->getMessage();
    die();
}




