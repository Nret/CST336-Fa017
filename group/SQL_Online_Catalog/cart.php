 <?php
    session_start();

    class Cart {
        private $CartList;
        
        function __construct() {
            $this->CartList = array();
        }
        
        public function addBook($name){
            array_push($this->CartList, $name);
        }
        
        public function getList(){
            return $this->CartList;
        }
    }
    
    function GetTableBooks($conn, $table, $cartList){
        $bookList = array();
        foreach ($cartList as $bookName){
            $sql = "SELECT * 
            FROM ".$table." WHERE title = '".$bookName."'";

            $statement= $conn->prepare($sql); 
            $statement->execute();
            $record = $statement->fetchALL(PDO::FETCH_ASSOC);
            $bookList = array_merge($bookList, $record);
        }
        return $bookList;
    }
    
    function displayCart(){
        include 'database.php';
        $conn = getDatabaseConnection();
        $cartObj = $_SESSION['cart'];
        $cart = $cartObj->getList();
        $totalList = array();  
        $totalList = array_merge($totalList, GetTableBooks($conn, "csbooks", $cart));
        $totalList = array_merge($totalList, GetTableBooks($conn, "fiction", $cart));
        $totalList = array_merge($totalList, GetTableBooks($conn, "nonfiction", $cart));

        
        echo "<table>";
        echo "<tr>";
            echo "<th>Title</th>";
            echo "<th>Author</th>";
            echo "<th>ISBN</th>";
            echo "<th>Year</th>";
        echo "</tr>";
        
        foreach($totalList as $book) {
            echo "<tr>";
                echo "<td>" . $book['title'] . "</td>";
                echo "<td>" . $book['author'] . "</td>";
                echo "<td>" . $book['ibsn'] . "</td>";
                echo "<td>" . $book['year'] . "</td>";
            echo "</tr>";
        }
        
        echo "</table>";
    }
    
    //make sure there is a cart
    if (!isset($_SESSION['cart'])) {
        $mainCart = new Cart();
        $_SESSION['cart'] = $mainCart;
    }

    if (isset($_GET['bookISBN'])) {  
        $mainCart = $_SESSION['cart'];
        $mainCart->addBook($_GET['bookISBN']);
        $_SESSION['cart'] = $mainCart;
        //book added, return to index
        //header("Location: index.php");
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
            
            <h1>Cart</h1>
            
        </body>
       
    </main>
     <?php displayCart(); ?>
    <footer>
        </br>
    </footer>
</html>