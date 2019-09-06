<?php
include '../includes/html.php';

if ($user->isLoggedIn() && ($user->hasPermission('dev') || $user->hasPermission('admin'))) {
    ?>
    <script src="https://<?php echo $_SERVER['SERVER_NAME']; ?>/js/jquery.form.js"></script>
    <div class="container">
        <h1>Wachtwoord resetten</h1>
        <hr>
        <button class="btn btn-primary" id="form" onclick="showForm()">Reset</button>
        <br><br>
        <div id="formContainer" hidden>
            <form method="post" action="../includes/resetPassword.php" name="myForm" class="myForm" enctype="multipart/form-data">
                <label>Gebruikersnaam:</label><input type="text" id="name" class="form-control" name="name" placeholder="Gebruikersnaam" maxlength="60" REQUIRED><br>
                <input type="submit" id="submit" value="Wachtwoord resetten" class="btn btn-danger">
            </form>
            <button class="btn btn-info" id="refresh" onclick="history.go(0)">Refresh</button>
            <br><br>
            <div id="error"></div>
        </div>
    </div>
    <script>
        $(document).ready(function () {
            $('.myForm').ajaxForm({
                beforeSend: function () {
                    $("#submit").hide();
                    $("#error").show();
                    $("#error").html('<h3>Even geduld alstublieft</h3><p>Refresh de pagina niet</p>');
                },
                success: function (response) {
                    $("#refresh").show();
                    $("#error").show();
                    $("#error").html(response);
                    $("#name").val('');
                }
            });
            $("#refresh").hide();
            $("#error").hide();
        });

        function showForm() {
            $("#form").attr("onclick", "hideForm()");
            $("#form").text("Verberg");

            $("#formContainer").show();
        }
        function hideForm() {
            $("#form").attr("onclick", "showForm()");
            $("#form").text("Reset");

            $("#formContainer").hide();
        }
    </script>
    <?php
}else{
    include_once '403.php';
}
?>
<?php include '../includes/htmlUnder.php'; ?>