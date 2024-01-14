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
    $pdo = new PDO('sqlite:./database/database.sqlite');
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $sqlCreateTable = "CREATE TABLE IF NOT EXISTS users (
        id INTEGER PRIMARY KEY AUTOINCREMENT,
        username TEXT UNIQUE ,
        password TEXT,
        level TEXT,
        role TEXT,
        first_name TEXT,
        last_name TEXT,
        date_of_birth TEXT,
        paid_for_classes INTEGER                                 
    )";
    $pdo->exec($sqlCreateTable);

    $sqlInsertData = "INSERT INTO users (username, password, level, role, first_name, last_name, date_of_birth, paid_for_classes) VALUES
        ('Olga', 'qwe123', 'A1', 'admin', 'Olga', 'O’Connor', '1999-05-05', null),
        ('Holla', 'qwe123', 'A1', 'teacher', 'Alexey', 'Klimenkov', '1991-05-28', null),
        ('Pavel', 'qwe123', 'C2', 'student', 'Pavel', 'Ivanov', '1990-11-12', null)";
    $pdo->exec($sqlInsertData);

    //Создание таблицы Tasks
    $sqlCreateTable = "CREATE TABLE IF NOT EXISTS tasks (
        id INTEGER PRIMARY KEY AUTOINCREMENT,
        title TEXT,
        description TEXT,
        teacher_id INTEGER,
        student_id INTEGER
            )";
    $pdo->exec($sqlCreateTable);

    echo "Table created and data inserted successfully.";
} catch (PDOException $e) {
    echo "Error: " . $e->getMessage();
}

//Создание таблице Answers
$sqlCreateTable = "CREATE TABLE IF NOT EXISTS answers (
    id INTEGER PRIMARY KEY AUTOINCREMENT,
    task_id INTEGER UNIQUE,
    text TEXT,
    created_at TEXT,
    mark INTEGER,
    marked_at TEXT,
    comment TEXT                               
)";
$pdo->exec($sqlCreateTable);

