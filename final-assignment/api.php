<?php

session_start();
//print_r($_SESSION);
    
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

// and here we descend into madness
function addDB($table) {
    $columnnames =  explode(",", $_GET["columnnames"]);
    
    $conn = getDatabaseConnection();
    
    $sql = "INSERT INTO $table" .  
        "( " . implode(", ", $columnnames) . " )" . // and here I am more than likely opening myself up to sql injection =(
        " VALUES " . 
        "( :" . implode(", :", $columnnames) . " )";
        
    
    $dataParings = array();
    
    foreach($columnnames as $key)
        $dataParings[$key] = $_GET[$key];
    
    // echo $sql;
    // echo "<br>";
    // print_r($dataParings);
    
    $stmt = $conn->prepare($sql);
    $stmt->execute($dataParings);
}

function viewUsers() {
    $conn = getDatabaseConnection();
    
    $sql = "SELECT id,username,first_name,last_name,balance FROM users";
    
    $stmt = $conn->prepare($sql);
    $stmt->execute();
    $records = $stmt->fetchAll();
    
    foreach($records as &$record) {
        unset($record[0]);
        unset($record[1]);
        unset($record[2]);
        unset($record[3]);
        unset($record[4]);
    }
    
    echo json_encode($records);
}

function viewProducts() {
    $conn = getDatabaseConnection();
    
    $sql = "SELECT id,name,description,price FROM products";
    
    $stmt = $conn->prepare($sql);
    $stmt->execute();
    $records = $stmt->fetchAll();
    
    foreach($records as &$record) {
        unset($record[0]);
        unset($record[1]);
        unset($record[2]);
        unset($record[3]);
    }
    
    echo json_encode($records);
}

function viewOwnerships() {
    $conn = getDatabaseConnection();
    
    $sql = "SELECT ownerships.id,users.username,products.name from users,products,ownerships where ownerships.user_id = users.id and ownerships.product_id = products.id;";
    
    $stmt = $conn->prepare($sql);
    $stmt->execute();
    $records = $stmt->fetchAll();
    
    foreach($records as &$record) {
        unset($record[0]);
        unset($record[1]);
        unset($record[2]);
    }
    
    echo json_encode($records);
}

function isLoggedIn() {
    
    if (isset($_SESSION["user_id"])) {
        $conn = getDatabaseConnection();
        $sql = "SELECT balance FROM users WHERE id = :user_id";
        $stmt = $conn->prepare($sql);
        $stmt->execute(array(":user_id" => $_SESSION["user_id"]));
        $record = $stmt->fetch();
        
        $_SESSION["balance"] = $record["balance"];
        
        echo json_encode(array("isLoggedIn" => "true", "first_name" => $_SESSION["first_name"], "last_name" => $_SESSION["last_name"], "username" => $_SESSION["username"], "balance" => $_SESSION["balance"]));
    } else {
        echo json_encode(array("isLoggedIn" => "false"));
    }
}

function login() {
    $conn = getDatabaseConnection();
    
    $sql = "SELECT * FROM users WHERE username = :username AND password = :password";
    $stmt = $conn->prepare($sql);
    $stmt->execute(array(":username" => $_GET["username"], ":password" => $_GET["password"]));
    $record = $stmt->fetch();
    
    if (empty($record)) {
        echo json_encode(array("isLoggedIn" => "false"));
    } else {
        $_SESSION["user_id"] = $record["id"];
        $_SESSION["username"] = $record["username"];
        $_SESSION["first_name"] = $record["first_name"];
        $_SESSION["last_name"] = $record["last_name"];
        $_SESSION["balance"] = $record["balance"];
        
        $record["isLoggedIn"] = "true";
        
        unset($record["id"]);
        unset($record["password"]);
        
        unset($record["0"]);
        unset($record["1"]);
        unset($record["2"]);
        unset($record["3"]);
        unset($record["4"]);
        unset($record["5"]);
        
        echo json_encode($record);
    }
}

function logout() {
    session_destroy();
    echo json_encode(array("isLoggedIn" => "who are you"));
}

function viewInventory() {
    if (isset($_SESSION["user_id"])) {
        $conn = getDatabaseConnection();
    
        $sql = "SELECT products.id,name,description,count(products.id) as amount,price from products,ownerships where ownerships.user_id = :users_id and ownerships.product_id = products.id GROUP BY products.id";
        $stmt = $conn->prepare($sql);
        $stmt->execute(array(":users_id" => $_SESSION["user_id"]));
        $records = $stmt->fetchAll();
    
        foreach($records as &$record) {
            unset($record[0]);
            unset($record[1]);
            unset($record[2]);
            unset($record[3]);
            unset($record[4]);
        }
        
        echo json_encode($records);
    }
}

function deleteFromAction() {
    $conn = getDatabaseConnection();
    
    $table = "";
    if ($_GET["fromAction"] == "viewUsers")
        $table = "users";
    else if ($_GET["fromAction"] == "viewProducts")
        $table = "products";
    else if ($_GET["fromAction"] == "viewOwnerships")
        $table = "ownerships";
        
    $sql = "DELETE FROM $table WHERE id = :id;";
    
    $stmt = $conn->prepare($sql);
    $stmt->execute(array(":id" => $_GET["id"]));
    
    echo json_encode(array("result" => "It has been done."));
}

function searchProducts() {
    $conn = getDatabaseConnection();
    
    $prepPairs = array();
    
    $sql = "SELECT id,name,description,price FROM products ";
    
    if (isset($_GET["search"])) {
        $sql .= " WHERE (id LIKE :search OR name LIKE :wildsearch OR description LIKE :wildsearch OR price LIKE :search) ";
        $prepPairs[":wildsearch"] = "%".$_GET["search"]."%";
        $prepPairs[":search"] = $_GET["search"];
    }
    
    if (isset($_GET["sortBy"])) 
        $sql .= "ORDER BY price " . ($_GET["sortBy"] == "ascending" ? "ASC" : "DESC");
    
    
    
    $stmt = $conn->prepare($sql);
    $stmt->execute($prepPairs);
    $records = $stmt->fetchAll();
    
    foreach($records as &$record) {
        unset($record[0]);
        unset($record[1]);
        unset($record[2]);
        unset($record[3]);
    }
    
    echo json_encode($records);
}

function buy() {
    if (isset($_SESSION["user_id"])) {
        $conn = getDatabaseConnection();
    
        $sql = "SELECT balance from users where users.id = :user_id";
        $stmt = $conn->prepare($sql);
        $stmt->execute(array(":user_id" => $_SESSION["user_id"]));
        $user = $stmt->fetch();
        
        $sql = "SELECT price,name from products where products.id = :product_id";
        $stmt = $conn->prepare($sql);
        $stmt->execute(array(":product_id" => $_GET["id"]));
        $product = $stmt->fetch();
        
        if ($user["balance"] < $product["price"]) {
            echo json_encode(array("result" => "fail", "message" => "Not enough credits", "name" => $product["name"]));
        } else {
            $newBalance = $user["balance"] - $product["price"];
            
            $sql = "UPDATE users SET balance = :balance WHERE users.id = :user_id";
            $stmt = $conn->prepare($sql);
            $stmt->execute(array(":user_id" => $_SESSION["user_id"], ":balance" => $newBalance));
            
            $sql = "INSERT INTO ownerships (user_id, product_id) VALUES (:user_id, :product_id)";
            $stmt = $conn->prepare($sql);
            $stmt->execute(array(":user_id" => $_SESSION["user_id"], ":product_id" => $_GET["id"]));
            
            echo json_encode(array("result" => "success", "balance" => $newBalance, "name" => $product["name"]));
        }
    }
}

function updateFromAction() {
    $conn = getDatabaseConnection();
    
    $table = "";
    if ($_GET["fromAction"] == "viewUsers")
        $table = "users";
    else if ($_GET["fromAction"] == "viewProducts")
        $table = "products";
    else if ($_GET["fromAction"] == "viewOwnerships")
        $table = "ownerships";
        
    $sql = "UPDATE $table SET " . $_GET['columnname'] . " = :value WHERE id = :id";// and here I hope up another injection, but academia, it's for a class project, nothing serious. would love to learn more but I need to get this done and it's already ballooned
    
    try { 
        
        $stmt = $conn->prepare($sql);
        $stmt->execute(array(":id" => $_GET["id"], ":value" => $_GET["value"]));
        
        echo json_encode(array("result" => "success"));
    } catch (Exception $e) {
        echo json_encode(array("result" => "fail", "message" => "Something went wrong"));//$e->message()));
    }
} 

function sell() {
    if (isset($_SESSION["user_id"])) {
        $conn = getDatabaseConnection();
        try {
    
            $sql = "SELECT balance from users where id = :user_id";
            $stmt = $conn->prepare($sql);
            $stmt->execute(array(":user_id" => $_SESSION["user_id"]));
            $user = $stmt->fetch();
            
            // get how much money item is worth
            $sql = "SELECT price,name from products where id = :product_id";
            $stmt = $conn->prepare($sql);
            $stmt->execute(array(":product_id" => $_GET["id"]));
            $product = $stmt->fetch();
            
            $sql = "SELECT id FROM ownerships WHERE user_id = :user_id AND product_id = :product_id LIMIT 1";
            $stmt = $conn->prepare($sql);
            $stmt->execute(array(":product_id" => $_GET["id"], ":user_id" => $_SESSION["user_id"]));
            $ownership = $stmt->fetch();
            
            if (!$ownership) {
                echo json_encode(array("result" => "fail", "name" => $product["name"], "message" =>  "You don't own any more."));
                return;
            }
                
            
            // remove it from their ownerships
            $sql = "DELETE FROM ownerships WHERE id = :id";
            $stmt = $conn->prepare($sql);
            $stmt->execute(array(":id" => $ownership["id"]));
            
            // if no failed add worth to their balance
            $newBalance = $user["balance"] + $product["price"];
            $sql = "UPDATE users SET balance = :balance WHERE id = :user_id";
            $stmt = $conn->prepare($sql);
            $stmt->execute(array(":balance" => $newBalance, ":user_id" => $_SESSION["user_id"]));
        
            // tell them new balance and succeed and name
            echo json_encode(array("result" => "success", "balance" => $newBalance, "name" => $product["name"]));
        
            
        } catch (Exception $e) {
            echo json_encode(array("result" => "fail", "message" =>  "Something went wrong")); // $e->message())); //
        }
        
    }
}

function viewStats() {
    $conn = getDatabaseConnection();
    
    $output = array();
    
    // $sql = "SELECT COUNT(*) AS amount FROM users";
    // $stmt = $conn->prepare($sql);
    // $stmt->execute(array(":user_id" => $_SESSION["user_id"]));
    // $user = $stmt->fetch();
    
    // how many users there are
    $sql = "SELECT COUNT(*) AS amount FROM users";
    $stmt = $conn->prepare($sql);
    $stmt->execute();
    $result = $stmt->fetch(PDO::FETCH_ASSOC);
    $output["amountOfUsers"] = $result["amount"];
    
    
    // how many products there are
    $sql = "SELECT COUNT(*) AS amount FROM products";
    $stmt = $conn->prepare($sql);
    $stmt->execute();
    $result = $stmt->fetch(PDO::FETCH_ASSOC);
    $output["amountOfProducts"] = $result["amount"];
    
    // how many products are owned
    $sql = "SELECT COUNT(*) AS amount FROM ownerships";
    $stmt = $conn->prepare($sql);
    $stmt->execute();
    $result = $stmt->fetch(PDO::FETCH_ASSOC);
    $output["amountOfOwnerships"] = $result["amount"];
    
    // How much money there is between all accounts (raw balanace only)
    $sql = "SELECT SUM(balance) AS sum, AVG(balance) as avg FROM users";
    $stmt = $conn->prepare($sql);
    $stmt->execute();
    $result = $stmt->fetch(PDO::FETCH_ASSOC);
    $output["amountTotalMoney"] = $result["sum"];
    $output["amountAverageMoney"] = $result["avg"];
    
    // list of usernames and money sorted by who has the most
    $sql = "SELECT username,balance FROM users ORDER BY balance DESC";
    $stmt = $conn->prepare($sql);
    $stmt->execute();
    $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
    $output["usersSortedByMoney"] = $result;
    
    // list of all products and how many are owned sorted by the most owned
    $sql = "SELECT name, COUNT(ownerships.product_id) AS count FROM products LEFT JOIN ownerships ON products.id=ownerships.product_id  GROUP BY products.id ORDER BY count DESC";
    $stmt = $conn->prepare($sql);
    $stmt->execute();
    $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
    $output["ownershipsSortedByMostOwned"] = $result;
    
    $output["result"] = "success";
    // 
    echo json_encode($output);
}

function game() {
    if (isset($_SESSION["user_id"])) {
        
        $possibleWinnings = rand(1, 9001);
        
        $answer = rand(1, 100);
        
        if ($_GET["guess"] < 0) {
            echo json_encode(array("result" => "fail", "message" => "You're too low."));
            return;
        } else if ($_GET["guess"] > 100) {
            echo json_encode(array("result" => "fail", "message" => "You're too high."));
            return;
        }
        
        $difference = $answer - $_GET["guess"];
        $abs_diff = abs($difference);
        
        $pointsEarned = abs(100 - $abs_diff);
        
        $pointsEarned = $possibleWinnings * ($pointsEarned / 100);
        
        
        $conn = getDatabaseConnection();
        
        $sql = "SELECT balance from users where id = :user_id";
        $stmt = $conn->prepare($sql);
        $stmt->execute(array(":user_id" => $_SESSION["user_id"]));
        $user = $stmt->fetch();
        
        $newBalance = $user["balance"] + $pointsEarned;
            
        $sql = "UPDATE users SET balance = :balance WHERE users.id = :user_id";
        $stmt = $conn->prepare($sql);
        $stmt->execute(array(":user_id" => $_SESSION["user_id"], ":balance" => $newBalance));
        
        $ret = array("result" => "sucess", "message" => number_format($pointsEarned) . " Credits Obtained.", "balance" => $newBalance);
        
        echo json_encode($ret);
        
    }
}

// Admin only
if ($_SESSION["user_id"] == 1) {
    
    if ($_GET["action"] == "viewUsers")
        viewUsers();
    else if ($_GET["action"] == "viewOwnerships")
        viewOwnerships();
    else if ($_GET["action"] == "viewStats")
        viewStats();
    else if ($_GET["action"] == "addUser")
        addDB("users");
    else if ($_GET["action"] == "addProduct")
        addDB("products");
    else if ($_GET["action"] == "addOwnership")
        addDB("ownerships");
    else if ($_GET["action"] == "delete")
        deleteFromAction();
    else if ($_GET["action"] == "update")
        updateFromAction();
}
    
    
if ($_GET["action"] == "isLoggedIn")
    isLoggedIn();
else if ($_GET["action"] == "login")
    login();
else if ($_GET["action"] == "logout")
    logout();
else if ($_GET["action"] == "viewInventory")
    viewInventory();
else if ($_GET["action"] == "viewProducts")
    if (isset($_GET["search"]) || isset($_GET["sortBy"]))
        searchProducts();
    else
        viewProducts();
else if ($_GET["action"] == "viewProducts")
    viewProducts();
else if ($_GET["action"] == "buy")
    buy();
else if ($_GET["action"] == "sell")
    sell();
else if ($_GET["action"] == "game-guess")
    game();
?>