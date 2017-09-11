<?php

function play() {
    for ($i = 1; $i < 4; $i++) {
        ${"randVal" . $i} = isset($_GET["jackpot"]) ? 0 : rand(0, 4);
        displaySymbol(${"randVal" . $i}, $i);
    }
    
    displayPoints($randVal1, $randVal2, $randVal3);
}

function displaySymbol($randVal, $pos) {
    switch($randVal) {
    case 0: $symbol = "seven";
        break;
    case 1: $symbol = "cherry";
        break;
    case 2: $symbol = "lemon";
        break;
    case 3: $symbol = "orange";
        break;
    case 4: $symbol = "grapes";
        break;
    }
    
    echo "<img id='reel$pos' src='img/$symbol.png' alt='$symbol' title='" . ucfirst($symbol) . "' width='70' />";
}

function displayPoints($randVal1, $randVal2, $randval3) {
    echo "<div id='output'>";
    
    if ($randVal1 == $randVal2 && $randVal2 == $randval3) {
        switch ($randVal1) {
            case 0:
                $totalPoints = 1000;
                echo "<h1>Jackpot!</h1>";
                echo "<audio autoplay loop controls>";
                echo "  <source src='sound/jackpot.mpeg' type='audio/mpeg'>";
                echo "  Your browser does not support the audio element.";
                echo "</audio>";
                break;
            case 1:
                $totalPoints = 500;
                break;
            case 2:
                $totalPoints = 250;
                break;
            case 3:
                $totalPoints = 900;
                break;
            case 4:
                $totalPoints = 100;
                break;
        }
        echo "<h2>You won $totalPoints points!</h2>";
    } else {
        echo "<h3> Try Again! </h3>";
    }
    echo "</div>";
}
    
?>