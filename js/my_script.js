//menu on mouse over functie
$(document).ready(function () {

    $('ul').hover(function () {
        $(".open > .dropdown-toggle").attr("style","color: rgba(255, 255, 255, 1); background-color: rgba(55, 192, 251, 1);");
    }, function () {
        $(".dropdown-toggle").attr("style","");
    });


    $('.closed, .active').hover(function () {
        $(this).addClass('open');
    }, function () {
        $(this).removeClass('open');
    });
});