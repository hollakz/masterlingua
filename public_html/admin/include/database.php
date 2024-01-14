<?php
//$pdo = new PDO('sqlite:/home/c/cb37211/masterlingua/database/database.sqlite');
//$pdo = new PDO('sqlite:/Users/pavelchervov/PhpstormProjects/masterlingua/database/database.sqlite');
$pdo = new PDO('sqlite:C:\Users\holla\PhpstormProjects\masterlingua\database\database.sqlite');
//$pdo = new PDO('sqlite:C:\Users\Алёна\PhpstormProjects\masterlingua\database\database.sqlite');
$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
