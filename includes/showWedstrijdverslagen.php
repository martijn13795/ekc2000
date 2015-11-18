<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/core/init.php';
$db = DB::getInstance();
if (isset($_GET['id']) && !empty($_GET['id']) && is_numeric($_GET['id'])) {
    $id = escape($_GET['id']);
    $reports = $db->query("SELECT * FROM reports WHERE team_id = '$id' ORDER BY date_match DESC");
    if ($reports->count()) {
        foreach ($reports->results() as $report) {
            echo '<div class="well activiteitDiv"><a href="/verslag/' . escape($report->name) . '"><h3>' . escape(str_replace('-', ' ', $report->name)) . '</h3></a><p>Wedstrijd datum: ' . escape($report->date_match) . '</p><p>Upload datum: ' . escape(explode(" ", $report->date)[0]) . '</p></div>';
        }
    } else {
        echo "<p>Van dit team zijn er geen wedstrijdverslagen</p>";
    }
} else {
    $reports = $db->query("SELECT * FROM reports ORDER BY date_match DESC");
    if ($reports->count()) {
        foreach ($reports->results() as $report) {
            echo '<div class="well activiteitDiv"><a href="/verslag/' . escape($report->name) . '"><h3>' . escape(str_replace('-', ' ', $report->name)) . '</h3></a><p>Wedstrijd datum: ' . escape($report->date_match) . '</p><p>Upload datum: ' . escape(explode(" ", $report->date)[0]) . '</p></div>';
        }
    }
}