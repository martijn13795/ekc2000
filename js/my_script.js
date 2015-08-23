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

    var logedout = localStorage.getItem("logedout");
    if (logedout != "nee") {
        $(document).ready(function () {
        logedout = "nee";
        localStorage.setItem("logedout", logedout);
        if (!$(".alert").hasClass("on")) {
            var message = '<div class="alert alert-warning alert-dismissable">' +
                '<button class="close" data-dismiss="alert">&times;</button>' +
                'U bent succesvol uitgelogd' +
                '</div>';
            $('.alert').append(message);
            setTimeout(function () {
                $('.alert').addClass('on');
                setTimeout(function () {
                    $('.alert').removeClass('on');
                }, 5000);
            }, 10);
        }
    });
}