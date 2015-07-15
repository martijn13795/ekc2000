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

$(document).ready(function() {
    function refresh{
    setInterval(function chatRefresh() {
        $('#chatRefresh').load('/includes/chatRefresh.php')
    }, 5000);
})};