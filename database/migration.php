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
        date_of_birth TEXT
    )";
    $pdo->exec($sqlCreateTable);

    $sqlInsertData = "INSERT INTO users (username, password, level, role, first_name, last_name, date_of_birth) VALUES
        ('admin', 'pasSworLd102', 'A1', 'admin', 'Alexey', 'Klimenkov', '28.05.1991'),
        ('student1', 'qwe123', 'A1', 'student', 'Sergay', 'Petrov', '22.03.1994'),
        ('teacher1', 'qwe123', 'C2', 'teacher', 'Pavel', 'Ivanov', '11.12.1990')";
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




