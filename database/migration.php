<?php

try {
    $pdo = new PDO('sqlite:./database/database.sqlite');
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $sqlCreateTable = "CREATE TABLE IF NOT EXISTS users (
        id INTEGER PRIMARY KEY AUTOINCREMENT,
        username TEXT,
        password TEXT,
        level TEXT,
        integer INTEGER
    )";
    $pdo->exec($sqlCreateTable);

    $sqlInsertData = "INSERT INTO users (username, password, level, integer) VALUES
        ('paulcervov', 'pasSworLd102', 'C1', 'admin'),
        ('hollakz', 'Coca-Holla42', 'А1', 'admin'),
        ('olga', 'olga-0-conor-99', 'C2', 'admin')";
    $pdo->exec($sqlInsertData);

    echo "Table created and data inserted successfully.";
} catch (PDOException $e) {
    echo "Error: " . $e->getMessage();
}




