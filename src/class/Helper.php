<?php

class Helper {

   static function json(String|Array $data, Int $status = 200) {
      header('Content-Type: application/json');
      http_response_code($status);
      if($status === 204) 
         return;
      
      echo json_encode(is_array($data) ? $data : ['message' => $data]);
      exit();
   }

   static function now(): string {
      return date('Y-m-d\TH:i:s');
   }

}