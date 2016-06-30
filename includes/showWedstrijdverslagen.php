<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/core/init.php';
$db = DB::getInstance();
$user = new User();
if (isset($_GET['id']) && !empty($_GET['id']) && is_numeric($_GET['id'])) {
    $id = escape($_GET['id']);
    $reports = $db->query("SELECT * FROM reports WHERE team_id = '$id' ORDER BY date_match DESC");
    if ($reports->count()) {
        foreach ($reports->results() as $report) {
            echo '<div class="well activiteitDiv">';
            if ($user->isLoggedIn() && ($user->data()->id == $report->user_id || $user->hasPermission("admin"))) {
                echo '<i class="fa fa-trash-o" style="float: right;" onclick="removeReport(' . escape($report->id) . ')"></i>';
                echo '<div class="hidden visible-lg"><i class="fa fa-pencil-square-o" style="float: right; color: green;" onclick="update(`reports`, ' . escape($report->id) . ')"></i></div>';
            }
            echo '<a href="/verslag/' . escape($report->name) . '"><h3>' . escape(rawurldecode($report->name)) . '</h3></a><p>Wedstrijd datum: ' . escape($report->date_match) . '</p></div>';
        }
    } else {
        echo "<p>Van dit team zijn er geen wedstrijdverslagen</p>";
    }
} else {
    $reports = $db->query("SELECT * FROM reports ORDER BY date_match DESC");
    if ($reports->count()) {
        foreach ($reports->results() as $report) {
            echo '<div class="well activiteitDiv">';
            if ($user->isLoggedIn() && ($user->data()->id == $report->user_id || $user->hasPermission("admin"))) {
                echo '<i class="fa fa-trash-o" style="float: right;" onclick="removeReport(' . escape($report->id) . ')"></i>';
                echo '<i class="fa fa-pencil-square-o" style="float: right; color: green;" onclick="update(`reports`, ' . escape($report->id) . ')"></i>';
            }
            echo '<a href="/verslag/' . escape($report->name) . '"><h3>' . escape(rawurldecode($report->name)) . '</h3></a><p>Wedstrijd datum: ' . escape($report->date_match) . '</p></div>';
        }
    }
}