<?php 
include 'database.php';
$conn = getDatabaseConnection();

function passData($isbn) {
    session_start();
    $isbns = $_SESSION['isbns'];
    if (empty($isbns)) {
        $isbns = array();
        $_SESSION['isbns'] = array();
    }
}

function display() {
    if (isset($_GET['catagorySubmit'])) {
        loadBooksByCatagory($_GET['catagoryFilter'], $_GET['sortOrder']);
    } else if (isset($_GET['yearSubmit'])) {
        loadBooksByYear($_GET['greaterThan'], $_GET["sortOrderYear"]);
    } else if (isset($_GET['versionSubmit'])) {
        loadBooksByVersion($_GET['versionEqualTo'], $_GET['sortOrderVer']);
    } else if (isset($_GET['displayAll'])) {
        loadAllBooks("title", "asc");
    }
}

function loadAllBooks($sort, $by) {
    global $conn;
    $sql = "SELECT * 
            FROM csbooks
            ORDER BY $sort $by";
            
    $statement= $conn->prepare($sql); 
    $statement->execute();
    $records = $statement->fetchALL(PDO::FETCH_ASSOC);  
    
    echo "<table>";
    
    echo "<tr>";
        echo "<th>Title</th>";
        echo "<th>Author</th>";
        echo "<th>ISBN</th>";
        echo "<th>Year</th>";
        echo "<th></th>";
        echo "<th></th>";
    echo "</tr>";
    
    foreach($records as $record) {
        echo "<tr>";
            echo "<td>" . $record['title'] . "</td>";
            echo "<td>" . $record['author'] . "</td>";
            echo "<td>" . $record['ibsn'] . "</td>";
            echo "<td>" . $record['year'] . "</td>";
            echo "<td><a href='itemDetail.php?title=" . $record['title'] . "'>More Info</a></td>";
            echo "<td><a href='./cart.php?bookISBN=" . $record['title'] . "'>Add To Cart</a></td>";
        echo "</tr>";
    }
    
    echo "</table>";
    
    $sql2 = "SELECT * 
            FROM fiction
            ORDER BY $sort $by";
            
    $statement2 = $conn->prepare($sql2); 
    $statement2->execute();
    $records2 = $statement2->fetchALL(PDO::FETCH_ASSOC);  
    
    echo "<table>";
    
    echo "<tr>";
        echo "<th>Title</th>";
        echo "<th>Author</th>";
        echo "<th>Year</th>";
        echo "<th>Pages</th>";
        echo "<th></th>";
        echo "<th></th>";
    echo "</tr>";
    
    foreach($records2 as $record2) {
        echo "<tr>";
            echo "<td>" . $record2['title'] . "</td>";
            echo "<td>" . $record2['author'] . "</td>";
            echo "<td>" . $record2['year'] . "</td>";
            echo "<td>" . $record2['pages'] . "</td>";
            echo "<td><a href='itemDetail.php?title=" . $record['title'] . "'>More Info</a></td>";
            echo "<td><a href='./cart.php?bookISBN=" . $record2['title'] . "'>Add To Cart</a></td>";
        echo "</tr>";
    }
    
    echo "</table>";
    
    $sql3 = "SELECT * 
        FROM nonfiction
        ORDER BY $sort $by";
            
    $statement3 = $conn->prepare($sql3); 
    $statement3->execute();
    $records3 = $statement3->fetchALL(PDO::FETCH_ASSOC);  
    
    echo "<table>";
    
    echo "<tr>";
        echo "<th>Title</th>";
        echo "<th>Author</th>";
        echo "<th>Year</th>";
        echo "<th>Pages</th>";
        echo "<th></th>";
        echo "<th></th>";
    echo "</tr>";
    
    
    foreach($records3 as $record3) {
        echo "<tr>";
            echo "<td>" . $record3['title'] . "</td>";
            echo "<td>" . $record3['author'] . "</td>";
            echo "<td>" . $record3['year'] . "</td>";
            echo "<td>" . $record3['pages'] . "</td>";
            echo "<td><a href='itemDetail.php?title=" . $record['title'] . "'>More Info</a></td>";
            echo "<td><a href='./cart.php?bookISBN=" . $record3['title'] . "'>Add To Cart</a></td>";
        echo "</tr>";
    }
    
    echo "</table>";
}

function loadBooksByCatagory($filter, $sort) {
    global $conn;
    
    if($filter == csbooks){
        $sql = "SELECT * 
            FROM csbooks
            ORDER BY title $sort";
            
        $statement= $conn->prepare($sql); 
        $statement->execute();
        $records = $statement->fetchALL(PDO::FETCH_ASSOC);  
        
        echo "<table>";
        echo "<tr>";
            echo "<th>Title</th>";
            echo "<th>Author</th>";
            echo "<th>Category</th>";
            echo "<th>ISBN</th>";
            echo "<th>Year</th>";
            echo "<th></th>";
            echo "<th></th>";
        echo "</tr>";
        
        foreach($records as $record) {
            echo "<tr>";
                echo "<td>" . $record['title'] . "</td>";
                echo "<td>" . $record['author'] . "</td>";
                echo "<td>" . $record['ibsn'] . "</td>";
                echo "<td>" . $record['year'] . "</td>";
                echo "<td><a href='itemDetail.php?title=" . $record['title'] . "'>More Info</a></td>";
                echo "<td><a href='./cart.php?bookISBN=" . $record['title'] . "'>Add To Cart</a></td>";
            echo "</tr>";
        }
        
        echo "</table>";
    }
    
    if($filter == fiction){
        echo "</table>";
    
        $sql2 = "SELECT * 
                FROM fiction
                ORDER BY title $sort";
                
        $statement2 = $conn->prepare($sql2); 
        $statement2->execute();
        $records2 = $statement2->fetchALL(PDO::FETCH_ASSOC);  
        
        echo "<table>";
        
        echo "<tr>";
            echo "<th>Title</th>";
            echo "<th>Author</th>";
            echo "<th>Year</th>";
            echo "<th>Pages</th>";
            echo "<th></th>";
            echo "<th></th>";
        echo "</tr>";
        
        foreach($records2 as $record2) {
            echo "<tr>";
                echo "<td>" . $record2['title'] . "</td>";
                echo "<td>" . $record2['author'] . "</td>";
                echo "<td>" . $record2['year'] . "</td>";
                echo "<td>" . $record2['pages'] . "</td>";
                echo "<td><a href='itemDetail.php?title=" . $record['title'] . "'>More Info</a></td>";
                echo "<td><a href='./cart.php?bookISBN=" . $record2['title'] . "'>Add To Cart</a></td>";
            echo "</tr>";
        }
        
        echo "</table>";
    }
    
    if($filter == nonfiction){
        $sql3 = "SELECT * 
            FROM nonfiction
            ORDER BY title $sort";
                
        $statement3 = $conn->prepare($sql3); 
        $statement3->execute();
        $records3 = $statement3->fetchALL(PDO::FETCH_ASSOC);  
        
        echo "<table>";
        
        echo "<tr>";
            echo "<th>Title</th>";
            echo "<th>Author</th>";
            echo "<th>Year</th>";
            echo "<th>Pages</th>";
            echo "<th></th>";
            echo "<th></th>";
        echo "</tr>";
        
        
        foreach($records3 as $record3) {
            echo "<tr>";
                echo "<td>" . $record3['title'] . "</td>";
                echo "<td>" . $record3['author'] . "</td>";
                echo "<td>" . $record3['year'] . "</td>";
                echo "<td>" . $record3['pages'] . "</td>";
                echo "<td><a href='itemDetail.php?title=" . $record['title'] . "'>More Info</a></td>";
                echo "<td><a href='./cart.php?bookISBN=" . $record3['title'] . "'>Add To Cart</a></td>";
            echo "</tr>";
        }
        
        echo "</table>";
    }

}

function loadBooksByYear($filter, $sort) {
    global $conn;
    
    if (empty($filter)) {
        echo "<div class='word'>No books from that year</div>";
    }
    else {
        $sql = "SELECT * 
            FROM csbooks
            WHERE year > '$filter'
            ORDER BY title $sort";
            
        $statement= $conn->prepare($sql); 
        $statement->execute();
        $records = $statement->fetchALL(PDO::FETCH_ASSOC);  
        
        echo "<table>";
        echo "<tr>";
            echo "<th>Title</th>";
            echo "<th>Author</th>";
            echo "<th>ISBN</th>";
            echo "<th>Year</th>";
            echo "<th></th>";
            echo "<th></th>";
        echo "</tr>";
        
        foreach($records as $record) {
            echo "<tr>";
                echo "<td>" . $record['title'] . "</td>";
                echo "<td>" . $record['author'] . "</td>";
                echo "<td>" . $record['ibsn'] . "</td>";
                echo "<td>" . $record['year'] . "</td>";
                echo "<td><a href='itemDetail.php?title=" . $record['title'] . "'>More Info</a></td>";
                echo "<td><a href='./cart.php?bookISBN=" . $record['title'] . "'>Add To Cart</a></td>";
            echo "</tr>";
        }
        
        echo "</table>";
        
        $sql2 = "SELECT * 
            FROM fiction
            WHERE year > '$filter'
            ORDER BY title $sort";
            
        $statement2 = $conn->prepare($sql2); 
        $statement2->execute();
        $records2 = $statement2->fetchALL(PDO::FETCH_ASSOC);  
        
        echo "<table>";
        
        echo "<tr>";
            echo "<th>Title</th>";
            echo "<th>Author</th>";
            echo "<th>Year</th>";
            echo "<th>Pages</th>";
            echo "<th></th>";
            echo "<th></th>";
        echo "</tr>";
        
        foreach($records2 as $record2) {
            echo "<tr>";
                echo "<td>" . $record2['title'] . "</td>";
                echo "<td>" . $record2['author'] . "</td>";
                echo "<td>" . $record2['year'] . "</td>";
                echo "<td>" . $record2['pages'] . "</td>";
                echo "<td><a href='itemDetail.php?title=" . $record['title'] . "'>More Info</a></td>";
                echo "<td><a href='./cart.php?bookISBN=" . $record2['title'] . "'>Add To Cart</a></td>";
            echo "</tr>";
        }
        
        echo "</table>";
        
        $sql3 = "SELECT * 
            FROM nonfiction
            WHERE year > '$filter'
            ORDER BY title $sort";
                
        $statement3 = $conn->prepare($sql3); 
        $statement3->execute();
        $records3 = $statement3->fetchALL(PDO::FETCH_ASSOC);  
        
        echo "<table>";
        
        echo "<tr>";
            echo "<th>Title</th>";
            echo "<th>Author</th>";
            echo "<th>Year</th>";
            echo "<th>Pages</th>";
            echo "<th></th>";
            echo "<th></th>";
        echo "</tr>";
        
        foreach($records3 as $record3) {
            echo "<tr>";
                echo "<td>" . $record3['title'] . "</td>";
                echo "<td>" . $record3['author'] . "</td>";
                echo "<td>" . $record3['year'] . "</td>";
                echo "<td>" . $record3['pages'] . "</td>";
                echo "<td><a href='itemDetail.php?title=" . $record['title'] . "'>More Info</a></td>";
                echo "<td><a href='./cart.php?title=" . $record3['title'] . "'>Add To Cart</a></td>";
            echo "</tr>";
        }
        echo "</table>";
    }
}
?>

<!doctype html>
<html>
    <head>
        <link rel="stylesheet" type="text/css" href="css/styles.css">
        <title>Team Project</title>    
    </head>
          
    <main>
        <body>
            
            <h1>Books</h1>
            <?=passData("")?>
            <h4><a href="cart.php">View Cart</a></h4>
            <hr>
            
            <form>
                <div class="cate">
                View by Category
                <br><br>
                Category: 
                <select name="catagoryFilter">
                    <option value="csbooks">Computer Science</option>
                    <option value="fiction">Fiction</option>
                    <option value="nonfiction">Non-Fiction</option>
                </select>
                <select name="sortOrder">
                    <option value="ASC">Ascending</option>
                    <option value="DESC">Descending</option>
                </select>
                <br><br>
                <input type="submit" name ="catagorySubmit" value="Search"/>
                </div>
                
                <div class:="year">
                View by Year
                <br><br>
                Books newer than: 
                <input type="number" name="greaterThan" min="1985" max="2017">
                <select name="sortOrderYear">
                    <option value="ASC">Ascending</option>
                    <option value="DESC">Descending</option>
                </select>
                <br><br>
                <input type="submit" name ="yearSubmit" value="Search"/>
                </div>
                
                Display All Books
                <br><br>
                <input type="submit" name ="displayAll" value="Search"/>
            </form>
            
            <hr>
        </body>
        <?=display()?>
    </main>
     
    <footer>
        </br>
    </footer>
</html>

<!--
https://cst336-ginos89.c9users.io/phpmyadmin/index.php?db=tcp&table=user&target=tbl_sql.php&token=350e04c12f803f496a48b13bedf08037#PMAURL-0:index.php?db=tcp&table=user&server=1&target=tbl_sql.php&token=350e04c12f803f496a48b13bedf08037
-->