var selectedWord = "";
var selectedHint = "";
var board = "";
var remaningGuesses = 6;
var words = [{ word: "snake", hint: "S N A K E"},
             { word: "monkey", hint: "M O N K E Y"},
             { word: "beetle", hint: "B E E T L E"}];

var alphabet = ['A', 'B', 'C', 'D', 'E', 'F', 'G', 'H', 
                'I', 'J', 'K', 'L', 'M', 'N', 'O', 'P', 
                'Q', 'R', 'S', 'T', 'U', 'V', 'W', 'X', 'Y', 'Z'];


window.onload = startGame();

function createLetters() {
    for(var letter of alphabet) {
        $("#letters").append("<button class='letter' id = '" + letter + "'>" + letter + "</button>");
    }
}

function updateMan() {
    $("#hangImg").attr("src", "img/stick_" + (6 - remaningGuesses) + ".png");
}

function endGame(win) {
    $("#letters").hide();
    
    if (win) {
        $("#won").show();
    } else {
        $("#lost").show();
    }
}

$(".replayBtn").on("click", function() {
   location.reload(); 
});

function checkLetter(letter) {
    var positions = new Array();
    
    for(var i = 0; i < selectedWord.length; i++) {
        if (letter == selectedWord[i]) {
            positions.push(i);
        }
    }
    
    if (positions.length > 0) {
        updateWord(positions, letter);
        
        if (!board.includes('_')) {
            endGame(true);
        }
    } else {
        remaningGuesses -= 1;
        updateMan();
    }
    
    if (remaningGuesses <= 0) {
        endGame(false);
    }
}

function updateWord(positions, letter) {
    for(var pos of positions) {
        board = replaceAt(board, pos, letter);
    }
    
    updateBoard();
}

function replaceAt(str, index, value) {
    return str.substr(0, index) + value + str.substr(index + value.length);
}

function startGame() {
    pickWord();
    initBoard();
    createLetters();
    updateBoard();
}

function initBoard() {
    for (var letter in selectedWord) {
        board += '_';
    }
}

function pickWord() {
    var randomInt = Math.floor(Math.random() * words.length);
    selectedWord = words[randomInt].word.toUpperCase();
    selectedHint = words[randomInt].hint;
}

function updateBoard() {
    $("#word").empty();
    
    for(var letter of board) {
        document.getElementById("word").innerHTML += letter + " ";
    }
    
    $("#word").append("<br />");
    $("#word").append("<span class='hint'>Hint: " + selectedHint + "</span>");
}

function disableButton(btn) {
    btn.prop("disabled", true);
    btn.attr("class", "btn btn-danger");
}

$(".letter").click(function() {
    console.log("FUCK YOU");
    checkLetter($(this).attr("id"));
    disableButton($(this));
});

