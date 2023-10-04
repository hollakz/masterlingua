<?php

try {
    $pdo = new PDO('sqlite:./database/database.sqlite');
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $sqlCreateTable = "CREATE TABLE IF NOT EXISTS users (
        id INTEGER PRIMARY KEY AUTOINCREMENT,
        username TEXT UNIQUE ,
        password TEXT,
        level TEXT,
        integer INTEGER
    )";
    $pdo->exec($sqlCreateTable);

    $sqlInsertData = "INSERT INTO users (username, password, level, integer) VALUES
        ('admin', 'pasSworLd102', 'A1', 'admin')";
    $pdo->exec($sqlInsertData);

    echo "Table created and data inserted successfully.";
} catch (PDOException $e) {
    echo "Error: " . $e->getMessage();
}




