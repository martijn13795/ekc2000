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
    var mqbig   = "(min-device-width:960px)";
    function imageresize() {
        if(window.matchMedia(mqbig).matches) {
            $('img[data-src-960px]').each(function () {
                $(this).attr('src',$(this).attr('data-src-960px'));
            });
        }
        else {
            $('img[data-src-320px]').each(function () {
                $(this).attr('src',$(this).attr('data-src-320px'));
            });
        }
    }
        imageresize();
    $(window).bind("resize", function() {
        imageresize();
    });
});




//$(document).ready(function() {
//    var div = $("div, .galerijImg");
//    var imgsrc = div.find('img').attr('src');
//
//    var img = new Image();
//    img.onload = function(){
//        var imgw = img.width;
//        var imgh = img.height;
//
//        //after its loaded and you got the size..
//        //you need to call it the first time of course here and make it visible:
//
//        resizeMyImg(imgw,imgh);
//        div.find('img').show();
//
//        //now you can use your resize function
//        $(window).resize(function(){ resizeMyImg(imgw,imgh); });
//
//    };
//    img.src = imgsrc;
//
//    function resizeMyImg(w,h){
//        //the width is larger
//        if (w > h) {
//            //resize the image to the div
//            div.find('img').width(div.innerWidth() + 'px').height('auto');
//        }
//        else {
//            // the height is larger or the same
//            //resize the image to the div
//            div.find('img').height(div.innerHeight() + 'px').width('auto');
//        }
//    }
//});