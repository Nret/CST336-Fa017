<?php

$doorImages = array("DrWho.png", "bridge.png", "silly.png", "holodeck.png", "door.png");
$doorChances = array(7, 35, 55, 75); // one less because door.png is the 'default' door if no other gets picked.

$winImages = array("sovereign_bridge.jpg", "tng_bridge.jpg", "tos_bridge.jpg");
$loseImages = array("duck.jpg");

$quotes1 = array("Interesting selection.", "That would not have been my first selection.", "Great pick! Just what I would have done.", "Well, I guess you could pick that door.", "Do you know my friend Picard? I have a feeling he would be very good at this game.", "I have a feeling you know what you're doing.", "Would it be wrong to have suggested a different door.", "Wow. I don't think you could have done any better.");
$quotes2 = array("Will you keep that door?", "Do you want to change?", "Keep it or change it, it doesn't matter to me.", "Hit? Or Stay? Wait is that a different game?", "Which do you choose now?");

function randomDoor() {
    global $doorImages, $doorChances;
    
    // method borrowed from https://stackoverflow.com/questions/22129252/how-to-calculate-a-drop-rate-based-on-percentage
    for ($i = 0; $i < count($doorChances); $i++) 
        if (rand(0, 99) < $doorChances[$i])
            return $i;
    
    return 4;
    
    //return $doorImages[rand(0, 4)];
}



function unwrapState() {
    global $level, $userSelectedDoor, $answer, $gamesPlayed, $gamesWon, $door1, $door2, $door3;
    
    if (!isset($_POST['data'])) {
        // first run
        $level = 0;
        $gamesPlayed = 0;
        $gamesWon = 0;
        
        $answer = 0;
        
        $userSelectedDoor = 0;
        
    } else {
        // continuing run
        $data = $_POST["data"];
        
        $data = explode(",", $data);
        
        $level = $data[0];
        
        $gamesPlayed = $data[1];
        $gamesWon = $data[2];
        
        $door1 = $data[3];
        $door2 = $data[4];
        $door3 = $data[5];
        
        $answer = $data[6];
        
        if ($level != 0 && $level == 1 || $level == 2)
            $userSelectedDoor = $data[7];
    }
}

// $level, $gamesPlayed, $gamesWon, $doors [0], doors[1], doors[2], userselecteddoor
function wrapState() {
    
    $numargs = func_num_args(); // http://php.net/manual/en/function.func-get-args.php
    $arg_list = func_get_args();
    $data = $arg_list[0];
    for ($i = 1; $i < $numargs; $i++)
        $data .= "," . $arg_list[$i];
        
    return $data;
}

function renderNewGame() {
    global $level, $gamesPlayed, $gamesWon, $doorImages, $door1, $door2, $door3, $answer;
    
    $data = wrapState($level, $gamesPlayed, $gamesWon, $door1, $door2, $door3, $answer);
    
    echo "<img class='judge-q' src='img/judge_q.png' />";
    
    echo "<div class='q-chat-bubble'>";
    echo "<div class='q-chat-text'>";
    echo "<p>";
    echo "Welcome! Player ";
    echo /*$ip = */$_SERVER['REMOTE_ADDR']?:($_SERVER['HTTP_X_FORWARDED_FOR']?:$_SERVER['HTTP_CLIENT_IP']);
    echo "</p>";
    echo "<p>";
    echo "Have you ever played the <a href='https://en.wikipedia.org/wiki/Monty_Hall_problem'>Monty Hall problem</a>? Well this is that.";
    echo "</p>";
    echo "<p>";
    echo "Pick a door. From the unpicked doors, I will remove a losing one. You may then keep your selection, or select the other door. Which is to your benifit?";
    echo "</p>";
    echo "<p>";
    echo "Select correctly to get to the bridge. Select incorrectly..<!-- for a tribute -->.";
    echo "</p>";
    echo "</div>";
    echo "</div>";
    
    echo "<form method='POST'>";
    echo "<input name='data' value='$data,0' type='image' src='img/doors/" . $doorImages[$door1] . "' class='door door-slot1' />";
    echo "<input name='data' value='$data,1' type='image' src='img/doors/" . $doorImages[$door2] . "' class='door door-slot2' />";
    echo "<input name='data' value='$data,2' type='image' src='img/doors/" . $doorImages[$door3] . "' class='door door-slot3' />";
    echo "</form>";
}

function newgame() {
    global $level, $answer, $door1, $door2, $door3;
    
    $answer = rand(0, 2);
    
    $door1 = randomDoor();
    $door2 = randomDoor();
    $door3 = randomDoor();

    
    $level++;
    
    renderNewGame();
}

function rendercontinueGame() {
    global $level, $answer, $door1, $door2, $door3, $userSelectedDoor, $doorImages, $gamesPlayed, $gamesWon, $quotes1, $quotes2;
    
    $data = wrapState($level, $gamesPlayed, $gamesWon, $door1, $door2, $door3, $answer);
    
    echo "<img class='judge-q' src='img/judge_q.png' />";
    
    echo "<div class='q-chat-bubble'>";
    echo "<div class='q-chat-text'>";
    echo "<p>";
    echo $quotes1[rand(0, count($quotes1) - 1)];
    echo "</p>";
    echo "<p>";
    echo "</p>";
    echo "<p>";
    echo "" . $quotes2[rand(0, count($quotes2) - 1)];
    echo "</p>";
    echo "</div>";
    echo "</div>";
     
    echo "<form method='POST'>";
    if ($door1 != -1)
        echo "<input name='data' value='$data,0' type='image' src='img/doors/" . $doorImages[$door1] . "' class='door door-slot1" . ($userSelectedDoor == 0 ? " user-selected-door" : "") . "' />";
    if ($door2 != -1)
        echo "<input name='data' value='$data,1' type='image' src='img/doors/" . $doorImages[$door2] . "' class='door door-slot2" . ($userSelectedDoor == 1 ? " user-selected-door" : "") . "' />";
    if ($door3 != -1)
        echo "<input name='data' value='$data,2' type='image' src='img/doors/" . $doorImages[$door3] . "' class='door door-slot3" . ($userSelectedDoor == 2 ? " user-selected-door" : "") . "' />";
    echo "</form>";
 }

function continueGame() {
    global $level, $answer, $door1, $door2, $door3, $userSelectedDoor, $gamesPlayed, $gamesWon;
 
    if ($answer == $userSelectedDoor) {
        if ($answer == 0)
            ${"door" . array(2, 3)[rand(0,1)]}  = -1;
        else if ($answer == 1)
            ${"door" . array(1, 3)[rand(0,1)]} = -1;
        else if ($answer == 2)
            ${"door" . array(1, 2)[rand(0,1)]} = -1;
    } else {
        if ($answer != 0 && $userSelectedDoor != 0) {
            $door1 = -1;
        } else if ($answer != 1 && $userSelectedDoor != 1) {
            $door2 = -1;
        } else if ($answer != 2 && $userSelectedDoor != 2) {
            $door3 = -1;
        }
    }
    
 
    $level++;
 
    rendercontinueGame();
}

function renderReveal() {
    global $level, $answer, $userSelectedDoor, $gamesPlayed, $gamesWon, $winImages, $loseImages;
    
    $data = wrapState($level, $gamesPlayed, $gamesWon, 0, 0, 0, 0);
    
    
    if ($answer == $userSelectedDoor) {
        echo "<img class='win-lose-img' src='img/win/" . $winImages[rand(0, count($winImages) - 1)] . "' />";
        echo "<p class='win-lose-text'>You WIN</p>";
    } else {
        echo "<img class='win-lose-img' src='img/lose/" . $loseImages[rand(0, count($loseImages) - 1)] . "' />";
        echo "<p class='win-lose-text'>You LOSE</p>";
    }
    
    echo "<form method='POST'>";
    echo "<input name='data' value='$data' type='image' src='img/judge_q.png' class='judge-q' />";
    echo "</form>";
}

function reveal() {
    global $level, $answer, $userSelectedDoor, $gamesPlayed, $gamesWon;
    
    if ($answer == $userSelectedDoor)
        $gamesWon++;
    $gamesPlayed++;
    
    $level = 0;
    
    renderReveal();
}

function startLevel() {
     global $level;
     
     if ($level == 0)
        newGame();
     else if ($level == 1)
        continueGame();    
     else if ($level == 2)
         reveal();
     
}

function showStatistics() {
    global $gamesPlayed, $gamesWon;
    
    echo "<div class='stats-text'>";
    echo "<pre>";
    echo "Games played: " . $gamesPlayed . "\n";
    echo "Games won:    " . $gamesWon . "\n";
    if ($gamesPlayed > 0)
        echo "Win rate:     ". round( $gamesWon / $gamesPlayed * 100, 3) . "%";
    echo "</pre>";
    echo "</div>";
}

function play() {
    unwrapState();
    startLevel();
    showStatistics();
    
    
    /*
    
    state:
        level: [0, 1, 2]
        doors: {x,x,x}    x: [-1: removed, 0..4: door image]
        userSelectedDoor: [0, 1, 2]
        answer: [0, 1, 2]
        gamesPlayed: [0..1..2..3..4..n]
        gamesWon: [0..1..2..3..4..n]
        
    
    unwrap state
    
    determine
        newgame
            set up fresh variables
        continuing game (includes gameover)
            load variables
            place them on the proper road
    
    roads
        0, landing page (new page), 3 doors, none removed
        1, 2 doors, 1 selected
        2, reveal
        
    */
}



?>