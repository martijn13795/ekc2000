<?php include '../includes/html.php';?>
<script src="http://malsup.github.com/jquery.form.js"></script>
<div class="container">
    <div class="col-md-12 col-xs-12">
        <h1>Fotogalerij</h1>
        <hr>
        <div class="hidden-xs">

            <form action="../includes/fotoUpload.php" method="post" class="myForm" name="myForm" enctype="multipart/form-data">
                <label>Naam van album:</label><input type="text" id="name" class="form-control" name="name" placeholder="Naam" maxlength="60" REQUIRED><br>
                <input type="file" id="file" name="files[]" multiple REQUIRED><br>
                <input class="btn btn-success" type="submit" value="upload">
            </form><br>

            <div id="error"></div><br>

            <div class="progress progress-striped active">
                <div class="progress-bar"  role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100" style="width: 0%">

                </div>
            </div>
        </div>
            <?php
            include_once('../includes/db.php');
            $select = mysql_query('SELECT albumID, date, albumName FROM fotogalerij ORDER BY albumID DESC') or die(mysql_error());
            while ($selecting = mysql_fetch_array($select)) {
                echo '<div class="well"><a href="/album/'.$selecting['albumName'].'">' . $selecting['albumName'] = str_replace('-', ' ', $selecting['albumName']) . ' </a>' . $selecting['date'] . '</div>';
            }
            mysql_close();
            ?>
    </div>
    <script>
        $(document).ready(function() {
            $('.myForm').ajaxForm({
                beforeSend:function(){
                    $(".progress").show();
                },
                uploadProgress:function(event,position,total,percentComplete){
                        $(".progress-bar").width(percentComplete + '%');
                        $(".progress-bar").html('<p>'+ percentComplete + ' %'+'</p>');
                },
                success:function(response){
                    $(".progress-bar").addClass('progress-bar-success');
                    $("#error").show();
                    $("#error").html(response);
                    $("#name").val('');
                    $("#file").val('');
                }
            });
            $(".progress").hide();
            $("#error").hide();
        });
    </script>
</div>