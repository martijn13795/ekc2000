<?php include '../includes/html.php';
$user = new User();
?>
    <script src="https://<?php echo $_SERVER['SERVER_NAME']; ?>/ckeditor/ckeditor.js"></script>
    <script src="https://<?php echo $_SERVER['SERVER_NAME']; ?>/js/jquery.form.js"></script>
    <div class="container">
        <?php

        $id = $_GET['id'];

        $datas = $db->query("SELECT * FROM `commissions` WHERE `id` = '".$id."'");
        if ($datas->count()) {
            foreach ($datas->results() as $data) {
                $name = $data->name;
                $vacancyText = $data->vacancyText;
            }
        }
        if ($user->isLoggedIn()) {
        ?>
        <h1>Bewerk - Extra info <?php echo $name; ?></h1>
        <hr>
        <div class="hidden visible-lg">
            <div id="uploadContainer">
                <form action="../includes/editVacancyText.php?id=<?php echo $id; ?>" method="POST" class="myForm" name="myForm">
                    <textarea class="ckeditor" id="editor1" name="editor1"><?php echo $vacancyText; ?></textarea><br>
                    <input type="submit" onClick="CKupdate()" id="submit" class="btn btn-primary" value="Bewerken"/>
                </form>
                <button class="btn btn-info" id="refresh" onclick="window.location.href = '/bewerk-commissies';">Terug</button>
                <br>
                <div id="error"></div>
            </div>
        </div>
        <br>

    </div>
    <?php
}
?>
    <script>
        function CKupdate(){
            for ( var instance in CKEDITOR.instances )
                CKEDITOR.instances[instance].updateElement();
        }

        $(document).ready(function () {
            $('.myForm').ajaxForm({
                beforeSend: function () {
                    $("#error").show();
                    $("#error").html('<h3>Even geduld alstublieft</h3><p>Refresh de pagina niet</p>');
                },
                success: function (response) {
                    if (response == "<h3>Het bewerken is voltooid</h3>Ga terug naar de pagina<br><br>"){
                        $("#submit").hide();
                        $("#refresh").show();
                        $('.alerts').append('<div class="alert alert-success alert-dismissable">' +
                            '<button class="close" data-dismiss="alert">&times;</button>' +
                            'Het bewerken is voltooid' +
                            '</div>');
                    }
                    setTimeout(function () {
                        $('.alerts').children('.alert:last-child').addClass('on');
                        setTimeout(function () {
                            $('.alerts').children('.alert:first-child').removeClass('on');
                            setTimeout(function () {
                                $('.alerts').children('.alert:first-child').remove();
                            }, 900);
                        }, 5000);
                    }, 10);
                    $("#error").show();
                    $("#error").html(response);
                }
            });
            $("#error").hide();
            $("#refresh").hide();
        });
    </script>
<?php include '../includes/htmlUnder.php'; ?>