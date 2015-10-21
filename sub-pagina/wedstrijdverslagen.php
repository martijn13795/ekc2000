<?php include '../includes/html.php';?>
<script src="http://malsup.github.com/jquery.form.js"></script>
    <div class="container">
        <h1>Wedstrijdverslagen</h1><hr>
        <div class="col-md-12 col-xs-12">
            <form method="post" name="myForm" class="myForm" action="../includes/wedstrijdverslagenUpload.php">
                <label>Naam van het verslag:</label>
                <input type="text" class="form-control" placeholder="Naam" id="name" REQUIRED/><br>
                <label>Van welk team is het verslag:</label>
                <select name="team" class="form-control" id="team" REQUIRED>
                    <option disabled selected value="">Selecteer een team</option>
                    <option value="Eerste">Eerste</option>
                    <option value="Tweede">Tweede</option>
                    <option value="Derde">Derde</option>
                    <option value="A1">A1</option>
                    <option value="B1">B1</option>
                    <option value="B2">B2</option>
                    <option value="C1">C1</option>
                    <option value="D1">D1</option>
                    <option value="D2">D2</option>
                    <option value="E1">E1</option>
                    <option value="F1">F1</option>
                    <option value="Welpen">Welpen</option>
                </select><br>
                <textarea class="form-control" rows="8" id="verslag" placeholder="Type hier..." REQUIRED></textarea></br>
                <input type="submit" id="submit" class="btn btn-success">
            </form>
            <button class="btn btn-info" id="refresh" onclick="history.go(0)">Refresh</button><br><br>
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
                $("#team").val('');
                $("#verslag").val('');
            }
        });
        $("#refresh").hide();
        $("#error").hide();
    });
</script>