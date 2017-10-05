<?php
    $bgImgs = array("fire.1.jpg", "fire.2.jpg", "pixel.1.gif", "pixel.2.gif");
    $bgImg = "backgrounds/" . $bgImgs[array_rand($bgImgs)];//"../backgrounds/pixel.2.gif"; // holy cow it mattered that these were the doule " and the background-image: url was single '
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
        
        <fieldset class="test-container">
        <legend>Your Future Depends On This</legend>
        <form method="POST">
        <fieldset class="inner-container">
        <legend>Very Important Test</legend>
            <input type="checkbox" name="here" value="true">I am here
            <br/><br/>
            
            <select name="language">
              <option value="c++">C++</option>
              <option value="java">Java</option>
              <option value="python">Python</option>
              <option value="better">Something better</option>
              <option value="worse">Something worse</option>
              <option value="exactlythesame">About the same</option>
            </select>
            Which language are you most comfortable with?
            <br/><br/>
            
            Write a 5 paragraph essay about your selected programming lanauge.
            <br/>
            What are some benifits? Where could it use improvement?
            <br/>
            What are your favorite features? Have fun with it.
            <br/>
            <textarea name="message" rows="15" cols="60">Do not leave this blank, or with this message.</textarea>
            
            <br/><br/>
            
            Please select your prefered gender:<br/>
            <input type="radio" name="gender" value="male"> Male<br>
            <input type="radio" name="gender" value="female"> Female<br>
            <input type="radio" name="gender" value="other" checked> Other
            </fieldset>
            
            <br/><br/>
            
            <fieldset class="inner-container">
            <legend>Login to s&#855;&#772;&#779;&#844;&#794;&#838;&#829;&#788;&#770;&#779;&#817;&#857;&#840;&#839;&#808;&#822;u&#862;&#782;&#855;&#787;&#855;&#787;&#775;&#773;&#855;&#830;&#808;&#791;&#807;&#803;&#790;b&#775;&#788;&#768;&#772;&#772;&#772;&#780;&#843;&#818;&#798;&#863;&#790;&#845;&#816;&#809;&#860;m&#844;&#769;&#776;&#848;&#794;&#829;&#855;&#843;&#783;&#781;&#860;&#845;&#804;&#809;&#857;&#866;&#807;&#813;&#854;i&#794;&#774;&#778;&#770;&#864;&#773;&#794;&#774;&#785;&#862;&#807;&#799;&#857;&#814;&#817;&#802;t&#862;&#781;&#849;&#835;&#865;&#778;&#804;&#854;&#804;&#800;&#808;&#857;&#824;</legend>
            Username:<br/>
            <input type="text" name="username">
            <br/>
            Password:<br/>
            <input type="password" name="password">
            
            <br/><br/>
            <input type="submit">
            </fieldset>
        </form>
        </fieldset>
        
        <footer>
            
        </footer>
    </body>
</html>