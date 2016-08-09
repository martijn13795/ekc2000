<?php include '../includes/html.php';?>
    <div class="container">
        <div class="col-md-12 col-xs-12">
            <h1>De commissies van EKC 2000</h1><hr>
            <?php
            $commissions = $db->query("SELECT * FROM commissions");
            if ($commissions->count()) {
                $i = 0;
                foreach ($commissions->results() as $commission) {
                    if ($i % 2 == 0) {
                        echo '
                        <div class="col-md-5 col-xs-12 well commissieDiv">
                            <h3>' . escape($commission->name) . ':</h3>
                            <p>Email: ' . escape($commission->mail) . '</p>
                            '; if ($commission->phone != 0){ echo '<p>Telefoonnummer: ' . escape($commission->phone) . '</p>';}echo '
                            $tags = explode(',,',$commission->members);
                            foreach($tags as $key) {
                                $tags2 = explode(',',$key);
                                foreach($tags2 as $key2) {
                                    if ($key2 != "") {
                                        $getMembers = $db->query("SELECT * FROM users WHERE id='$key2'")->first();
                                        echo $getMembers->name.' ';
                                        echo $getMembers->surname_prefix.' ';
                                        echo $getMembers->surname.'<br>';
                                    }
                                }
                            }
                        echo '</p>
                        </div>
                    ';
                    } else {
                        echo '
                        <div class="col-md-5 col-md-offset-2 col-xs-12 well commissieDiv">
                            <h3>' . escape($commission->name) . ':</h3>
                            <p>Email: ' . escape($commission->mail) . '</p>
                            '; if ($commission->phone != 0){ echo '<p>Telefoonnummer: ' . escape($commission->phone) . '</p>';}echo '
                            $tags = explode(',,',$commission->members);
                            foreach($tags as $key) {
                                $tags2 = explode(',',$key);
                                foreach($tags2 as $key2) {
                                    if ($key2 != "") {
                                        $getMembers = $db->query("SELECT * FROM users WHERE id='$key2'")->first();
                                        echo $getMembers->name.' ';
                                        echo $getMembers->surname_prefix.' ';
                                        echo $getMembers->surname.'<br>';
                                    }
                                }
                            }
                        echo '</p>
                        </div>
                    ';
                    }
                    $i++;
                }
            } else {
                echo "<h3>Er zijn nog geen commissies</h3>";
            }
            ?>
        </div>
    </div>
<?php include '../includes/htmlUnder.php'; ?>