<?php

class Database {
   
   const DB_PATH = './src/database/db.sqlite3';

   static function connect(): PDO {
      $db = new PDO('sqlite:'.self::DB_PATH);
      return $db;
   }
   
}