<?php

$host = "localhost";
$username = "cb37211_mlingua";
$password = "QVMqjYz9";
$dbname = "cb37211_mlingua";


$pdo = new PDO("mysql:host={$host};dbname={$dbname};charset=utf8", $username, $password);
$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

$isFresh = $argv[1] ?? null;

if ($isFresh === '--fresh') {
    try {
        $sql = "DROP DATABASE IF EXISTS {$dbname}";
        $pdo->exec($sql);
        echo "Database {$dbname} was successfully dropped.";
    } catch (Exception $e) {
        echo 'Error: ' . $e->getMessage();
    }
}


try {

    $sqlCreateDb = "CREATE DATABASE IF NOT EXISTS {$dbname}
        DEFAULT CHARACTER SET utf8
        DEFAULT COLLATE utf8_general_ci";

    $sqlUse = "USE {$dbname}";

    $pdo->exec($sqlCreateDb);
    $pdo->exec($sqlUse);

    //Создание таблицы users
    $sqlCreateTable = "CREATE TABLE IF NOT EXISTS users
    (
    id               INT AUTO_INCREMENT PRIMARY KEY,
    username         VARCHAR(255) UNIQUE,
    password         VARCHAR(255),
    level            VARCHAR(255),
    second_level     VARCHAR(255),
    role             VARCHAR(255),
    first_name       VARCHAR(255),
    last_name        VARCHAR(255),
    date_of_birth    DATE,
    paid_for_classes INT,
    avatar VARCHAR(255)
)";
    $pdo->exec($sqlCreateTable);

    $isSystemUsers = $argv[1] ?? null;

    if ($isSystemUsers === '--system-users') {
        // Создание системных пользователей
        $sqlInertTable = "INSERT INTO users(username, password, level, second_level, role, first_name, last_name, date_of_birth, paid_for_classes, avatar) VALUES
            ('admin', '$2y$12$e664oLfeTinxGcgPQEsKuu6v88/HO6EOB.4PJYamlTgZFtQLo9UYS', 'A1','A1', 'admin', 'Admin', 'Admin', '1970-01-01', 0, 'service_avatar.png'),
            ('teacher', '$2y$12$r5XNyK1LT7E3keBiHzuihu1jQ2oClkMp5yXfUS/4BfJzaQiUSbexO', 'A1','A1', 'teacher', 'Teacher', 'Teacher', '1970-01-01', 0, 'service_avatar.png'),
            ('student', '$2y$12$x7pwYTg.h/2UMKXm4rfq5uJpbAoyMe9mCYW1QSXD2ZmfD5HrvBJHi', 'A1','A1', 'student', 'Student', 'Student', '1970-01-01', 0, 'service_avatar.png')";
        $pdo->exec($sqlInertTable);
    }


    //Создание таблицы Tasks
    $sqlCreateTable = "CREATE TABLE IF NOT EXISTS tasks (
                                     id INT AUTO_INCREMENT PRIMARY KEY,
                                     title VARCHAR(255),
                                     description TEXT,
                                     teacher_id INT,
                                     student_id INT
)";
    $pdo->exec($sqlCreateTable);

    echo "Table created and data inserted successfully.";
} catch (PDOException $e) {
    echo "Error: " . $e->getMessage();
}

//Создание таблице Answers
$sqlCreateTable = "CREATE TABLE IF NOT EXISTS answers (
                                       id INT AUTO_INCREMENT PRIMARY KEY,
                                       task_id INT UNIQUE,
                                       text TEXT,
                                       created_at DATETIME,
                                       mark INT,
                                       marked_at DATETIME,
                                       comment TEXT
)";
$pdo->exec($sqlCreateTable);


// Создание таблицы Languages
$sqlCreateTable = "CREATE table if not exists languages (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(255)
                                     )";
$pdo->exec($sqlCreateTable);

// Создание таблицы Levels
$sqlCreateTable = "CREATE table if not exists levels (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(255),
   description VARCHAR(255)
                                     )";
$pdo->exec($sqlCreateTable);

// Создание таблицы User_lang
$sqlCreateTable = "CREATE table if not exists user_lang (
    id INT AUTO_INCREMENT PRIMARY KEY,
                                    user_id int,
                                    lang_id int,
                                    level_id int
)";
$pdo->exec($sqlCreateTable);