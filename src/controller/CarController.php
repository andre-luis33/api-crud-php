<?php

require('./src/repository/CarRepository.php');

class CarController {

   static function index() {
      $cars = CarRepository::findAll();
      Helper::json($cars);
   }

   static function show(Int $id) {
      $car = CarRepository::findById($id);
      $car ? Helper::json((array) $car) : Helper::json('Car not found', 404);
   }

   static function store() {
      $payload = json_decode(file_get_contents('php://input'));
      
      $model = $payload->model;
      $year  = $payload->year;
      $color = $payload->color;
      $price = $payload->price;
      $licensePlate = $payload->license_plate;

      $requiredValues = [
         'model' => $payload->model,
         'year'  => $payload->year,
         'color' => $payload->color,
         'price' => $payload->price,
         'license_plate' => $payload->license_plate
      ];

      foreach($requiredValues as $key => $value) {
         if(!$value)
            Helper::json('Parameter {'.$key.'} is required', 400);
      }

      $carExists = CarRepository::findByLicensePlate($licensePlate);
      if($carExists)
         Helper::json('Car with the given license plate already exists', 400);
      

      try {
         CarRepository::create($model, $year, $color, $price, $licensePlate);
         Helper::json('Car created :D', 201);
      } catch (Exception) {
         Helper::json('Internal Server Error', 500);
      }
   }

   static function update(Int $id) {
      $car = CarRepository::findById($id, 'count(*) as total');
      if(!$car->total)
         Helper::json('Car not found', 404);

      $payload = json_decode(file_get_contents('php://input'));
   
      $model = $payload->model;
      $year  = $payload->year;
      $color = $payload->color;
      $price = $payload->price;
      $licensePlate = $payload->license_plate;

      $requiredValues = [
         'model' => $payload->model,
         'year'  => $payload->year,
         'color' => $payload->color,
         'price' => $payload->price,
         'license_plate' => $payload->license_plate
      ];

      foreach($requiredValues as $key => $value) {
         if(!$value)
            Helper::json('Parameter {'.$key.'} is required', 400);
      }

      $carWithLicesePlate = CarRepository::findByLicensePlate($licensePlate);
      if($carWithLicesePlate && $carWithLicesePlate->id != $id)
         Helper::json('Car with the given license plate already exists', 400);

      try {
         CarRepository::update($id, $model, $year, $color, $price, $licensePlate);
         Helper::json('', 204);
      } catch (Exception) {
         Helper::json('Internal Server Error', 500);
      }
   }

   static function delete(Int $id) {
      $car = CarRepository::findById($id, 'count(*) as total');
      if(!$car->total)
         Helper::json('Car not found', 404);

      try {
         CarRepository::delete($id);
         Helper::json('', 204);
      } catch (Exception) {
         Helper::json('Internal Server Error', 500);
      }
   }

}