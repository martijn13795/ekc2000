//menu on mouse over functie
$(document).ready(function () {
    $('.closed, .active').hover(function () {
        $(this).addClass('open');
    }, function () {
        $(this).removeClass('open');
    });
});

$(document).ready(function () {
    $(function () {
        'use strict';

        $('#borderless-checkbox').on('change', function () {
            var borderless = $(this).is(':checked');
            $('#blueimp-gallery').data('useBootstrapModal', !borderless);
            $('#blueimp-gallery').toggleClass('blueimp-gallery-controls', borderless);
        });

        $('#fullscreen-checkbox').on('change', function () {
            $('#blueimp-gallery').data('fullScreen', $(this).is(':checked'));
        });

        $('#image-gallery-button').on('click', function (event) {
            event.preventDefault();
            blueimp.Gallery($('#links a'), $('#blueimp-gallery').data());
        });

    });
});

$(document).ready(function() {
    var mqsmall = "(min-device-width:320px)";
    var mqbig   = "(min-device-width:900px)";
    function imageresize() {
        if(window.matchMedia(mqbig).matches) {
            $('img[data-src-1260px]').each(function () {
                $(this).attr('src',$(this).attr('data-src-1260px'));
            });
        }
        else {
            $('img[data-src-960px]').each(function () {
                $(this).attr('src',$(this).attr('data-src-960px'));
            });
        }
    }

    imageresize();

    $(window).bind("resize", function() {
        imageresize();
    });
});