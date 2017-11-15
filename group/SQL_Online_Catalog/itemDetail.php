<?php
function displayInfo(){
    include 'database.php';
    $conn = getDatabaseConnection();
    
    $sql = "SELECT *
            FROM csbooks
            WHERE title =" .'"' . $_GET["title"] .'"';

    $stmt = $conn->prepare($sql);
    $stmt->execute();
    $records = $stmt->fetch(PDO::FETCH_ASSOC);
    
    $sql2 = "SELECT *
            FROM nonfiction
            WHERE title =" .'"' . $_GET["title"] .'"';
            
    $sql3 = "SELECT *
            FROM fiction
            WHERE title =" .'"' . $_GET["title"] .'"';
            
    echo "Title: " . $records["title"];
    echo "<br>";
    echo "Author: " . $records["author"];
    echo "<br>";
    echo "ISBN: " . $records["ibsn"];
    echo "<br>";
    echo "Year: " . $records["year"];
    echo "<br>";
    echo "Page Count: " . $records["pages"];
}
?>

<!DOCTYPE html>
<html>
    <head>
    </head>
    <body>
        <?=displayInfo()?>
    </body>
</html>