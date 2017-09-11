<!DOCTYPE html>
<html>
    <head>
        <link rel="stylesheet" href="css.css">
    </head>
    <body>
        <?php 
            
            $array = array();
            $sum = 0;
            
            for ($i = 0; $i < 9; $i++)
                array_push($array, rand(1, 999));
            
            echo "<table>";
            for ($i = 0; $i < 9; $i++) {
                echo "<tr>";
                echo ($array[$i] % 2) ? "<td class=\"odd-number\">" : "<td class=\"even-number\">" ;
                $sum += $array[$i];
                echo $array[$i];
                echo "</td>";
                echo "</tr>";
            }
            echo "</table>";
            
            echo "<br /><br />";
            
            echo "<p>Sum: ".$sum."</p>"; 
            echo "<p>Average: ".number_format($sum / 9, 3)."</p>";
            
        ?>
    </body>
</html>