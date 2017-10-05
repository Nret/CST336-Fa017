<!DOCTYPE HTML>
<html>
    <head>
        <title>Pete's awesome Site</title>
    </head>
    <body>
        <h1>Chinese Z0diac</h1>
        <ul>
                
        <?php
        
        function yearToZodiacImage($year) {
            if ($year < 1900 || $year > 2000)
                return "";
            
            
            $imgs = array('imgs/rat.png', 'imgs/ox.png', 'imgs/tiger.png', 'imgs/rabbit.png', 'imgs/dragon.png', 'imgs/snake.png', 'imgs/horse.png', 'imgs/goat.png', 'imgs/monkey.png', 'imgs/rooster.png', 'imgs/dog.png', 'imgs/pig.png');
            
            $index = $year % 12;
            return $imgs[$index];
        }
        
        function generateChineseZodiac($startYear, $stopYear) {
            $sum = 0;
            for ($i = $startYear; $i <= $stopYear; $i += 4) {
                echo "<li>" . $i . ($i == 1776 ? ": GOD BLESS AMERICA!" : "") . ($i % 100 == 0 ? ": Happy CENTURY!" : "");
                echo "<img src='" . yearToZodiacImage($i) . "' />";
                echo "</li>";
                $sum += $i;
            }
            
            echo "<br/>";
            
            echo "<h3>Sum: $sum</h3>";
            
        }
        
        
        generateChineseZodiac($_GET['start'], $_GET['end']);

        ?>
        
        </ul>
        
        <footer>
            
        </footer>
    </body>
</html>