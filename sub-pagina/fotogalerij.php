<?php include '../includes/html.php';?>
<script src="http://malsup.github.com/jquery.form.js"></script>
<div class="container">
    <div class="col-md-12 col-xs-12">
        <h1>Fotogalerij</h1>
        <hr>
        <div class="hidden-xs">

            <form action="../includes/fotoUpload.php" method="post" class="myForm" name="myForm" enctype="multipart/form-data">
                <label>Naam van album:</label><input type="text" class="form-control" name="name" placeholder="Naam" REQUIRED><br>
                <input type="file" name="files[]" multiple REQUIRED><br>
                <input class="btn btn-success" type="submit" value="upload">
            </form><br>

            <div id="error"></div><br><br>

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
    <script>
//        laat de echo's uit de php file zien
//                    $(document).ready(function() {
//                        $("form").submit(function () {
//                            $(".error").empty();
//                            $.post($("myForm").attr("action"),
//                                $("#myForm :input").serializeArray(),
//                                function (info) {
//                                    $(".error").html(info);
//                                });
//                        });
//                    });

//        submit het form
//                    $(document).ready( function () {
//                        $('form').submit( function () {
//                            var formdata = $(this).serialize();
//                            $.ajax({
//                                type: "POST",
//                                url: "../includes/fotoUpload.php",
//                                data: formdata,
//                                success: function (response) {
//                                    $("#error").empty();
//                                    $("#error").html(response);
//                                }
//                            });
//                            return false;
//                        });
//                    });

//        $(function () {
//            $('#myForm').submit(function (e) {
//                $.ajax({
//                    url: '../includes/fotoUpload.php',
//                    type: 'POST',
//                    data: {},
//                    success: function() {alert("Success");},
//                    complete: function() {alert("Completed");}
//                });
//                return false;
//            });
//        });
//
//        $(document).ready( function () {
//            $('form.myForm').on('submit', function (event) {
//                event.preventDefault();
//                console.log( $( this ).serialize() );
//                var that = $(this),
//                    url = that.attr('action'),
//                    type = that.attr('method'),
//                    data = [];
//
//                that.find('[name]').each(function (index, value) {
//                    var that = $(this),
//                        name = that.attr('name'),
//                        value = that.val();
//
//                    data[name] = value;
//
//                });
//
//                $.ajax({
//                    url: url,
//                    type: type,
//                    data: data,
//                    success: function (response) {
//                        $("#error").empty();
//                        $("#error").html(response);
//                    }
//                });
//                return false;
//            });
//        });

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
    </script>
</div>