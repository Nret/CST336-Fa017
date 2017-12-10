
var actionResults = { "viewInventory" : 
                        {   
                            "ID": "id",
                            "Name": "name", 
                            "Description": "description",
                            "Amount": "amount",
                            "Price": "price" 
                        }, 
                   "viewUsers" :
                       {
                            "ID": "id",
                            "Username": "username", 
                            "First Name": "first_name",
                            "Last Name": "last_name",
                            "Balance": "balance"
                       },
                    "viewProducts" :
                        {
                            "ID": "id",
                            "Name": "name", 
                            "Description": "description",
                            "Price": "price"
                        }, 
                    "viewOwnerships" :
                        {
                            "ID": "id",
                            "Username": "username", 
                            "Product": "name"
                        }, 
                    "viewStats" :
                        {
                            
                        }
};

function generateInputBoxes(target, action, names_columns, on_submit, on_success) {
    // var target = "#form-input";
    // var action = "addUser";
    // var names_columns = { "First Name": "first_name",
    //                     "Last Name": "last_name",
    //                     "User Name": "username", 
    //                     "Password": "password" };
    
    $(target).html("");
    for (var human_name in names_columns) {
        $(target).append( human_name + ":  <input id='" + names_columns[human_name] + "' type='text'><br> " );
    }
    $(target).append("<button id='submit-button' type='button'>Submit</button>");
    $("#password").after("<br><span id='password-warning' class='alert alert-danger'>WARNING: Password is stored UNENCRYPTED</span>");
    $("#password").attr("type", "password");
    $("#submit-button").after("<br><span id='submit-error' class='alert alert-danger'></span>");
    $("#submit-error").hide();
    
    $("#submit-button").off();
    $("#submit-button").click(function() {
        if (typeof on_submit == 'function')
            on_submit();
        
        var dataPairings = { "action" : action,
                         "columnnames" : Object.values(names_columns).join()
        };
        for(var id of Object.values(names_columns))
            dataPairings[id] = $("#" + id).val();
            
        console.log(dataPairings);
        
        alertLoading();
        $.ajax({
        type: "get",
        url: "api.php",
        dataType: "json",
        data: dataPairings,
        complete: function(data, status) {
            alertFinished();
            //console.log(status);
            //console.log(data);
            
            if (typeof on_success == 'function')
                on_success(data.responseJSON);
        }
        });
    }); 
}

// "viewUsers"
function generateTable(target, action, able="", search="", sortBy="") {
    $(target).html("");
    
    var toSend = {
        "action": action,
    };
    if (search != "")
        toSend["search"] = search;
    if (sortBy != "")
        toSend["sortBy"] = sortBy;
    
    alertLoading();
    $.ajax({
    type: "get",
    url: "api.php",
    dataType: "json",
    data: toSend,
    success: function(data, status) {
        alertFinished();
        console.log(data);
        
        var names_columns = actionResults[action];
        var editable = able == "editable" ? true : false;
        var buyable = able == "buyable" ? true : false;
        var sellable = able == "sellable" ? true : false;
        
        var table = " \
        <table class='table table-striped table-hover'> \
            <thead> \
              <tr> ";
              for(var human_name in names_columns)
                table += "<th>" + human_name + "</th>";
        table += "</tr> \
            </thead> \
            <tbody>";
            
            
        for(var row of data) {
        table += "<tr>";
           for(var i in row){
           
            table += "<td class='magic'";
           
            //if (editable)
                table += "data-id='" + row.id + "' data-action='" + action + "' data-columnname='" + i + "'"; // I'm so sorry for exposing column ID's, I just wanted ease of coding for this project, didn't originally plan on ever giving ID's and allowing this functionality to the user, but delete kinda calls for it?
           
            table += ">" + row[i] + "</td>";
           }
           
           if (editable)
            table += "<td> <span class='link delete-button' data-id='" + row.id + "'> Delete </span></td>"; // And with this I notice the magic function could cause some terribly awful possiblities 
           
           if (buyable)
            table += "<td> <span class='link buy-button buy-now-animation text-center' data-id='" + row.id + "'></span></td>";
            
            
           if (sellable)
            table += "<td> <span class='link sell-button hvr-pulse-shrink' data-id='" + row.id + "'> Sell </span></td>";
           
        table += "</tr>";
        }
              
        table += " \
            </tbody> \
        </table>";
        
        $(target).append(table);
        
        if(editable == true) {
            $(".magic").click(magicEdit);
            
            $(".delete-button").click(function() {
                console.log($(this));
                // var fromAction = $(this).data("action");
                 var idToDelete = $(this).data("id");
                
                var r = confirm("WARNING! Are you sure you want to delete ID: " + idToDelete + "\n\nTHIS CAN NOT BE REVERSED.");
                if (r == true) {
                    $(target).html("");
                    console.log("trying to delete");
                    
                    alertLoading();
                    $.ajax({
                    type: "get",
                    url: "api.php",
                    dataType: "json",
                    data: { "action": "delete", "id": idToDelete, "fromAction": action },
                    success: function(data, status) {
                        alertFinished();
                        console.log(data);
                        generateTable(target, action, able);
                        
                    }});
                }
            }); // .delete-button.click()
        }
        
        if (buyable) {
            $(".buy-button").click(function() {
                console.log($(this));
                console.log("trying to buy " + $(this).data("id"));
                
                alertLoading();
                $.ajax({
                type: "get",
                url: "api.php",
                dataType: "json",
                data: { "action": "buy", "id": $(this).data("id") },
                success: function(data, status) {
                    alertFinished();
                    console.log(data);
                    
                    //$("#purchase-output").hide();
                    
                    var spanClass = data.result == "success" ? "success alert alert-success" : "fail alert alert-danger";
                    var message = data.result == "success" ? "Successful!" : "Failed: " + data.message;
                    var fadeIn = data.result == "success" ? 350 : 230;
                    var delay = data.result == "success" ? 1100 : 7000;
                    var fadeOut = data.result == "success" ? 1300 : 3000;
                    
                    //$("#purchase-output").stop();
                    $("#purchase-output").html(data.name + "<span class='" + spanClass + "'>Purchase " + message + "</span>");
                    $("#purchase-output").fadeIn(fadeIn).delay(delay).fadeOut(fadeOut);
                    
                    if (data.result == "success")
                        $("#balance").html(data.balance);
                        // TODO HERE
                    
                }});
            }); // .buy-button.click()
        }
        
        if (sellable) {
            $(".sell-button").click(function() {
                var me = $(this);
                console.log(me);
                console.log("trying to sell " + $(this).data("id"));
                    
                alertLoading();
                $.ajax({
                type: "get",
                url: "api.php",
                dataType: "json",
                data: { "action": "sell", "id": $(this).data("id") },
                success: function(data, status) {
                    alertFinished();
                    console.log(data);
                    
                    var spanClass = data.result == "success" ? "success alert alert-success" : "fail alert alert-danger";
                    var message = data.result == "success" ? "Successful!" : "Failed: " + data.message;
                    var fadeIn = data.result == "success" ? 350 : 230;
                    var delay = data.result == "success" ? 900 : 7000;
                    var fadeOut = data.result == "success" ? 1300 : 3000;
                    
                    //$("#purchase-output").stop();
                    $("#purchase-output").html(data.name + "<span class='" + spanClass + "'>Sale " + message + "</span>");
                    $("#purchase-output").fadeIn(fadeIn).delay(delay).fadeOut(fadeOut);
                    
                    if (data.result == "success") {
                        $("#balance").html(data.balance);
                        
                        var hopefullyTheRightElement = me.closest("tr").children("[data-columnname='amount']");
                        var store = hopefullyTheRightElement.html();
                        hopefullyTheRightElement.html(store - 1);
                    }
                    
                    
                    
                    
                }});
            }); // .buy-button.click()
        }
    }
    });
}



function magicEdit() {
  var me = this;
  var store = $(me).html();
  $(me).off();
  $(me).html("<input id='magic-input'></input>")
  
  $("#magic-input").focus();
  $("#magic-input").val(store);
  
  var mejq = $(me) ;
  
  $("#magic-input").focusout(function(e) {
    $(me).html($("#magic-input").val() == "" ? store : $("#magic-input").val());
    $(me).click(magicEdit);
    
    alertLoading();
    $.ajax({
    type: "get",
    url: "api.php",
    dataType: "json",
    data: { "action": "update", 
            "id": $(me).data("id"), 
            "fromAction": $(me).data("action"), 
            "columnname": $(me).data("columnname"),
            "value": $(me).html()
    },
    success: function(data, status) {
        alertFinished();
        console.log(data);
        
        if (data.result == "success") {
            $(me).css('background-color', 'lightgreen');
        } else {
            $(me).css('background-color', 'lightpink');
        }
        
    }});
  });
}

 function showSearch(action, able="") {
    $("#result").prepend("<div>Keyword: <input id='keyword'></input><br>" +
            "Sort by price: <input type='radio' name='sortPriceBy' value='ascending'> Ascending (low to high) " +
            "<input type='radio' name='sortPriceBy' value='descending'> Descending (high to low)<br>" +
            "<button id='search'>Search</button></div>");
    $("#search").click(function() {
        generateTable("#result", action, able, $("#keyword").val(), $("input[type='radio']:checked").val());
        showSearch(action, able);
    });
}

var alertLoadingId = [];
var alertLoadingIndex = 0;
var zalgoText = "The Store";

function animate() {
    var zalgoConverted = generateRandomZalgo(zalgoText, zalgoMarks, settings, true);
    //console.log(zalgoConverted);
    $("#zalgofied").html(zalgoConverted[1]);
}

function alertLoading() {
    if (alertLoadingIndex == 0)
        alertLoadingId[alertLoadingIndex] = setInterval(animate, 140);
    alertLoadingIndex++;
}

function alertFinished() {
    if (--alertLoadingIndex == 0)
    clearInterval(alertLoadingId[alertLoadingIndex]);
}

function generateStatsContainer(target, action) {
    $(target).html("");
    
    $(target).html("\
<div class='container'>\
    <div class='row'>\
        <div class='col-sm-12 text-center'>\
            <div class='row'>\
                <div class='col-sm-4'> \
                  Number of Users:  <span id='amountOfUsers'></span>\
                </div>\
                <div class='col-sm-4'>\
                    Number of Products:  <span id='amountOfProducts'></span>\
                </div>\
                <div class='col-sm-4'> \
                  Number of Owned Products:  <span id='amountOfOwnerships'></span>\
                </div>\
            </div>\
        </div>\
    </div>\
    <br><br>\
    <div class='row'>\
        <div class='col-sm-12 text-center'>\
            <div class='row'>\
                <div class='col-sm-6'>\
                    Total Amount of Money:  <span id='amountTotalMoney'></span>\
                </div>\
                <div class='col-sm-6'> \
                    Average Amount of Money per User:  <span id='amountAverageMoney'></span>\
                </div>\
            </div>\
        </div>\
    </div>\
    <br><br>\
    <div class='row  text-center'>\
        Products sorted by most owned\
        <div class='col-sm-12 text-center' id='ownershipsSortedByMostOwned'>\
        \
        </div>\
    </div>\
    <br><br>\
    <div class='row  text-center'>\
        Users sorted by how much money they have\
        <div class='col-sm-12 text-center' id='usersSortedByMoney'>\
        \
        </div>\
    </div>\
</div>");
    
    alertLoading();
    $.ajax({
    type: "get",
    url: "api.php",
    dataType: "json",
    data: { "action": action },
    success: function(data, status) {
        alertFinished();
        console.log(data);
        
        // result
        if (data.result == "success") {
            // amountOfUsers
            // amountOfProducts
            // amountOfOwnerships
            
            // amountTotalMoney
            // amountAverageMoney
            
            // ownershipsSortedByMostOwned -array[name, count]
            // usersSortedByMoney -array[username, balance]
            
            
            var html = "";
            for (var user of data.usersSortedByMoney) {
            	html += "<div class='row'>";
            	for (var i in user) {
            		html += "<div class='col-sm-6'>" + user[i] + "</div>";	
            	}
            	html += "</div>";
            }
            $("#usersSortedByMoney").html(html);
            
            
            html = "";
            for (var item of data.ownershipsSortedByMostOwned) {
            	html += "<div class='row'>";
            	for (var i in item) {
            		html += "<div class='col-sm-6'>" + item[i] + "</div>";	
            	}
            	html += "</div>";
            }
            $("#ownershipsSortedByMostOwned").html(html);
            
            $("#amountAverageMoney").html(data.amountAverageMoney);
            $("#amountTotalMoney").html(data.amountTotalMoney);
            
            $("#amountOfOwnerships").html(data.amountOfOwnerships);
            $("#amountOfProducts").html(data.amountOfProducts);
            $("#amountOfUsers").html(data.amountOfUsers);
            
        } else {
            console.log("Error?! something's wrong with the server, this was working before, and it's all hardcoded.");
        }
    }});
}