<?php
/*
try {
    $conn = new PDO('mysql:host=mysql;dbname=test', 'root', 'root');
      $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
      $data = $conn->query('SELECT * FROM nomes' );
  
    foreach($data as $row) {
        print_r($row); 
    }
  } catch(PDOException $e) {
      echo 'ERROR: ' . $e->getMessage();
  }
  */

$conn = new mysqli(DB_SERVER,DB_USER,DB_PWD,DB_DB);