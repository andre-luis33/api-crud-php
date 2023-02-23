<?php

require('./src/class/Database.php');

class CarRepository {

   static function create(String $model, Int $year, String $color, Float $price, String $licensePlate): bool {

      $db = Database::connect();
      $now = Helper::now();

      $query = "INSERT INTO cars (model, year, color, price, license_plate, created_at) VALUES (:model, {$year}, :color, {$price}, :license_plate, '{$now}')";
      
      $stmt = $db->prepare($query);
      $stmt->bindValue(':model', $model, PDO::PARAM_STR);
      $stmt->bindValue(':color', $color, PDO::PARAM_STR);
      $stmt->bindValue(':license_plate', $licensePlate, PDO::PARAM_STR);

      return (bool) $stmt->execute();
   }

   static function update(Int $id, String $model, Int $year, String $color, Float $price, String $licensePlate): bool {

      $db = Database::connect();
      $now = Helper::now();

      $query = "UPDATE cars SET model = :model, year = {$year}, color = :color, price = {$price}, license_plate = :license_plate WHERE id = {$id}";
      
      $stmt = $db->prepare($query);
      $stmt->bindValue(':model', $model, PDO::PARAM_STR);
      $stmt->bindValue(':color', $color, PDO::PARAM_STR);
      $stmt->bindValue(':license_plate', $licensePlate, PDO::PARAM_STR);

      return (bool) $stmt->execute();
   }

   static function delete(Int $id): bool {
      $db = Database::connect();
      $query = "DELETE FROM cars WHERE id = {$id}";
      return (bool) $db->query($query);
   }

   static function findAll() {
      $db = Database::connect();
      $query = "SELECT * FROM cars";
      return $db->query($query)->fetchAll(PDO::FETCH_OBJ);
   }

   static function findById(Int $id, $fields = '*') {
      $db = Database::connect();
      $query = "SELECT {$fields} FROM cars WHERE id = {$id}";
      return $db->query($query)->fetch(PDO::FETCH_OBJ);
   }

   static function findByLicensePlate(String $licensePlate) {
      $db = Database::connect();

      $query = "SELECT * FROM cars WHERE license_plate = :license_plate";
      $stmt = $db->prepare($query);
      $stmt->bindValue(':license_plate', $licensePlate, PDO::PARAM_STR);

      $execution = $stmt->execute();
      return !$execution ? false : $stmt->fetch(PDO::FETCH_OBJ);
   }

}