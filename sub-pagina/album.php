<?php include '../includes/html.php'; ?>
<div class="container">
    <div class="col-md-12 col-xs-12">
        <h1>Album - <?php $name = $_GET['name'];
            echo $name = str_replace('-', ' ', $name); ?></h1>
        <hr>
        <button onclick="history.go(-1)" type="button" class="btn btn-info">
            Ga terug
        </button>
        <br><br>

        <form class="form-inline">
            <div class="form-group">
                <button id="image-gallery-button" type="button" class="btn btn-primary btn-lg">
                    <i class="glyphicon glyphicon-picture"></i>
                    Start slideshow
                </button>
            </div>
            <div class="btn-group" data-toggle="buttons">
                <label class="btn btn-success btn-lg active">
                    <i class="glyphicon glyphicon-leaf"></i>
                    <input id="borderless-checkbox" type="checkbox" checked> Borderless
                </label>
                <label class="btn btn-primary btn-lg">
                    <i class="glyphicon glyphicon-fullscreen"></i>
                    <input id="fullscreen-checkbox" type="checkbox"> Fullscreen
                </label>
            </div>
        </form>
        </br>
        <div id="links">
            <?php
            $db = DB::getInstance();
            $name = $_GET['name'];
            rawurldecode($name);
            $album = $db->query("SELECT id FROM albums WHERE name = '" . $name . "'")->first();
            $pics = $db->query("SELECT * FROM pictures WHERE album_id = '$album->id'");
            if ($pics->count()) {
                foreach ($pics->results() as $pic) {
                    echo '
                        <div class="col-md-4 col-xs-4 galerijImg">';
                    if (($user->isLoggedIn() && $user->data()->id == $pic->user_id) || $user->hasPermission("admin")) { echo '<div class="imageDel"><i class="fa fa-trash-o imageDelButton" onclick="imageDel(\''. escape($pic->id) .'\', \''. escape($pic->pathMobile) .'\');"></i></div>';}
                           echo' <a href="' . escape($pic->pathMobile) . '" data-src-320px="' . escape($pic->pathMobile) . '"
                               data-src-960px="' . escape($pic->path) . '" title="' . escape($pic->name) . '" data-gallery>
                                <div class="change galerijBackImg col-md-12" style="background-image: url(' . escape($pic->pathMobile) . ')"
                                     data-src-320px="' . escape($pic->pathMobile) . '"
                                     data-src-960px="' . escape($pic->path) . '"
                                     alt="' . escape($pic->name) . '">
                                     <img src="' . escape($pic->pathMobile) . '" data-src-320px="' . escape($pic->pathMobile) . '"
                                        data-src-960px="' . escape($pic->path) . '" alt="' . escape($pic->name) . '" style="width: 0px"/>
                                </div>
                            </a>
                        </div>
                        ';
                }
            } else {
                echo "<h1>Dit album heeft nog geen afbeeldingen.</h1>";
            }
            ?>
        </div>
        </br>
        <!-- The Bootstrap Image Gallery lightbox, should be a child element of the document body -->
        <div id="blueimp-gallery" class="blueimp-gallery blueimp-gallery-controls" style="display: none;">
            <!-- The container for the modal slides -->
            <div class="slides" style="width: 136200px;"></div>
            <!-- Controls for the borderless lightbox -->
            <a class="prev">&lsaquo;</a>
            <a class="next">&rsaquo;</a>
            <a class="close">x</a>
            <a class="play-pause"></a>
            <ol class="indicator"></ol>
            <!-- The modal dialog, which will be used to wrap the lightbox content -->
            <div class="modal fade">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" aria-hidden="true">x</button>
                            <h4 class="modal-title"></h4>
                        </div>
                        <div class="modal-body next"></div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-default pull-left prev">
                                <i class="glyphicon glyphicon-chevron-left"></i>
                                Vorige
                            </button>
                            <button type="button" class="btn btn-primary next">
                                Volgende
                                <i class="glyphicon glyphicon-chevron-right"></i>
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script src="../js/jquery.blueimp-gallery.min.js"></script>
<script src="../js/bootstrap-image-gallery.js"></script>
<script>
    function imageDel(id, path){
        if (!$(".alert").hasClass("on")) {
            $('.alerts').append('<div class="alert alert-danger alert-dismissable">' +
                '<button class="close" onclick="$(`.alerts`).removeClass(`on`); $(`.alerts`).children(`.alert:first-child`).remove();">&times;</button>' +
                'Weet u zeker dat u deze afbeelding wilt verwijderen?<br><br>' +
                '<img src="' + path + '" class="img-responsive imageDelAlert"/><br><br>' +
                '<button class="btn btn-warning" onclick="imageRemove(' + id + ')">Verwijderen</button>&#09;' +
                '<button class="btn btn-success" onclick="$(`.alerts`).removeClass(`on`);  $(`.alerts`).children(`.alert:first-child`).remove();">Annuleren</button>' +
                '</div>');
            setTimeout(function () {
                $('.alerts').children('.alert:last-child').addClass('on');
            }, 10);
        }
    }

    function imageRemove(id){
        $.get("../includes/removeImage.php?id=" + id), function(data){
            $('#result').html(data);
        };
        setTimeout(function () {
            location.reload();
        }, 100);
    }
</script>
<?php include '../includes/htmlUnder.php'; ?>