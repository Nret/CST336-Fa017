<?php
function getDatabaseConnection(){
    $host = "us-cdbr-iron-east-05.cleardb.net";
    $username = "b5e6d1a0e56ec3";
    $password = "275bf378";
    $dbname = "heroku_13c04fde7f2eac6"; 
    
    $conn = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    return $conn;
  }
?>