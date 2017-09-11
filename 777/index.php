<?php 
    include 'inc/functions.php';
?>

<!DOCTYPE html>
<html>
    <head>
        <title> 777 Slot Machine </title>
        <link rel="stylesheet" href="css/styles.css">
    </head>
    <body>
        <div id="main">
            
            <?php
                play();
            ?>
            
            <form>
                <input class="spin" type="submit" value="Spin!"/>
            </form>
            
            <form>
                <input name="jackpot" class="jackpot" type="submit" value=""/>
            </form>
        
        </main>
    </body>
</html>