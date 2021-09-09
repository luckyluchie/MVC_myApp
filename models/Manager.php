<?php

class Manager 
{
  // Connexion à la base de données, fonction dbConnect() à appeler dans les autres parties du code
  // protected pour être disponible dans les classes filles
  protected function dbConnect() 
  {
      try {
          $db = new PDO('mysql:host=localhost;dbname=db_blog_one;charset=utf8', 'root', '');
        return $db;
      } catch(Exception $e) {
        print_r($e);
    }
    
  }
}