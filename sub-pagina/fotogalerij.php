<?php include '../includes/html.php';?>
<script src="http://malsup.github.com/jquery.form.js"></script>
<div class="container">
    <div class="col-md-12 col-xs-12">
        <h1>Fotogalerij</h1>
        <hr>
        <script>
            if($_POST['name'] == "" || $_POST['name'] == " " || $_POST['name'] == null){
                
            }
            else {
                $("#myForm").ajaxForm({url: '../includes/fotoUpload.php', type: 'post'});

                $(function () {

                    $('#myForm').ajaxForm({
                        beforeSend: function () {
                            $(".progress").show();
                        },
                        uploadProgress: function (event, position, total, percentComplete) {
                            $(".progress-bar").width(percentComplete + '%');
                            $(".sr-only").html(percentComplete + '%');
                        },
                        success: function () {
                            $(':input', '#myForm')
                                .not(':button, :submit, :reset, :hidden')
                                .val('')
                                .removeAttr('checked')
                                .removeAttr('selected');
                            $(".progress").hide();
                        }
                    });
                    $(".progress").hide();
                });
            }
        </script>

        <form action="../includes/fotoUpload.php" method="post" id="myForm" enctype="multipart/form-data">
            <label>Naam van album:</label><input type="text" class="form-control" id="name" name="name" placeholder="Naam" REQUIRED><br>
            <input type="file" name="files[]" multiple REQUIRED><br>
            <input class="btn btn-success" type="submit" value="upload">
        </form><br>

        <div class="progress progress-striped active">
            <div class="progress-bar"  role="progressbar" aria-valuenow="0" aria-valuemin="0"
                 aria-valuemax="100" style="width: 0%">
                <span class="sr-only">0% Complete</span>
            </div>
        </div>

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
            <div class="col-md-4 col-xs-4 galerijImg">
                <a href="../images/fotogalerij/clubFoto-medium.jpg" data-src-320px="../images/fotogalerij/clubFoto-medium.jpg"
                   data-src-960px="../images/fotogalerij/clubFoto.jpg" title="Club foto" data-gallery>
                    <div class="change galerijBackImg" style="background-image: url('../images/fotogalerij/clubFoto-medium.jpg')"
                         data-src-320px="../images/fotogalerij/clubFoto-medium.jpg"
                         data-src-960px="../images/fotogalerij/clubFoto.jpg"
                         alt="Club foto"><img src="../images/fotogalerij/clubFoto-medium.jpg" style="width: 0px"/>
                    </div>
                </a>
            </div>
            <div class="col-md-4 col-xs-4 galerijImg">
                <a href="../images/fotogalerij/clubFotoGroot-medium.jpg" data-src-320px="../images/fotogalerij/clubFotoGroot-medium.jpg"
                   data-src-960px="../images/fotogalerij/clubFotoGroot.jpg" title="Club foto groot" data-gallery>
                    <div class="change galerijBackImg" style="background-image: url('../images/fotogalerij/clubFotoGroot-medium.jpg')"
                         data-src-320px="../images/fotogalerij/clubFotoGroot-medium.jpg"
                         data-src-960px="../images/fotogalerij/clubFotoGroot.jpg"
                         alt="Club foto groot"><img src="../images/fotogalerij/clubFotoGroot-medium.jpg" style="width: 0px"/>
                    </div>
                </a>
            </div>
            <div class="col-md-4 col-xs-4 galerijImg">
                <a href="../images/fotogalerij/clubFotoJuigen-medium.jpg" data-src-320px="../images/fotogalerij/clubFotoJuigen-medium.jpg"
                   data-src-960px="../images/fotogalerij/clubFotoJuigen.jpg" title="Club foto juigen" data-gallery>
                    <div class="change galerijBackImg" style="background-image: url('../images/fotogalerij/clubFotoJuigen-medium.jpg')"
                         data-src-320px="../images/fotogalerij/clubFotoJuigen-medium.jpg"
                         data-src-960px="../images/fotogalerij/clubFotoJuigen-medium.jpg"
                         alt="Club foto juigen"><img src="../images/fotogalerij/clubFotoJuigen-medium.jpg" style="width: 0px"/>
                    </div>
                </a>
            </div>
            <div class="col-md-4 col-xs-4 galerijImg">
                <a href="../images/fotogalerij/speech-medium.jpg" data-src-320px="../images/fotogalerij/speech-medium.jpg"
                   data-src-960px="../images/fotogalerij/speech.jpg" title="Speech" data-gallery>
                    <div class="change galerijBackImg" style="background-image: url('../images/fotogalerij/speech-medium.jpg')"
                         data-src-320px="../images/fotogalerij/speech-medium.jpg"
                         data-src-960px="../images/fotogalerij/speech.jpg"
                         alt="Speech"><img src="../images/fotogalerij/speech-medium.jpg" style="width: 0px"/>
                    </div>
                </a>
            </div>
            <div class="col-md-4 col-xs-4 galerijImg">
                <a href="../images/fotogalerij/speech2-medium.jpg" data-src-320px="../images/fotogalerij/speech2-medium.jpg"
                   data-src-960px="../images/fotogalerij/speech2.jpg" title="Speech2" data-gallery>
                    <div class="change galerijBackImg" style="background-image: url('../images/fotogalerij/speech2-medium.jpg')"
                         data-src-320px="../images/fotogalerij/speech2-medium.jpg"
                         data-src-960px="../images/fotogalerij/speech2.jpg"
                         alt="Speech2"><img src="../images/fotogalerij/speech2-medium.jpg" style="width: 0px"/>
                    </div>
                </a>
            </div>
            <div class="col-md-4 col-xs-4 galerijImg">
                <a href="../images/fotogalerij/ballonen-medium.jpg" data-src-320px="../images/fotogalerij/ballonen-medium.jpg"
                   data-src-960px="../images/fotogalerij/ballonen.jpg" title="Ballonen" data-gallery>
                    <div class="change galerijBackImg" style="background-image: url('../images/fotogalerij/ballonen-medium.jpg')"
                         data-src-320px="../images/fotogalerij/ballonen-medium.jpg"
                         data-src-960px="../images/fotogalerij/ballonen.jpg"
                         alt="Ballonen"><img src="../images/fotogalerij/ballonen-medium.jpg" style="width: 0px"/>
                    </div>
                </a>
            </div>
        </div>
        </br>
    </div>
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
<script src="../js/jquery.blueimp-gallery.min.js"></script>
<script src="../js/bootstrap-image-gallery.js"></script>