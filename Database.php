<?php

function getDatabaseConnection()
{
    $host = "us-cdbr-iron-east-05.cleardb.net";
    $username = "bba4551462c3eb";
    $password = "4ffbc094";
    $dbname="heroku_9426e7a5fd13ba3";
    
    $dbConn = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    $dbConn -> setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
    return $dbConn;
    
    
    
    
    $host = "localhost";
    $username = "root";
    $password = "cst336";
    $dbname="tech_devices_app";

// Create connection
    $conn = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    return $conn;
    
  }

?>