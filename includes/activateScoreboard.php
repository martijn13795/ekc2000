<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/core/init.php';
$db = DB::getInstance();
if (isset($_GET['scoreboard']) && !empty($_GET['scoreboard']) && isset($_GET['scoreboardID']) && !empty($_GET['scoreboardID'])) {
    $scoreboard = $_GET['scoreboard'];
    $scoreboard = rawurlencode($scoreboard);
    $scoreboardID = $_GET['scoreboardID'];
    $scoreboardID = rawurlencode($scoreboardID);
    if ($scoreboard == 'true') {
        $scoreboard = 1;
    }
    if ($scoreboard == 'false') {
        $scoreboard = 0;
    }
    if ($scoreboard === 0) {
        $scoreboardIdOld = $db->query("SELECT scoreboardID FROM scoreboard WHERE id = 1");
        if ($scoreboardID === $scoreboardIdOld->first()) {
            $db->query("UPDATE scoreboard SET scoreboard='$scoreboard', scoreboardID='$scoreboardID' WHERE id=1");
        }
        echo "<script>";
        echo 'location.href = "https://score.ekc2000.nl/scoreboard/'.$scoreboardID.'"';
        echo "</script>";
    } else if ($scoreboard === 1) {
        $db->query("UPDATE scoreboard SET scoreboard='$scoreboard', scoreboardID='$scoreboardID' WHERE id=1");
        echo "<script>";
        echo 'location.href = "https://score.ekc2000.nl/manage-scoreboard/'.$scoreboardID.'"';
        echo "</script>";
    }
}