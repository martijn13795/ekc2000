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
                                    if ($commission->name == "Bestuur") {
                                        ?>
                                        <p>Er zijn meedere vacantie posities</p>
                                        <button type="button" class="btn btn-success" data-toggle="modal"
                                                data-target="#myModal2">Extra info
                                        </button>

                                        <!-- Modal -->
                                        <div id="myModal2" class="modal fade" role="dialog">
                                            <div class="modal-dialog">

                                                <!-- Modal content-->
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <button type="button" class="close"
                                                                data-dismiss="modal">&times;</button>
                                                        <h4 class="modal-title">Functieomschrijving
                                                            sponsorcommissie</h4>
                                                    </div>
                                                    <div class="modal-body">
                                                        <p>Functies:<br><br>
                                                            • Medeverantwoordelijk voor het onderhouden van het
                                                            Sponsorbeleid<br>
                                                            • Houdt het archief bij van de afspraken met sponsoren en
                                                            adverteerders<br>
                                                            • Onderhoudt contacten met actuele sponsoren<br>
                                                            • Organiseert regelmatige bijeenkomsten voor de
                                                            sponsorcommissie<br>
                                                            • Organiseert sponsorwervingsacties<br>
                                                            • Gestructureerd kunnen werken<br>
                                                            • Communicatief vaardig (mondeling en schriftelijk)<br>
                                                            • Goed contacten kunnen onderhouden (met andere
                                                            vrijwilligers, leden, maar vooral de sponsoren)<br>
                                                            • Interesse hebben in bedrijven als (potentiële) sponsor<br>
                                                            • Formeel en informeel kunnen afwisselen<br>
                                                            • Regelmatig email behandelen (minimaal eens in de week)<br>
                                                            • In team kunnen werken<br>
                                                            • Affiniteit met EKC 2000 (en de korfbalsport) is een
                                                            pré<br>
                                                        </p>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-default"
                                                                data-dismiss="modal">Sluit
                                                        </button>
                                                    </div>
                                                </div>

                                            </div>
                                        </div>
                                        <?php
                                    }
                                } else {
                                    ?>
                                    <p>Hier kan eventuele tekst staan</p>
                                    <button type="button" class="btn btn-success" data-toggle="modal" data-target="#myModal1">Extra info</button>

                                    <!-- Modal -->
                                    <div id="myModal1" class="modal fade" role="dialog">
                                        <div class="modal-dialog">

                                            <!-- Modal content-->
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                                                    <h4 class="modal-title">Functieomschrijving activiteitencommissie</h4>
                                                </div>
                                                <div class="modal-body">
                                                    <p>Functies:<br><br>
                                                        • Medeverantwoordelijk voor het onderhouden van de activiteiten<br>
                                                    </p>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-default" data-dismiss="modal">Sluit</button>
                                                </div>
                                            </div>

                                        </div>
                                    </div>
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
                                if ($commission->members != "") { echo '
                                    <p style="margin-bottom: -10px;"><b>Leden: </b><p>';
                                    $tags = explode(',,',$commission->members);
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
                                } else {
                                    ?>
                                    <p>Hier kan eventuele tekst staan</p>
                                    <button type="button" class="btn btn-success" data-toggle="modal" data-target="#myModal2">Extra info</button>

                                    <!-- Modal -->
                                    <div id="myModal2" class="modal fade" role="dialog">
                                        <div class="modal-dialog">

                                            <!-- Modal content-->
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                                                    <h4 class="modal-title">Functieomschrijving sponsorcommissie</h4>
                                                </div>
                                                <div class="modal-body">
                                                    <p>Functies:<br><br>
                                                        • Medeverantwoordelijk voor het onderhouden van het Sponsorbeleid<br>
                                                        • Houdt het archief bij van de afspraken met sponsoren en adverteerders<br>
                                                        • Onderhoudt contacten met actuele sponsoren<br>
                                                        • Organiseert regelmatige bijeenkomsten voor de sponsorcommissie<br>
                                                        • Organiseert sponsorwervingsacties<br>
                                                        • Gestructureerd kunnen werken<br>
                                                        • Communicatief vaardig (mondeling en schriftelijk)<br>
                                                        • Goed contacten kunnen onderhouden (met andere vrijwilligers, leden, maar vooral de sponsoren)<br>
                                                        • Interesse hebben in bedrijven als (potentiële) sponsor<br>
                                                        • Formeel en informeel kunnen afwisselen<br>
                                                        • Regelmatig email behandelen (minimaal eens in de week)<br>
                                                        • In team kunnen werken<br>
                                                        • Affiniteit met EKC 2000 (en de korfbalsport) is een pré<br>
                                                    </p>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-default" data-dismiss="modal">Sluit</button>
                                                </div>
                                            </div>

                                        </div>
                                    </div>
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
<?php include '../includes/htmlUnder.php'; ?>