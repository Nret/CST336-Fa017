<?php
    function messageIsOk($message) {
        if ($message == "")
            return false;
        if ($message == "Do not leave this blank, or with this message.")
            return false;
        if (strpos($message, "with this message") !== false)
            return false;
        
        
        return true;
    }

    $bgImgs = array("fire.1.jpg", "fire.2.jpg", "pixel.1.gif", "pixel.2.gif");
    $bgImg = "backgrounds/" . $bgImgs[array_rand($bgImgs)]; // "../backgrounds/pixel.2.gif"; // holy cow it mattered that these were the doule " and the background-image: url() was single '

    // check sent variables
    $name = $_POST["name"];
    $signature = $_POST["signature"];
    $language = $_POST["language"];
    $here = $_POST["here"];
    $message = $_POST["message"];
    $selfrating = $_POST["selfrating"];
    
?>
<!DOCTYPE html>
<html>
    <head>
        <title>Due soon</title>
        <link rel="stylesheet" href="css/css.css">
        <style type="text/css">
            body {
                background-image: url('<?php echo $bgImg; ?>');
            }
        </style>
    </head>    
    <body>
        
        <?php 
        if ($here == true && $name != "" && (messageIsOk($message))) { // sig can be blank because... there is no reason, I am just choosing it to be so
        ?>
            <fieldset class="test-container">
            <legend>Professor Oak</legend>
            
            Hello <span class="signature"><?=($signature != "" ? $signature : "NO NAME")?></span>
            </br></br>
            
            So you wrote about 
            
            <?php 
                if ($language == "c++") {
                    echo "C++ a good language";
                } else if ($language == "java") {
                    echo "Java? My favorite.";
                } else if ($language == "python") {
                    echo "Python. Always good to learn something new";
                } else if ($language == "better") {
                    echo "Something Better? Subjective.";
                } else if ($language == "worse") {
                    echo "Something Worse? Also subjective.";
                } else if ($language == "exactlythesame") {
                    echo "... I have a feeling you're going to tell me something exactlythesame.";
                }
            ?>
            
            </br></br>
            
            You rate it
            </br>
            
            <?php 
                if ($selfrating == "best") {
                    echo "The best, Hah ha. It is good to think highly of ones self. Let's see how you did.";
                } else if ($selfrating == "good") {
                    echo "'Good' a humble rating. I'm sure you will go far in life. Believe it.";
                } else if ($selfrating == "bad") {
                    echo "... Now now. I'm sure it's not that bad.";
                }
            ?>
            
            </br></br>
            <textarea name="message" rows="15" cols="60"><?=$message?></textarea>
            </br></br>
            You wrote <?php echo str_word_count($message) ?> words! Nice job!
            </br>
            Everyone is a winner in my book!
            
            </br></br></br>
            
            <a class="retry-btn" href="./">Retry</a>
            
            </br></br>
            </fieldset>
        <?php
        } else {
            if ($name == "") {
                
            }
            if (!$msgok) {
                
            }
        ?>
            <fieldset class="test-container">
            <legend>Your Future Depends On This</legend>
            <h1>YOU FORGOT SOME THINGS!</h1>
            <form action="submit.php" method="POST">
            <fieldset class="inner-container">
            <legend>Very Important Test</legend>
                <br/>
                <?php 
                    if ($here == true) {
                        echo '<input type="checkbox" name="here" value="true" checked>I am here';
                    } else {
                        echo '<span class="shouting">* <input type="checkbox" name="here" value="true">YOU MUST BE HERE! CHECK THIS BOX!</span>';
                    }
                ?>
                
                <br/><br/>
                
                <select name="language">
                  <option value="c++" <?=($language == "c++" ? "selected" : "")?>>C++</option>
                  <option value="java"<?=($language == "java" ? "selected" : "")?>>Java</option>
                  <option value="python"<?=($language == "python" ? "selected" : "")?>>Python</option>
                  <option value="better"<?=($language == "better" ? "selected" : "")?>>Something better</option>
                  <option value="worse"<?=($language == "worse" ? "selected" : "")?>>Something worse</option>
                  <option value="exactlythesame"<?=($language == "exactlythesame" ? "selected" : "")?>>About the same</option>
                </select>
                Which language are you most comfortable with?
                <br/><br/>
                
                Write a 5 paragraph essay about your selected programming lanauge.
                <br/>
                What are some benifits? Where could it use improvement?
                <br/>
                What are your favorite features? Have fun with it.
                <br/>
                
                <?php
                    if (messageIsOk($message)) {
                        echo '<textarea name="message" rows="15" cols="60">' . $message . '</textarea>';
                    } else {
                        echo '<span class="shouting">WHOAH THERE WHAT\'S THIS!?</span><br/><textarea name="message" rows="15" cols="60">' . $message . '</textarea>';
                        if (strpos($message, "with this message") !== false)
                            echo '<span class="shouting">> OR \'WITH THIS MESSAGE\'</span>';
                    }
                ?>
                
                <br/><br/>
                
                Rate your essay:<br/>
                <input type="radio" name="selfrating" value="best" <?=($selfrating == "best" ? "checked" : "")?>> One of the best ever written<br>
                <input type="radio" name="selfrating" value="good" <?=($selfrating == "good" ? "checked" : "")?>> Pretty good, but it needs work.<br>
                <input type="radio" name="selfrating" value="bad"  <?=($selfrating == "bad" ? "checked" : "")?>> I should rethink my education.
                </fieldset>
                
                <br/><br/>
                
                <fieldset class="inner-container">
                <legend>P&#850;&#784;&#829;&#855;&#782;&#785;&#769;&#809;&#851;&#814;&#837;&#800;&#801;&#846;&#801;&#822;l&#862;&#844;&#856;&#794;&#783;&#843;&#798;&#839;&#837;&#853;&#798;&#826;&#852;&#793;&#793;e&#768;&#834;&#849;&#776;&#842;&#834;&#794;&#769;&#863;&#851;&#853;&#860;&#817;&#827;&#823;a&#844;&#769;&#779;&#838;&#788;&#788;&#801;&#811;&#812;&#791;&#802;&#811;&#793;&#815;&#797;&#808;&#822;s&#836;&#842;&#842;&#849;&#770;&#788;&#783;&#858;&#816;&#858;&#809;&#798;&#824;e&#836;&#856;&#788;&#776;&#772;&#794;&#784;&#787;&#772;&#799;&#839;&#858;&#814;&#851;&#827;&#841;&#826; S&#855;&#832;&#777;&#856;&#787;&#837;&#854;&#808;&#807;&#827;&#809;&#815;&#812;&#810;i&#843;&#832;&#865;&#843;&#789;&#859;&#829;&#777;&#860;&#792;&#840;&#858;&#819;&#817;&#819;&#814;&#800;&#820;g&#830;&#779;&#789;&#833;&#830;&#866;&#839;&#866;&#813;&#818;&#804;&#826;&#819;n&#768;&#776;&#794;&#772;&#844;&#842;&#772;&#842;&#771;&#779;&#813;&#828;&#815;&#827;&#841;&#808;</legend>
                Name:<br/>
                
                <?php
                    if ($name != "") {
                        echo '<input class="text-input" type="text" name="name" value=' . $name . '>';
                    } else {
                        echo '<span class="shouting">YOU MUST GIVE A NAME!</span><br/><input class="text-input" type="text" name="name">';
                    }
                ?>
                
                
                <br/>
                Signature:<br/>
                <input class="signature text-input" type="text" name="signature">
                
                <br/><br/>
                <input type="submit">
                </fieldset>
            </form>
            </fieldset>
            
            
        <?php    
        }
        ?>
        <footer>
            
        </footer>
    </body>
</html>