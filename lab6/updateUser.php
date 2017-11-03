<?php
session_start();

    if (!isset($_SESSION['username'])) {
        header("Location: index.php");
    }


  include 'database.php';
  $conn = getDatabaseConnection();
  
function getUserInfo() {
    global $conn;
    
    $sql = "SELECT * 
            FROM User
            WHERE id = " . $_GET['userId']; 
    
    $stmt = $conn->prepare($sql);
    $stmt->execute();
    $record = $stmt->fetch(PDO::FETCH_ASSOC);
    print_r($record);
    
    return $record;

}

function departmentList(){
      
        global $conn;
        
        $sql = "SELECT * FROM Departments ORDER BY name";
        $stmt = $conn->prepare($sql);
        $stmt->execute();
        $records = $stmt->fetchAll(PDO::FETCH_ASSOC);
        
        return $records;
    }


 if (isset($_GET['updateUser'])) { //checks whether admin has submitted form.
     
     //echo "Form has been submitted!";
     
     $sql = "UPDATE User
             SET firstName = :fName,
                 lastName  = :lName
             WHERE id = :id";
     $np = array();
     
     $np[':fName'] = $_GET['firstName'];
     $np[':lName'] = $_GET['lastName'];
     $np[':id'] = $_GET['userId'];
     
     $stmt = $conn->prepare($sql);
     $stmt->execute($np);
     
     echo "Record has been updated!";
     
 }


 if (isset($_GET['userId'])) {
     
    $userInfo = getUserInfo(); 
     
     
 }



?>


<!DOCTYPE html>
<html>
    <head>
        <title> Update User </title>
    </head>
    <body>

        <h1> Tech Checkout System: Updating User's Info </h1>
        <form method="GET">
            <input type="hidden" name="userId" value="<?=$userInfo['id']?>" />
            First Name:<input type="text" name="firstName" value="<?=$userInfo['firstName']?>" />
            <br />
            Last Name:<input type="text" name="lastName" value="<?=$userInfo['lastName']?>"/>
            <br/>
            Email: <input type= "email" name ="email" value="<?=$userInfo['email']?>"/>
            <br/>
            Phone Number: <input type ="text" name= "phone" value="<?=$userInfo['phone']?>"/>
            <br />
           Role: 
           <select name="role">
                <option value=""> - Select One - </option>
                <option value="Staff"  <?=($userInfo['role']=='Staff')?" selected":"" ?> >Staff</option>
                <option value="Student" <?=($userInfo['role']=='Student')?" selected":"" ?> >Student</option>
                <option value="Faculty" <?=($userInfo['role']=='Faculty')?" selected":"" ?> >Faculty</option>
            </select>
            <br />
            Department: 
            <select name="deptId">
                <option value="" > - Select One - </option>
                <option value="1" <?= $userInfo['deptId'] == 1 ? " selected" : "" ?> >Computer Science</option>
                <option value="2" <?= $userInfo['deptId'] == 2 ? " selected" : "" ?> >Statistics</option>
                <option value="3" <?= $userInfo['deptId'] == 3 ? " selected" : "" ?> >Design</option>
                <option value="4" <?= $userInfo['deptId'] == 4 ? " selected" : "" ?> >Econmics</option>
                <option value="5" <?= $userInfo['deptId'] == 5 ? " selected" : "" ?> >Drama</option>
                <option value="6" <?= $userInfo['deptId'] == 6 ? " selected" : "" ?> >Biology</option>
            </select>
            <input type="submit" value="Update User" name="updateUser">
        </form>

    </body>
</html>