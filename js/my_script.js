//menu on mouse over functie
$(document).ready(function () {
    $('.closed, .active').hover(function () {
        $(this).addClass('open');
    }, function () {
        $(this).removeClass('open');
    });
});

//Chat functie
$(document).ready(function() {
    $("#sub").click(function () {
        $.post($("#chat").attr("action"),
            $("#chat :input").serializeArray(),
            function (info) {
                $("#result").html(info);
                jQuery('#remaining').html("");
                document.getElementById("panel-body").scrollTop = 80000000;
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
                    document.getElementById("panel-body").scrollTop = 80000000;
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
    function scrollToBottom(){document.getElementById("panel-body").scrollTop = 80000000;}
    setTimeout(scrollToBottom,250);
    setInterval(function chatRefresh() {
        $('#chatRefresh').load('/includes/chatRefresh.php');
    }, 5000);
});

$(document).ready(function() {
    var count=5;

    setInterval(timer, 1000); //1000 will  run it every 1 second

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
    document.getElementById("panel-body").scrollTop = 80000000;
}

jQuery(document).ready(function($) {
    $('input').change(updateCountdown);
    $('input').keyup(updateCountdown);
});