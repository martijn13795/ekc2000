<?php include '../includes/html.php';?>
    <div class="container">
        <div class="col-md-12 col-xs-12">
            <h1>De commissies van EKC 2000</h1><hr>
            <!-- Modal -->
            <div id="myModal" class="modal fade" role="dialog">
                <div class="modal-dialog">

                    <!-- Modal content-->
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                            <h4 class="modal-title"></h4>
                        </div>
                        <div class="modal-body">

                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-default" data-dismiss="modal">Sluit</button>
                        </div>
                    </div>

                </div>
            </div>
            <!-- End Modal -->
            <?php
            $commissions = $db->query("SELECT * FROM commissions");
            if ($commissions->count()) {
                $i = 0;
                foreach ($commissions->results() as $commission) {
                    if ($i % 2 == 0) {
                        echo '
                        <div class="row commissieRow">
                            <div class="col-md-5 col-xs-12 well commissieDiv">
                                <h3>' . escape($commission->name) . '</h3>
                                <p><b>Email: </b><a href="mailto:' . escape($commission->mail) . '" style="color: #37c0fb;">' . escape($commission->mail) . '</a></p>
                                '; if ($commission->phone != 0){ echo '<p><b>Telefoonnummer: </b>&plus;31 ' . escape($commission->phone) . '</p>';}
                                if ($commission->members != "") {
                                    echo '
                                    <p style="margin-bottom: -10px;"><b>Leden: </b><p>';
                                    $tags = explode(',,', $commission->members);
                                    foreach ($tags as $key) {
                                        $tags2 = explode(',', $key);
                                        foreach ($tags2 as $key2) {
                                            if ($key2 != "") {
                                                if ($count = $db->query("SELECT * FROM users WHERE id='$key2'")->count()) {
                                                    $getMembers = $db->query("SELECT * FROM users WHERE id='$key2'")->first();
                                                    echo "<p style='margin-bottom: -15px;'>&bull; ";
                                                    echo $getMembers->name . ' ';
                                                    if ($getMembers->surname_prefix != "") {
                                                        echo $getMembers->surname_prefix . ' ';
                                                    }
                                                    echo $getMembers->surname . '</p><br>';
                                                }
                                            }
                                        }
                                    }
                                }
                                if ($commission->members == "" || $commission->vacancy == "1") {
                                    ?>
                                    <p style="font-weight: bold;">E&eacute;n of meerdere posities binnen deze commissie zijn vacant</p>
                                    <button type="button" class="btn btn-success" <?php $user = new User(); if ($user->isLoggedIn()) { ?> onclick="modalToggle(<?php echo "`" . $commission->name . "`,"; echo "`" . $commission->vacancyText . "`"; ?>)" <?php } else { ?> onclick="window.location = '/inloggen';" <?php } ?>>Extra info</button>
                                    <?php
                                }
                            echo '
                            </div>
                    ';
                    } else {
                        echo '
                            <div class="col-md-5 col-md-offset-2 col-xs-12 well commissieDiv">
                                <h3>' . escape($commission->name) . '</h3>
                                <p><b>Email: </b><a href="mailto:' . escape($commission->mail) . '" style="color: #37c0fb;">' . escape($commission->mail) . '</a></p>
                                '; if ($commission->phone != 0){ echo '<p><b>Telefoonnummer: </b>&plus;31 ' . escape($commission->phone) . '</p>';}
                                if ($commission->members != "") {
                                    echo '
                                    <p style="margin-bottom: -10px;"><b>Leden: </b><p>';
                                    $tags = explode(',,', $commission->members);
                                    foreach ($tags as $key) {
                                        $tags2 = explode(',', $key);
                                        foreach ($tags2 as $key2) {
                                            if ($key2 != "") {
                                                if ($count = $db->query("SELECT * FROM users WHERE id='$key2'")->count()) {
                                                    $getMembers = $db->query("SELECT * FROM users WHERE id='$key2'")->first();
                                                    echo "<p style='margin-bottom: -15px;'>&bull; ";
                                                    echo $getMembers->name . ' ';
                                                    if ($getMembers->surname_prefix != "") {
                                                        echo $getMembers->surname_prefix . ' ';
                                                    }
                                                    echo $getMembers->surname . '</p><br>';
                                                }
                                            }
                                        }
                                    }
                                }
                                if ($commission->members == "" || $commission->vacancy == "1") {
                                    ?>
                                    <p style="font-weight: bold;">E&eacute;n of meerdere posities binnen deze commissie zijn vacant</p>
                                    <button type="button" class="btn btn-success" <?php $user = new User(); if ($user->isLoggedIn()) { ?> onclick="modalToggle(<?php echo "`" . $commission->name . "`,"; echo "`" . $commission->vacancyText . "`"; ?>)" <?php } else { ?> onclick="window.location = '/inloggen';" <?php } ?>>Extra info</button>
                                    <?php
                                }
                            echo '
                            </div>
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
<script>
    function modalToggle(vacancyTitle, vacancyText) {
        if (<?php if ($user->hasPermission('dev')) {echo "false"; } else { echo "true"; } ?>) {
            $.ajax({url: '../includes/vacancyMail.php?commissionName=' + vacancyTitle});
        }
        if (vacancyText == "") {
            vacancyText = "Er is geen extra info beschikbaar";
        }
        $('#myModal').modal('toggle');
        $( ".modal-title" ).empty();
        $( ".modal-body" ).empty();
        $( ".modal-title" ).append( vacancyTitle );
        $( ".modal-body" ).append( vacancyText );
    }
</script>
<?php include '../includes/htmlUnder.php'; ?>