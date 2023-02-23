<?php

const DB_PATH = './src/database/db.sqlite3';

if(file_exists(DB_PATH)) 
   exit('Error, database already exists!');

$extensionPDO = 'pdo_sqlite';
$extenstionSqlite = 'sqlite3';

$loadedExtensions = get_loaded_extensions();

if(!in_array($extensionPDO, $loadedExtensions) || !in_array($extenstionSqlite, $loadedExtensions)) 
   exit("Error, you must have theese extenstions to work: {$extensionPDO}, {$extensionSqlite}");

$file = fopen(DB_PATH, 'w');
fclose($file);

$db = new PDO('sqlite:'.DB_PATH);

$tableQuery = "CREATE TABLE cars (
   id    INTEGER PRIMARY KEY AUTOINCREMENT,
   model VARCHAR NOT NULL,
   year  INTEGER NOT NULL,
   color VARCHAR NOT NULL,
   price DECIMAL(8,2),
   license_plate VARCHAR NOT NULL UNIQUE,
   created_at TEXT DEFAULT CURRENT_TIMESTAMP
);";

$db->exec($tableQuery);