// nothing crazy, a simple guessing game with the server.
function gameStart(target) {
    $(target).html("");
    
    var html = "<h2>Guess a number from 0 to 100. The closer you are to the correct answer the more Credits you earn.</h2>";
    html += "<div id='result' class='container-fluid'>\
<h2> Guess:\
<input type='text' id='guess'>\
</h2>\
<h2>\
<button id='game-submit'>Attempt</button></h2>\
<h1><div id='server-result'>...</div></h1>\
</div>";
    
    $(target).html(html);
    
    $("#game-submit").click(function() {
        $("#server-result").html("");
        
        $("#guess").removeClass("fail");
        
        // make sure input is inputted
        var guess = $("#guess").val();
        $("#guess").val("");
        
        if (guess == "") {
            $("#guess").addClass("fail");
            return;
        }
        
        // ajax call
        alertLoading();
        $.ajax({
        type: "get",
        url: "api.php",
        dataType: "json",
        data: { "action": "game-guess",
                "guess": guess
        },
        success: function(data, status) {
            alertFinished();
            console.log(data);
            debugger;
            $("#server-result").html(data.message);
            $("#balance").html(data.balance)
            
        }});
    });
    
}