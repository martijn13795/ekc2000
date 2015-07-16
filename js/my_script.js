//Twitter functie
!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0],p=/^http:/.test(d.location)?'http':'https';if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src=p+"://platform.twitter.com/widgets.js";fjs.parentNode.insertBefore(js,fjs);}}(document,"script","twitter-wjs");

//menu on mouse over functie
$(document).ready(function () {
    $('.closed').hover(function () {
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
    setTimeout(scrollToBottom,100);
    function chat() {
        var ActualscrollHeight = document.getElementById("panel-body").clientHeight;
        var down = true;
            var scrollHeight = document.getElementById("panel-body").scrollTop;
            if (scrollHeight == 0) {
                down = true;
            } else if (scrollHeight >= ActualscrollHeight) {
                down = false;
            }
            scrollHeight = (!down) ? scrollHeight + 200 : scrollHeight + 200;
            document.getElementById("panel-body").scrollTop = scrollHeight;
    }
    setInterval(function chatRefresh() {
        $('#chatRefresh').load('/includes/chatRefresh.php');
        setTimeout(chat,100)
    }, 5000);
});

$(document).ready(function() {
    var count=5;

    setInterval(timer, 1000); //1000 will  run it every 1 second

    function timer()
    {
        document.getElementById("timer").innerHTML=" Refresh in: " + count;
        count=count-1;
        if (count <= -1)
        {
            count = 5;
            return;
        }
    }timer();
});