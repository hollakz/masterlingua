<?php

$host = "localhost";
$username = "cb37211_mlingua";
$password = "QVMqjYz9";
$dbname = "cb37211_mlingua";

$pdo = new PDO("mysql:host={$host};dbname={$dbname};charset=utf8", $username, $password);
$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
//$pdo = new PDO("mysql: host=localhost;dbname=masterlingua;charset=utf8", "holla", "1337");
//$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

$arg = $argv[1] ?? null;

if ($arg === '--fresh') {
    try {
        $sql = "DROP DATABASE IF EXISTS cb37211_mlingua";
        $pdo->exec($sql);
        echo "Database cb37211_mlingua was successfully dropped.";
    } catch (Exception $e) {
        echo 'Error: ' . $e->getMessage();
    }
}

try {

    $sqlCreateDb = "CREATE DATABASE IF NOT EXISTS cb37211_mlingua
        DEFAULT CHARACTER SET utf8
        DEFAULT COLLATE utf8_general_ci";

    $sqlUse = "USE cb37211_mlingua";

    $pdo->exec($sqlCreateDb);
    $pdo->exec($sqlUse);

    $sqlCreateTable = "CREATE TABLE IF NOT EXISTS users
    (
        id               INT AUTO_INCREMENT PRIMARY KEY,
    username         VARCHAR(255) UNIQUE,
    password         VARCHAR(255),
    level            VARCHAR(255),
    role             VARCHAR(255),
    first_name       VARCHAR(255),
    last_name        VARCHAR(255),
    date_of_birth    DATE,
    paid_for_classes INT,
    avatar VARCHAR(255)
)";
    $pdo->exec($sqlCreateTable);

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