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
}

function testValidUser() {
    $username = $_GET["username"];
    
    $conn = getDatabaseConnection();
    
    $sql = "SELECT username from user where username = :username";
    $stmt = $conn->prepare($sql);
    $stmt->execute(array(":username" => $username));
    $records = $stmt->fetchAll();
    
    echo json_encode(array("valid" => (count($records) > 0 ? "false" : "true"))); // valid if username doesn't already exist
    
}

function addUser() {
    $username = $_GET["username"];
    $password = $_GET["password"];
    $firstname = $_GET["firstname"];
    $lastname = $_GET["lastname"];
    $email = $_GET["email"];
    $phone = $_GET["phone"];
    
    $conn = getDatabaseConnection();
    
    $sql = "INSERT INTO user 
        (firstName, lastName, email, phone, username)
        VALUES
        (:firstname, :lastname, :email, :phone, :username)";
    $stmt = $conn->prepare($sql);
    $stmt->execute(array(":username" => $username, 
                         ":firstname" => $firstname, 
                         ":lastname" => $lastname,
                         ":email" => $email, 
                         ":phone" => $phone));
}

if ($_GET["action"] == "testValidUser")
    testValidUser();
else if ($_GET["action"] == "addUser")
    addUser();

?>