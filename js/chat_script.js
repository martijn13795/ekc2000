$("#sub").click( function() {
    $.post( $("#chat").attr("action"),
        $("#chat :input").serializeArray(),
        function(info){ $("#result").html(info);
        });
    clearInput();
});

$("#chat").submit( function() {
    return false;
});

function clearInput() {
    $("#chat :input").each( function() {
        $(this).val('');
    });
}