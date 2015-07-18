//menu on mouse over functie
$(document).ready(function () {
    $('.closed, .active').hover(function () {
        $(this).addClass('open');
    }, function () {
        $(this).removeClass('open');
    });
});