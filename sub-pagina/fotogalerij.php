<?php include '../includes/html.php';?>
<script src="http://malsup.github.com/jquery.form.js"></script>
<div class="container">
    <div class="col-md-12 col-xs-12">
        <h1>Fotogalerij</h1>
        <hr>
        <div class="hidden-xs">

            <form action="../includes/fotoUpload.php" method="post" class="myForm" id="myForm" name="myForm" enctype="multipart/form-data">
                <label>Naam van album:</label><input type="text" id="name" class="form-control" name="name" placeholder="Naam" maxlength="60" REQUIRED><br>
                <input type="file" id="file" name="files[]" multiple REQUIRED><br>
                <input class="btn btn-success" type="submit" value="upload">
            </form><br>

            <div id="error"></div><br><br>

            <div class="progress progress-striped active">
                <div class="progress-bar"  role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100" style="width: 0%">
                    <span class="sr-only">0% Complete</span>
                </div>
            </div>
        </div>
            <?php
            include_once('../includes/db.php');
            $select = mysql_query('SELECT date, albumName FROM fotogalerij') or die(mysql_error());
            while ($selecting = mysql_fetch_array($select)) {
                echo '<div class="well"><a href="/album/'.$selecting['albumName'].'">' . $selecting['albumName'] = str_replace('-', ' ', $selecting['albumName']) . ' </a>' . $selecting['date'] . '</div>';
            }
            mysql_close();
            ?>
    </div>
    <script>
        //De progressbar
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

        var fileCollection = new Array();
        $('#images').on('change',function(e){
            var files = e.target.files;
            $.each(files, function(i, file){
                fileCollection.push(file);
                var reader = new FileReader();
                reader.readAsDataURL(file);
                reader.onload = function(e){
                    $('#images-to-upload').append(template);
                };
            });
        });

        $(document).on('submit','form',function(e){
            e.preventDefault();
            var index = $(this).index();
            var formdata = new FormData($(this)[0]);

            formdata.append('image',fileCollection[index]);
            var request = new XMLHttpRequest();
            request.open('post', '../includes/fotoUpload.php', true);
            request.send(formdata);
            $("#name").val('');
            $("#file").val('');
        });
    </script>
</div>