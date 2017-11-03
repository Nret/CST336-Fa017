<?php
session_start();

if (!isset($_SESSION['username'])) {  //checks whether the admin is logged in
    header("Location: index.php");
}

function userList(){
  include 'database.php';
  $conn = getDatabaseConnection();
  
  $sql = "SELECT *
          FROM User
          ORDER BY firstName";
  $stmt = $conn->prepare($sql);
  $stmt->execute();
  $records = $stmt->fetchAll(PDO::FETCH_ASSOC);
   
  //print_r($records);
  return $records;
    
}

?>

<!DOCTYPE html>
<html>
    <head>
        <title>Admin Main Page </title>
        <script>
            
            function confirmDelete() {
                
                return confirm("Are you sure you want to delete this user?");
                
            }
            
        </script>
        <link rel="stylesheet" href="css.css">
    </head>
    <body>

            <h1> Admin Main </h1>
            <h2> Welcome <?=$_SESSION['adminName']?>!</h2>
            
            <form action="addUser.php">
                
                <input type="submit" value="Add new user" />
                
            </form>
            
            <br />
            
            <form action="logout.php">
                
                <input type="submit" value="Logout!" />
                
            </form>
            
            <br />
            <div class='gray-bg'>
            <?php
            
             $users = userList();
             
             foreach($users as $user) {
                 
                 
                 echo "<span class='small-id'>" . $user['id'] . "</span> " . $user['firstName'] . " " . $user['lastName'];
                 
                 echo "[<a class='big' href='updateUser.php?userId=".$user['id']."'> Update </a>] ";
                 echo "[<a class='small' onclick='return confirmDelete()' href='deleteUser.php?userId=".$user['id']."'> Delete </a>] <br />";
                 
                 
                 
             }
             
             
             
             ?>
            </div>
    </body>
</html>