<?php
    $backgroundImage = "img/sea.jpg";
    
    function getRandomImages($urls, $amount) {
        if (count($urls) <= $amount)
            return $urls;
        
        $ret = array($amount);
        
        for ($i = 0; $i < $amount; $i++) {
            do {
                $randomIndex = rand(0, count($urls));
            } while (!isset($urls[$randomIndex]));
            
            $ret[$i] = $urls[$randomIndex];
            
            unset($urls[$randomIndex]);
        } 
        
        return $ret;
    }
    
    
    if (isset($_GET['keyword'])) {
        $amount = isset($_GET['amount']) ? $_GET['amount'] : 10;
        //echo "You searched for: " . $_GET['keyword'];
        
        $layout = isset($_GET['layout']) ? $_GET['layout'] : "horizontal";
        
        include 'api/pixabayAPI.php';
        $imageURLs = getImageURLs($_GET['keyword'], $layout);
        
        $backgroundImage = $imageURLs[array_rand(($imageURLs))]; // set background before killing the amount of imageurls we have
        
        $imageURLs = getRandomImages($imageURLs, $amount);
        //print_r($imageURLs);
        
    }
?>

<!DOCTYPE html>
<html>
    <head>
        <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
        <title>
            You misspelled kitten
        </title>
        <style type="text/css">
            @import url("css/styles.css");
            body {
                background-image: url('<?=$backgroundImage ?>');
            }
        </style>
    </head>
    <body>
        <br /> <br />
                
        <form>
            <input type="text" name="keyword" placeholder="Keyword" />
            <fieldset>
                <legend>Please select your preferred orientation:</legend>
                <div>
                  <input type="radio" id="horizontal"
                   name="layout" value="horizontal" checked>
                  <label for="horizontal">Horizontal</label>
                
                  <input type="radio" id="vertical"
                   name="layout" value="vertical">
                  <label for="vertical">Vertical</label>
                </div>
                <div>
                    <input type="submit" value"Submit" />
                </div>
            </fieldset>
        </form>
        
        <br /> <br />
        
        <?php
            if (!isset($imageURLs)) {
                echo "<h2> Type a keyword to display a slideshow <br /> with random images from Pixabay.com </h2>";
            } else {
                echo '<div id="carousel-example-generic" class="carousel slide" data-ride="carousel">'; 
                echo '<ol class="carousel-indicators"> '; 
                
                echo '<li data-target="#carousel-example-generic" data-slide-to="0" class="active" </li>'; 
                for($i = 1; $i < count($imageURLs); $i++) {
                    echo '<li data-target="#carousel-example-generic" data-slide-to="'.$i.'" </li>'; 
                }
                
                echo '</ol>'; 
                echo '<div class="carousel-inner" role="listbox">'; 
                
                echo '<div class="item active" >';
                echo '<img src="'.$imageURLs[0].'" alt="should be a picture of a kitten">';
                echo '</div>';
                for ($i = 1; $i < count($imageURLs); $i++) {
                    echo '<div class="item" >';
                    echo '<img src="'.$imageURLs[$i].'" alt="should be a picture of a kitten">';
                    echo '</div>';
                }
        ?>
              <a class="left carousel-control" href="#carousel-example-generic" role="button" data-slide="prev">
                <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
                <span class="sr-only">Previous</span>
              </a>
              <a class="right carousel-control" href="#carousel-example-generic" role="button" data-slide="next">
                <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
                <span class="sr-only">Next</span>
              </a>
            </div>
            </div>
            
        <?php
            } // finishes the else 
        ?>
        
        
        <br /> <br />
        
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
    </body>
</html>