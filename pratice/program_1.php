<?php

$letterArray = range("A","Z");

//Displays the "letter to find" and "letter to omit" dropdown menus
function lettersDropdown(){
    global $letterArray;
    foreach($letterArray as $letter){
        echo "<option value='$letter'>$letter</option>";
    }
}

//Creates array with all the random letters that will be displayed in the table
function getLetterTable($size,$letterToFind,$letterToOmit){
    global $letterArray;
    
    $letterTable = array();
    for ($i=0; $i < $size*$size; $i++) {
        do {
          //loops until it gets a random letter different from "letter to find" AND "letter to omit"
		  $randomLetter = $letterArray[array_rand($letterArray)];
		} while ($randomLetter == $letterToFind || $randomLetter == $letterToOmit);
        $letterTable[] = $randomLetter;
    }

    //places "letter to find" in a random position
    $letterTable[array_rand($letterTable)] = $letterToFind;     
    
    return $letterTable;
}

function displayTable() {
	if (isset($_GET['submit'])) {
		$letterToFind = $_GET['letterToFind'];
		$letterToOmit = $_GET['letterToOmit'];
		$size         = $_GET['size'];

        if ($letterToFind == $letterToOmit) {
			echo "<br /><br /><strong>Error: Letter to Find MUST Be different from Letter to Omit!</strong>";
			return;
        }
		
		echo "<hr><h1> Find the letter " . $letterToFind . "</h1>";
		echo "<strong> Letter to Omit: " . $letterToOmit . "</strong><br />";

        $letterTable = getLetterTable($size,$letterToFind,$letterToOmit);
 		echo "<table border='1' style='margin:0 auto' cellpadding=7>";
 	 	$index = 0;
		for ($rows = 0; $rows < $size; $rows++) {
			echo "<tr>";
			for ($cols = 0; $cols < $size; $cols++) {
			   $letterToDisplay = $letterTable[$index];
				if ($letterToDisplay < 'H') {
					$color="red";
				} else if ($letterToDisplay < 'P') {
					$color="blue";
				} else {
					$color="green";
				}
				echo "<td style='color:$color'>" . $letterToDisplay . "</td>";
				$index++;
			}//endFor (cols)
			echo "</tr>";
		}//endFor (rows)
		echo "</table>";	
		
	}//endIf (submit)	
}//endFunction
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <title>Midterm Practice - Program 1: Find the Letter</title>
  <style>
	td {
		font-size: 1.8em;
	}
	#wrapper {
		margin: 0 auto;
		width: 800px;
		text-align: center;
	}
  </style>
</head>

<body>
  <div id="wrapper">
    	<h3> Find the Letter!</h3>
    	<form method='get'>
        	<strong> Select a Letter to Find:</strong>
    		<select name="letterToFind">
    			<?=lettersDropdown()?>
    		</select>
    		<br /><br />
    		
    		Select Table Size:
    		<select name="size">
    			<option value="6">6x6</option>
    			<option value="7">7x7</option>
    			<option value="8">8x8</option>
    			<option value="9">9x9</option>
    			<option value="10">10x10</option>
    		</select>
    		<br /><br />
    		
    		Select Letter to Omit:
    		<select name="letterToOmit">
    			<?=lettersDropdown()?>
			</select>
			<br /><br />
			<input type="submit" value="Create Table" name="submit" />
			
		</form>
			
		<?=displayTable() ?>
   </div>
</body>
</html>

<!-------------->
<div>
                                <table border="1" width="600" align='center'>
                                    <tbody><tr>
                                        <th>#</th>
                                        <th>Task Description</th>
                                        <th>Points</th>
                                    </tr>
                                    <tr style="background-color:#99E999">
                                        <td>1</td>
                                        <td>The page includes the basic form elements as in the Program Sample: Text boxes, Dropdown menu, submit button</td>
                                        <td width="20" align="center">5</td>
                                    </tr>
                                    <tr style="background-color:#99E999">
                                        <td>2</td>
                                        <td>When submitting the form, an error message is displayed if the product of columns and rows exceeds 39</td>
                                        <td width="20" align="center">5</td>
                                    </tr>
                                    <tr style="background-color:#99E999">
                                        <td>3</td>
                                        <td>When submitting the form, a table is created with random playing cards</td>
                                        <td align="center">5</td>
                                    </tr>
                                    <tr style="background-color:#99E999">
                                        <td>4</td>
                                        <td>The size of the table corresponds to the one selected by the user </td>
                                        <td align="center">10</td>
                                    </tr>
                                    <tr style="background-color:#99E999">
                                        <td>5</td>
                                        <td>The cards are NOT duplicated </td>
                                        <td align="center">10</td>
                                    </tr>
                                    <tr style="background-color:#FFC0C0">
                                        <td>6</td>
                                        <td>No cards of the suit selected by the user are displayed in the game </td>
                                        <td align="center">10</td>
                                    </tr>
                                    <tr style="background-color:#FFC0C0">
                                        <td>7</td>
                                        <td>The Aces have a yellow background</td>
                                        <td align="center">5</td>
                                    </tr>
                                    <tr style="background-color:#FFC0C0">
                                        <td>8</td>
                                        <td>The Kings have a cyan background</td>
                                        <td align="center">5</td>
                                    </tr>
                                    <tr style="background-color:#FFC0C0">
                                        <td>9</td>
                                        <td>The total number of Aces and Kings are displayed</td>
                                        <td align="center">5</td>
                                    </tr>
                                    <tr style="background-color:#FFC0C0">
                                        <td>10</td>
                                        <td>A message indicates who won, Aces or Kings, (or neither) </td>
                                        <td align="center">5</td>
                                    </tr>
                                    <tr style="background-color:#99E999">
                                        <td>11</td>
                                        <td>At least five CSS rules are included</td>
                                        <td align="center">5</td>
                                    </tr>
                                    <tr style="background-color:#99E999">
                                        <td>12</td>
                                        <td>This rubric is properly included AND UPDATED (BONUS)</td>
                                        <td width="20" align="center">2</td>
                                    </tr>
                                    <tr>
                                        <td></td>
                                        <td>T O T A L </td>
                                        <td width="20" align="center"><b></b></td>
                                    </tr>
                                </tbody></table>
                            </div>
<?php
$ROWS =0;
$COLS =0;
$iterator = ['clubs', 'diamonds', 'hearts', 'spades'];
$errMess="";


if($_POST){
 $ROWS= $_POST['rows'];
 $COLS = $_POST['cols'];
    if($ROWS*$COLS > 39){
        $errMess = "Selection is too large!";
    }
 
 //get suit index to remove
$index = array_search($suits, $iterator); 
unset($iterator[$index]);
 
}

?>
                            
<!DOCTYPE html>
<html>
    <head>
        <title>Midterm Program 1</title>
        <style>
        
        h1 {
            background-color: lightgreen;
        }
    #container {
      margin: 20px auto 20px auto;
      min-height: 400px;
      min-width: 325px;
      max-width: 800px;
      padding: 20px;
      background-color: yellow;
        
    }
    .cards {
        border: 1px solid black;
    }

    .subButton {
        display: inline-block;
    }
    
    .row {
    display: inline-block;
    }
    
    
        </style>
    </head>
    <body>
        <div id="container">
             <div class="header">
            <h1>Aces vs Kings</h1>
        </div>
            <form  method="post" action="<?PHP echo htmlspecialchars($_SERVER['PHP_SELF']); ?>">
            <div>
            <table border="0">
                <tr>
                    <td><label for="rows">Number of Rows: </td>
                    <td><input type='text' name='rows' value="<?PHP if(isset($_POST['rows'])) echo htmlspecialchars($_POST['rows']); ?>"></label><?php echo $errMess ?></td>
                    <tr>
                    <td><label for="cols">Number of Columns: </td>
                    <td><input type="text" name="cols" value="<?PHP if(isset($_POST['cols'])) echo htmlspecialchars($_POST['cols']); ?>"> </label><?php echo $errMess ?></td>
                    </tr>
                </tr>
            </table>
            </div>
                   <div> Suit to omit:
                <select name="suits">
                  <option value ="hearts" selected>Hearts</option>
                  <option value="clubs">Clubs</option>
                  <option value="diamonds">Diamonds</option>
                  <option value="spades">Spades</option>
                </select>
            <div class="subButton"><input class="btn" type="submit" value="Submit"></div>
            </div>
        </form>
        <div>

	</div>
        <?php
        
    $playerHands = [];
    $scores = [];

	$cards = [];

	// get cards
	foreach($iterator as $suits) {

		$directory = "cards/" . $suits;
		foreach(glob($directory . '/*.png') as $item)
			array_push($cards, $item);
	}

	shuffle($cards);
	$index = 0;

	// Rows
	for ($i = 0; $i < $ROWS; $i++) {

		$score = 0;
		$dealtHand = [];

		for ($j = 0; $j < $COLS; $j++) {
			$card = $cards[$index++];
			array_push($dealtHand, $card);
			$score+= basename($card, ".png");
		}
		


		array_push($scores, $score);
		array_push($playerHands, $dealtHand);
	}
        


    //DISPLAY cards
    echo "<table class='cards'><tr>";
    for ($i = 0; $i < $ROWS; $i++)  {
            for ($j = 0; $j < $COLS; $j++) {
		        echo "<td><img src='".$playerHands[$i][$j]."'></td>";
            }
		echo "</tr>";
    }
	echo "</table>";
        
    
        ?>
        </div>
    </body>
</html>