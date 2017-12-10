<?php
session_start();

if (!isset($_SESSION["user_id"]) || $_SESSION["user_id"] != "1") {
    header("Location: index.html");
}
?>

<!DOCTYPE html>
<html>
    <head>
        <script src="functions.js"></script>
        <script src="zalgo.js"></script>
        
        <link rel="stylesheet" href="css.css" type="text/css" />
        
        <script src="https://code.jquery.com/jquery-3.1.0.js"></script>
        <!-- Latest compiled and minified CSS -->
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
        
        <!-- Latest compiled JavaScript -->
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    </head>
    <body>
        
        <div class="container-fluid">
            <div class="jumbotron text-center">
                <h1 id='zalgofied'>Admin Page</h1>
                <br><br><br><br><br><br>
                <p><a class='link' href='index.html'>Home</a><span id='add-user' class='link'>Add User</span> <span id='add-product' class='link'>Add Product</span> <span id='add-ownership' class='link'>Add Ownership</span> <span id='view-users' class='link'>View Users</span> <span id='view-products' class='link'>View Products</span> <span id='view-ownerships' class='link'>View Ownerships</span> <span id='view-stats' class='link'>View Some Statistics</span></p> 
            </div>
            <div id='result' class="container-fluid">
                
            </div>
        </div>
        
        
        <script type="text/javascript">
            $("#add-user").click(function() {
                generateInputBoxes("#result", "addUser", {"First Name": "first_name",
                                                          "Last Name": "last_name",
                                                          "User Name": "username", 
                                                          "Password": "password" 
                });
            });
            
            
            $("#add-product").click(function() {
                generateInputBoxes("#result", "addProduct", { "Name": "name",
                                                              "Price": "price",
                                                              "Description": "description" });
            });
            
            
            $("#add-ownership").click(function() {
                generateInputBoxes("#result", "addOwnership", { "User id": "user_id",
                                                                "Product id": "product_id" });
            });
            
            
            $("#view-users").click(function() {
                generateTable("#result", "viewUsers", "editable");
            });
            
            $("#view-products").click(function() {
                generateTable("#result", "viewProducts", "editable");
            });
            
            $("#view-ownerships").click(function() {
                generateTable("#result", "viewOwnerships", "editable");
            });
            
            $("#view-stats").click(function() {
                generateStatsContainer("#result", "viewStats");
            });
            
            zalgoText = "Admin Page";
            
      </script>
    </body>
</html>