<?php include '../includes/html.php';?>
    <div class="container">
        <?php
        $servername = "ekc2000.party";
        $username = "ekc2000";
        $password = "xH2b8C5PnajhnXJ5";

        // Create connection
        $conn = new mysqli($servername, $username, $password);

        // Check connection
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }
        echo "Connected successfully";
        ?>
    </div>