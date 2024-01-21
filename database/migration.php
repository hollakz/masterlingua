<?php

$arg = $argv[1] ?? null;

if ($arg === '--fresh') {
    try {
        unlink('./database/database.sqlite');
    } catch (Exception $e) {
        echo 'Error: ' . $e->getMessage();
    }
}

try {
    $pdo = new PDO("mysql: host=localhost;dbname=masterlingua;charset=utf8", "holla", "1337");
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

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

    $sqlInsertData = "INSERT INTO users (username, password, level, role, first_name, last_name, date_of_birth, paid_for_classes, avatar) VALUES
         ('Olga', 'qwe123', 'A1', 'admin', 'Olga', 'O’Connor', '1999-05-05', null, null),
         ('Holla', 'qwe123', 'A1', 'teacher', 'Alexey', 'Klimenkov', '1991-05-28', null, null),
         ('Pavel', 'qwe123', 'C2', 'student', 'Pavel', 'Ivanov', '1990-11-12', null, null)";
    $pdo->exec($sqlInsertData);

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

