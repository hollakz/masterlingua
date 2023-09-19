<?php
require ('migration.php');

$db = new  SQLite3('database.sqlite');

$sql = "CREATE TABLE IF NOT EXISTS users (
id INTEGER PRIMARY KEY AUTOINCREMENT,
email TEXT,
password STRING,
level TEXT,
integer INTEGER                     
)";
$db->exec($sql);

$sql = "INSERT INTO users VALUES (1, 'paulchervov', 'pasSworLd102', 'C1', 'admin'),
                         (2, 'hollakz', 'Coca-Holla42', 'А1', 'admin'),
                         (3, 'olga', 'olga-0-conor-99', 'C2', 'admin');";
$db->exec($sql);




