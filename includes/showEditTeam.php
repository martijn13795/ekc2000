<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/core/init.php';
if (isset($_GET['id']) && !empty($_GET['id']) && is_numeric($_GET['id'])) {
    $db = DB::getInstance();
    $id = escape($_GET['id']);
    $team = $db->query("SELECT * FROM teams WHERE id = '$id'");
    if ($team->count()) {
        $team = $team->first();
        ?>
        <form action="../includes/editTeam.php?id=<?php echo $id ?>&data='team'&colum='team'" method="post" class="myForm" name="myForm">
            <label>Naam:</label><input type="text" id="name" class="form-control" name="name" placeholder="Naam" value="<?php echo $team->name; ?>" maxlength="60" REQUIRED><br>
            <label>Foto:</label><input type="file" id="icon" name="icon"><br>
            <label>trainingstijden:</label>
            <div class="form-inline">
                <label>Dag:</label>
                <select class="form-control" name="day1" id="day1" REQUIRED>
                    <?php $schedules1 = $db->query("SELECT * FROM schedules WHERE team_id = '$id' LIMIT 1")->first();?>
                    <option disabled value="">Kies een dag</option>
                    <option <?php if ($schedules1->day_id == 1){echo "selected";} ?> value="1">Maandag</option>
                    <option <?php if ($schedules1->day_id == 2){echo "selected";} ?> value="2">Dinsdag</option>
                    <option <?php if ($schedules1->day_id == 3){echo "selected";} ?> value="3">Woensdag</option>
                    <option <?php if ($schedules1->day_id == 4){echo "selected";} ?> value="4">Donderdag</option>
                    <option <?php if ($schedules1->day_id == 5){echo "selected";} ?> value="5">Vrijdag</option>
                </select>
                <label>Begin:</label><input type="time" value="<?php echo $schedules1->start ?>" id="begin1" class="form-control" name="begin1" REQUIRED>
                <label>Eind:</label><input type="time" value="<?php echo $schedules1->end ?>" id="end1" class="form-control" name="end1" REQUIRED><br><br>
                <label>Dag:</label>
                <select class="form-control" name="day2" id="day2">
                    <?php $schedules2 = $db->query("SELECT * FROM schedules WHERE team_id = '$id' LIMIT 1,2")->first();?>
                    <option disabled selected value="">Kies een dag</option>
                    <option <?php if ($schedules2){ if ($schedules2->day_id == 1){echo "selected";}} ?> value="1">Maandag</option>
                    <option <?php if ($schedules2){ if ($schedules2->day_id == 2){echo "selected";}} ?> value="2">Dinsdag</option>
                    <option <?php if ($schedules2){ if ($schedules2->day_id == 3){echo "selected";}} ?> value="3">Woensdag</option>
                    <option <?php if ($schedules2){ if ($schedules2->day_id == 4){echo "selected";}} ?> value="4">Donderdag</option>
                    <option <?php if ($schedules2){ if ($schedules2->day_id == 5){echo "selected";}} ?> value="5">Vrijdag</option>
                </select>
                <label>Begin:</label><input type="time" value="<?php echo $schedules2->start ?>" id="begin2" class="form-control" name="begin2">
                <label>Eind:</label><input type="time" value="<?php echo $schedules2->end ?>" id="end2" class="form-control" name="end2"><br><br>
                <label>Dag:</label>
                <select class="form-control" name="day3" id="day3">
                    <?php $schedules3 = $db->query("SELECT * FROM schedules WHERE team_id = '$id' LIMIT 2,3")->first();?>
                    <option disabled selected value="">Kies een dag</option>
                    <option <?php if ($schedules3){ if ($schedules3->day_id == 1){echo "selected";}} ?> value="1">Maandag</option>
                    <option <?php if ($schedules3){ if ($schedules3->day_id == 2){echo "selected";}} ?> value="2">Dinsdag</option>
                    <option <?php if ($schedules3){ if ($schedules3->day_id == 3){echo "selected";}} ?> value="3">Woensdag</option>
                    <option <?php if ($schedules3){ if ($schedules3->day_id == 4){echo "selected";}} ?> value="4">Donderdag</option>
                    <option <?php if ($schedules3){ if ($schedules3->day_id == 5){echo "selected";}} ?> value="5">Vrijdag</option>
                </select>
                <label>Begin:</label><input type="time" value="<?php echo $schedules3->start ?>" id="begin3" class="form-control" name="begin3">
                <label>Eind:</label><input type="time" value="<?php echo $schedules3->end ?>" id="end3" class="form-control" name="end3"><br><br>
            </div>
            <input class="btn btn-primary" id="submit" type="submit">

        </form>
        <button class="btn btn-info" id="refresh" onclick="history.go(0)">Refresh</button><br><br>
        <div id="error"></div>
        <button class="btn btn-danger" onclick="removeTeam(<?php echo $id; ?>)" style="float: right; margin-top: -73px;">Team "<?php echo $team->name; ?>" verwijderen</button>
        <?php
    } else {
        echo "<p>Er is iets mis gegaan. Dit team bestaat niet.</p>";
    }
} else {
    echo "<p>Er is geen team gekozen.</p>";
}
?>
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
            }
        });
        $("#refresh").hide();
        $("#error").hide();
    });
</script>
