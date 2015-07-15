$(document).ready(function() {
    $("#sub").click(function () {
        $.post($("#chat").attr("action"),
            $("#chat :input").serializeArray(),
            function (info) {
                $("#result").html(info);
            });
        clearInput();
    });
});

$("#chat").submit( function() {
    return false;
});

$(document).ready(function(){
    $("input").keypress(function (e) {
        var k = e.keyCode || e.which;
        if (k == 13) {

            $.post($("#chat").attr("action"),
                $("#chat :input").serializeArray(),
                function (info) {
                    $("#result").html(info);
                });
            clearInput();
            return false;
        }
    });
});

function clearInput() {
    $("#chat :input").each( function() {
        $(this).val('');
    });
}

function chat() {
    var ActualscrollHeight = document.getElementById("panel-body").clientHeight;
    var down = true;
    setInterval(function () {
        var scrollHeight = document.getElementById("panel-body").scrollTop;
        if (scrollHeight == 0) {
            down = true;
        } else if (scrollHeight >= ActualscrollHeight) {
            down = false;
        }
        scrollHeight = (!down) ? scrollHeight + 4000 : scrollHeight + 4000;
        document.getElementById("panel-body").scrollTop = scrollHeight;
    }, 5);
}
chat();

$(document).ready(function() {
    setInterval(function chatRefresh() {
        $('#chatRefresh').load('/includes/chatRefresh.php')
    }, 5000);
});