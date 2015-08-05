<?php include '../includes/html.php';?>
<script src="http://malsup.github.com/jquery.form.js"></script>
<div class="container">
    <div class="col-md-12 col-xs-12">
        <h1>Fotogalerij</h1>
        <hr>
        <script>
            $(function(){
                $('#myForm').ajaxForm({
                    beforeSend:function(){
                        $(".progress").show();
                    },
                    uploadProgress:function(event,position,total,percentComplete){
                        $(".progress-bar").width(percentComplete+'%');
                        $(".sr-only").html(percentComplete+'%');
                    },
                    success:function(){
                        $(':input','#myForm')
                            .not(':button, :submit, :reset, :hidden')
                            .val('')
                            .removeAttr('checked')
                            .removeAttr('selected');
                        $(".progress").hide();
                    }
                });
                $(".progress").hide();
            });

            //laat de echo's uit de php file zien
            $(document).ready(function() {
                $("myForm").submit(function () {
                    $(".error").empty();
                    $.post($("#myForm").attr("action"),
                        $("#myForm :input").serializeArray(),
                        function (info) {
                            return false;
                            $(".error").html(info);
                        });
                    return false;
                });return false;
            });

            //submit het form
            $(document).ready( function () {
                $('myForm').submit( function () {
                    var formdata = $(this).serialize();
                    $.ajax({
                        type: "POST",
                        url: "../includes/fotoUpload.php",
                        data: formdata
                    });
                    return false;
                });
            });
        </script>

        <div class="hidden-xs">
            <form action="../includes/fotoUpload.php" method="post" id="myForm" name="myForm" enctype="multipart/form-data">
                <label>Naam van album:</label><input type="text" class="form-control" id="name" name="name" placeholder="Naam"><br>
                <input type="file" name="files[]" multiple><br>
                <input class="btn btn-success" type="submit" value="upload">
            </form><br>

            <span class="error"></span><br><br>

            <div class="progress progress-striped active">
                <div class="progress-bar"  role="progressbar" aria-valuenow="0" aria-valuemin="0"
                     aria-valuemax="100" style="width: 0%">
                    <span class="sr-only">0% Complete</span>
                </div>
            </div>
        </div>
            <?php
            include_once('../includes/db.php');
            $select = mysql_query('SELECT date, albumName FROM fotogalerij') or die(mysql_error());
            while ($selecting = mysql_fetch_array($select)) {
                echo '<div class="well"><a href="/album/'.$selecting['albumName'].'">' . $selecting['albumName'] . ' </a>' . $selecting['date'] . '</div>';
            }
            mysql_close();
            ?>
    </div>
</div>