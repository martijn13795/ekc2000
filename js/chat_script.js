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
                setTimeout(scrollToBottom, 300);
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
                    setTimeout(scrollToBottom, 300);
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
    setTimeout(scrollToBottom,1000);
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
            var val = localStorage.getItem("val");
            $.post('../includes/chatRefresh.php', {more: val},
                function (returnedData) {
                    $('#chatRefresh').html(returnedData);
                });
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

function removeMes(id){
    if (!$(".alert").hasClass("on")) {
        $('.alerts').append('<div class="alert alert-danger alert-dismissable">' +
            '<button class="close" onclick="$(`.alerts`).removeClass(`on`); $(`.alerts`).children(`.alert:first-child`).remove();">&times;</button>' +
            'Weet u zeker dat u dit bericht wilt verwijderen?<br><br>' +
            '<button class="btn btn-warning" onclick="removeTrue(' + id + ') & $(`.alerts`).removeClass(`on`);  $(`.alerts`).children(`.alert:first-child`).remove();">Verwijderen</button>&#09;' +
            '<button class="btn btn-success" onclick="$(`.alerts`).removeClass(`on`);  $(`.alerts`).children(`.alert:first-child`).remove();">Annuleren</button>' +
            '</div>');
        setTimeout(function () {
            $('.alerts').children('.alert:last-child').addClass('on');
        }, 10);
    }
}

function removeTrue(id){
    $.get("includes/removeMessage.php?id=" + id), function(data){
        $('#result').html(data);
    };
    $(".alerts").append('<div class="alert alert-danger alert-dismissable">' +
        '<button class="close" data-dismiss="alert">&times;</button>' +
        'Het bericht is verwijderd' +
        '</div>');
    setTimeout(function () {
        $('.alerts').children('.alert:last-child').addClass('on');
        setTimeout(function () {
            $('.alerts').children('.alert:first-child').removeClass('on');
            setTimeout(function () {
                $('.alerts').children('.alert:first-child').remove();
            }, 900);
        }, 5000);
    }, 10);
    $('#chatRefresh').load('/includes/chatRefresh.php');
}

function approveMes(id){
    if (!$(".alert").hasClass("on")) {
        $('.alerts').append('<div class="alert alert-warning alert-dismissable">' +
            '<button class="close" onclick="$(`.alerts`).removeClass(`on`); $(`.alerts`).children(`.alert:first-child`).remove();">&times;</button>' +
            'Weet u zeker dat u dit bericht wilt goedkeuren?<br><br>' +
            '<button class="btn btn-success" onclick="approveTrue(' + id + ') & $(`.alerts`).removeClass(`on`);  $(`.alerts`).children(`.alert:first-child`).remove();">Goedkeuren</button>&#09;' +
            '<button class="btn btn-primary" onclick="$(`.alerts`).removeClass(`on`);  $(`.alerts`).children(`.alert:first-child`).remove();">Annuleren</button>' +
            '</div>');
        setTimeout(function () {
            $('.alerts').children('.alert:last-child').addClass('on');
        }, 10);
    }
}

function approveTrue(id){
    $.get("includes/approveMessage.php?id=" + id), function(data){
        $('#result').html(data);
    };
    $(".alerts").append('<div class="alert alert-success alert-dismissable">' +
        '<button class="close" data-dismiss="alert">&times;</button>' +
        'Het bericht is goedgekeurd' +
        '</div>');
    setTimeout(function () {
        $('.alerts').children('.alert:last-child').addClass('on');
        setTimeout(function () {
            $('.alerts').children('.alert:first-child').removeClass('on');
            setTimeout(function () {
                $('.alerts').children('.alert:first-child').remove();
            }, 900);
        }, 5000);
    }, 10);
    $('#chatRefresh').load('/includes/chatRefresh.php');
}

function disapproveMes(id){
    if (!$(".alert").hasClass("on")) {
        $('.alerts').append('<div class="alert alert-warning alert-dismissable">' +
            '<button class="close" onclick="$(`.alerts`).removeClass(`on`); $(`.alerts`).children(`.alert:first-child`).remove();">&times;</button>' +
            'Weet u zeker dat u dit bericht wilt afkeuren?<br><br>' +
            '<button class="btn btn-danger" onclick="disapproveTrue(' + id + ') & $(`.alerts`).removeClass(`on`);  $(`.alerts`).children(`.alert:first-child`).remove();">Afkeuren</button>&#09;' +
            '<button class="btn btn-primary" onclick="$(`.alerts`).removeClass(`on`);  $(`.alerts`).children(`.alert:first-child`).remove();">Annuleren</button>' +
            '</div>');
        setTimeout(function () {
            $('.alerts').children('.alert:last-child').addClass('on');
        }, 10);
    }
}

function disapproveTrue(id){
    $.get("includes/disapproveMessage.php?id=" + id), function(data){
        $('#result').html(data);
    };
    $(".alerts").append('<div class="alert alert-warning alert-dismissable">' +
        '<button class="close" data-dismiss="alert">&times;</button>' +
        'Het bericht is afgekeurd' +
        '</div>');
    setTimeout(function () {
        $('.alerts').children('.alert:last-child').addClass('on');
        setTimeout(function () {
            $('.alerts').children('.alert:first-child').removeClass('on');
            setTimeout(function () {
                $('.alerts').children('.alert:first-child').remove();
            }, 900);
        }, 5000);
    }, 10);
    $('#chatRefresh').load('/includes/chatRefresh.php');
}