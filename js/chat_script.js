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
    $('#chat').keypress(function(e){
        if(e.keyCode==13)
            $('#sub').click();
        return false;
    });
});

function clearInput() {
    $("#chat :input").each( function() {
        $(this).val('');
    });
}