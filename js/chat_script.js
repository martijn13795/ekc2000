var scroll = 80000000;
var ua = window.navigator.userAgent;
var msie = ua.indexOf("MSIE ");

if (msie > 0 || !!navigator.userAgent.match(/Trident.*rv\:11\./) || navigator.userAgent.indexOf("Edge") > 0){
    var scroll = -80000000;
}

//Chat functie
$(document).ready(function() {
    $("#sub").click(function () {
        $.post($("#chat").attr("action"),
            $("#chat :input").serializeArray(),
            function (info) {
                $("#result").html(info);
                jQuery('#remaining').html("");
                document.getElementById("panel-body").scrollTop = scroll;
            });
        clearInput();
    });
});

//Blijf op pagina na submit
$("#chat").submit( function() {
    return false;
});

//Blijf op pagina en submit bij enter toets
$(document).ready(function(){
    $("input").keypress(function (e) {
        var k = e.keyCode || e.which;
        if (k == 13) {
            $.post($("#chat").attr("action"),
                $("#chat :input").serializeArray(),
                function (info) {
                    $("#result").html(info);
                    document.getElementById("panel-body").scrollTop = scroll;
                });
            clearInput();
            return false;
        }
    });
});

//clear input na submit
function clearInput() {
    $("#chat :input").each( function() {
        $(this).val('');
    });
}

//Refresh function met scroll down functie
$(document).ready(function() {
    $('#chatRefresh').load('/includes/chatRefresh.php');
    function scrollToBottom(){document.getElementById("panel-body").scrollTop = scroll;}
    setTimeout(scrollToBottom,250);
    setInterval(function chatRefresh() {
        $('#chatRefresh').load('/includes/chatRefresh.php');
    }, 5000);
});

$(document).ready(function() {
    var count=5;

    setInterval(timer, 1000);

    function timer()
    {
        document.getElementById("timer").innerHTML=" Refresh in: " + count;
        count=count-1;
        if (count <= 0)
        {
            count = 5;
            return;
        }
    }timer();
});

function updateCountdown() {
    // 140 is the max message length
    var remaining = 140 - jQuery('input').val().length;
    jQuery('#remaining').html("<p>"+remaining+" characters over</p>");
    document.getElementById("panel-body").scrollTop = scroll;
}

jQuery(document).ready(function($) {
    $('input').change(updateCountdown);
    $('input').keyup(updateCountdown);
});

function del () {
    $('#chatRefresh').load('/includes/chatRefresh.php');
}