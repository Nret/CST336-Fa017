
var zalgoMarks = {};

zalgoMarks['above'] = new Array("\u0300", "\u0301", "\u0302", "\u0303", "\u0304", "\u0305", "\u0306", "\u0307", "\u0308", "\u0309", "\u030A", "\u030B", "\u030C", "\u030D", "\u030E", "\u030F", "\u0310", "\u0311", "\u0312", "\u0313", "\u0314", "\u0315", "\u031A", "\u031B", "\u033D", "\u033E", "\u033F", "\u0340", "\u0341", "\u0342", "\u0343", "\u0344", "\u0346", "\u034A", "\u034B", "\u034C", "\u0350", "\u0351", "\u0352", "\u0357", "\u0358", "\u035B", "\u035D", "\u035E", "\u0360", "\u0361");

zalgoMarks['below'] = new Array("\u0316", "\u0317", "\u0318", "\u0319", "\u031C", "\u031D", "\u031E", "\u031F", "\u0320", "\u0321", "\u0322", "\u0323", "\u0324", "\u0325", "\u0326", "\u0327", "\u0328", "\u0329", "\u032A", "\u032B", "\u032C", "\u032D", "\u032E", "\u032F", "\u0330", "\u0331", "\u0332", "\u0333", "\u0339", "\u033A", "\u033B", "\u033C", "\u0345", "\u0347", "\u0348", "\u0349", "\u034D", "\u034E", "\u0353", "\u0354", "\u0355", "\u0356", "\u0359", "\u035A", "\u035C", "\u035F", "\u0362");

zalgoMarks['overlay'] = new Array("\u0334", "\u0335", "\u0336", "\u0337", "\u0338");

zalgoMarks['latin_letter_above'] = new Array("\u0363", "\u0364", "\u0365", "\u0366", "\u0367", "\u0368", "\u0369", "\u036A", "\u036B", "\u036C", "\u036D", "\u036E", "\u036F");

var zalgoMarksHtml = {"\u0300": "&#768;", "\u0301": "&#769;", "\u0302": "&#770;", "\u0303": "&#771;", "\u0304": "&#772;", "\u0305": "&#773;", "\u0306": "&#774;", "\u0307": "&#775;", "\u0308": "&#776;", "\u0309": "&#777;", "\u030A": "&#778;", "\u030B": "&#779;", "\u030C": "&#780;", "\u030D": "&#781;", "\u030E": "&#782;", "\u030F": "&#783;", "\u0310": "&#784;", "\u0311": "&#785;", "\u0312": "&#786;", "\u0313": "&#787;", "\u0314": "&#788;", "\u0315": "&#789;", "\u031A": "&#794;", "\u031B": "&#795;", "\u033D": "&#829;", "\u033E": "&#830;", "\u033F": "&#831;", "\u0340": "&#832;", "\u0341": "&#833;", "\u0342": "&#834;", "\u0343": "&#835;", "\u0344": "&#836;", "\u0346": "&#838;", "\u034A": "&#842;", "\u034B": "&#843;", "\u034C": "&#844;", "\u0350": "&#848;", "\u0351": "&#849;", "\u0352": "&#850;", "\u0357": "&#855;", "\u0358": "&#856;", "\u035B": "&#859;", "\u035D": "&#861;", "\u035E": "&#862;", "\u0360": "&#864;", "\u0361": "&#865;", "\u0316": "&#790;", "\u0317": "&#791;", "\u0318": "&#792;", "\u0319": "&#793;", "\u031C": "&#796;", "\u031D": "&#797;", "\u031E": "&#798;", "\u031F": "&#799;", "\u0320": "&#800;", "\u0321": "&#801;", "\u0322": "&#802;", "\u0323": "&#803;", "\u0324": "&#804;", "\u0325": "&#805;", "\u0326": "&#806;", "\u0327": "&#807;", "\u0328": "&#808;", "\u0329": "&#809;", "\u032A": "&#810;", "\u032B": "&#811;", "\u032C": "&#812;", "\u032D": "&#813;", "\u032E": "&#814;", "\u032F": "&#815;", "\u0330": "&#816;", "\u0331": "&#817;", "\u0332": "&#818;", "\u0333": "&#819;", "\u0339": "&#825;", "\u033A": "&#826;", "\u033B": "&#827;", "\u033C": "&#828;", "\u0345": "&#837;", "\u0347": "&#839;", "\u0348": "&#840;", "\u0349": "&#841;", "\u034D": "&#845;", "\u034E": "&#846;", "\u0353": "&#851;", "\u0354": "&#852;", "\u0355": "&#853;", "\u0356": "&#854;", "\u0359": "&#857;", "\u035A": "&#858;", "\u035C": "&#860;", "\u035F": "&#863;", "\u0362": "&#866;", "\u0334": "&#820;", "\u0335": "&#821;", "\u0336": "&#822;", "\u0337": "&#823;", "\u0338": "&#824;", "\u0363": "&#867;", "\u0364": "&#868;", "\u0365": "&#869;", "\u0366": "&#870;", "\u0367": "&#871;", "\u0368": "&#872;", "\u0369": "&#873;", "\u036A": "&#874;", "\u036B": "&#875;", "\u036C": "&#876;", "\u036D": "&#877;", "\u036E": "&#878;", "\u036F": "&#879;"};

var settings = {
    'above': {'min': 5, 'max': 10},
    'below': {'min': 5, 'max': 10},
    'overlay': {'min': 0, 'max': 1}
};

function getRandIntBetween(min, max) {
    return Math.floor(Math.random()*(max-min+1))+min;
}

function generateRandomZalgo (originalTxt, marksTable, generateSettings, generateHtmlTF) {

    var convertedTxt = "";
    var convertedHtml = "";

    for (var c = 0; c < originalTxt.length; c++) {
        convertedTxt += originalTxt.charAt(c);

        if (generateHtmlTF) {
            convertedHtml += originalTxt.charAt(c);
        }

        if (originalTxt.charAt(c) != " ") {
            for (var gSettingsType in generateSettings) {
                var randWithinSettings = getRandIntBetween(generateSettings[gSettingsType]['min'], generateSettings[gSettingsType]['max']);
                var markTypeLength = zalgoMarks[gSettingsType].length;

                for (var c2=0; c2 < randWithinSettings; c2++){
                    var markToInclude = marksTable[gSettingsType][getRandIntBetween(0,markTypeLength-1)];
                    convertedTxt += markToInclude;

                    if (generateHtmlTF) {
                        convertedHtml += zalgoMarksHtml[markToInclude];
                    }

                }

            }
        }
    }

    return new Array(convertedTxt, convertedHtml);
}

function setZalgo() {
    zalgoConverted = generateRandomZalgo($("#originaltext").val(), zalgoMarks, settings, viewingHtml);
    //alert();
    if ($("#textfor").val() == "facebook") {
        if (zalgoConverted[0] != "") {
            $("#zalgotext").val(".\r\n.\r\n"+zalgoConverted[0]+"\r\n.\r\n.");
            $("#zalgotext").css("line-height", "1.1em");
        } else {
            $("#zalgotext").val("");
        }
    }
    else {
        $("#zalgotext").val(zalgoConverted[0]);
        $("#zalgotext").css("line-height", "5em");
    }

    if (zalgoConverted[0] != "") {
        $("#generatezalgosubmit").val("Re-generate Zalgo Text");
    }

    if (viewingHtml) {
        $("#zalgohtml").val(zalgoConverted[1]);
    }
}

var viewingHtml = false;


// $(document).ready(function() {
//     $("#originaltext").focus();
//     $("#originaltext").keyup(function() {
//         setZalgo();
//     });

//     textClicksAfterFocus=0;
//     $("textarea#zalgotext").mouseup(function(event) {
//         if (textClicksAfterFocus==0) {
//             event.preventDefault();
//         }
//         textClicksAfterFocus++;
//     }).focus(function() {
//         $(this).select();
//         textClicksAfterFocus=0;
//     });

//     htmlClicksAfterFocus=0;
//     $("textarea#zalgohtml").mouseup(function(event) {
//         if (htmlClicksAfterFocus==0) {
//             event.preventDefault();
//         }
//         htmlClicksAfterFocus++;
//     }).focus(function() {
//         $(this).select();
//         htmlClicksAfterFocus=0;
//     });

//     $("#textfor").change(function() {
//         setZalgo();
//     });

//     $("input#generatezalgosubmit").click(function(e) {
//         setZalgo();
//         e.preventDefault();
//     });

//     $("input#viewhtml").click(function(e) {
//         $("input#viewhtml").hide();
//         $("div#zalgohtmlc").show();
//         viewingHtml = true;
//         setZalgo();
//         e.preventDefault();
//     });

//     $("form").submit(function(e) {
//         setZalgo();
//         //alert("s");
//         e.preventDefault();
//     });
// });

