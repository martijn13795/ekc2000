<?php include '../includes/html.php'; ?>
    <script src="http://malsup.github.com/jquery.form.js" xmlns="http://www.w3.org/1999/html"></script>
<?php
$user = new User();
if ($user->isLoggedIn()) {
    ?>
    <div class="container">
        <div class="col-md-12 col-xs-12">
            <h2>Welkom,
                <?php
                echo escape($user->data()->name) . " ";
                if ($user->data()->surname_prefix) {
                    echo escape($user->data()->surname_prefix) . " ";
                }
                echo escape($user->data()->surname);
                ?>
                <button class="btn btn-primary logoutButton hidden-xs" onclick="location.href='/uitloggen';">
                    <i class="fa fa-sign-out"></i>Uitloggen
                </button>
            </h2>
            <hr>
        </div>
        <div class="row">
            <div class="col-md-5 col-xs-12">
                <div class="col-md-12 col-xs-12">
                    <img class="img-responsive avatarDiv" src="<?php echo escape($user->data()->IconPath); ?>"
                         alt="avatar"/><br>
                    <button class="btn btn-primary col-xs-12 logoutButton hidden visible-xs"
                            onclick="location.href='/uitloggen';"><i class="fa fa-sign-out"></i>Uitloggen
                    </button>
                    <br><br><br>
                </div>
            </div>
            <div class="col-md-7 col-xs-12">
                <div class="col-md-12 col-xs-12 well">
                    <div class="row">
                        <div class="col-md-6 col-xs-12">
                            <h3>Gebruikersnaam:</h3>

                            <p><?php echo escape($user->data()->username); ?></p>
                        </div>
                        <div class="col-md-6 col-xs-12">
                            <h3>Wachtwoord:</h3>

                            <p>&#9679;&#9679;&#9679;&#9679;&#9679;&#9679;&#9679;&#9679;&#9679;&#9679;</p>
                        </div>
                        <div class="col-md-6 col-xs-12">
                            <h3>Voornaam:</h3>

                            <p><?php echo escape($user->data()->name); ?></p>
                        </div>
                        <div class="col-md-6 col-xs-12">
                            <h3>Achternaam:</h3>

                            <p><?php
                                if ($user->data()->surname_prefix) {
                                    echo escape($user->data()->surname_prefix) . " ";
                                }
                                echo escape($user->data()->surname);
                                ?></p>
                        </div>
                        <div class="col-md-6 col-xs-12">
                            <h3>Email:</h3>

                            <p><?php echo escape($user->data()->mail); ?></p>
                        </div>
                        <div class="col-md-6 col-xs-12">
                            <h3>Geboortedatum:</h3>

                            <p><?php echo escape($user->data()->birthdate); ?></p>
                        </div>
                        <div class="col-md-6 col-xs-12">
                            <br><button class="btn btn-primary" id="password" style="width: 200px;" onclick="showPassword()">Wachtwoord veranderen</button>
                        </div>
                        <div class="col-md-6 col-xs-12" style="height: 54px;">

                        </div>
                        <?php
                        if($user->hasPermission('dev') || $user->hasPermission('usercreate')) {
                        ?>
                            <div class="col-md-6 col-xs-12">
                                <br><button class="btn btn-primary" id="upload" style="width: 200px;" onclick="showUpload()">Nieuw account maken</button>
                            </div>
                        <?php
                        }
                        if($user->hasPermission('dev') || $user->hasPermission('useredit')) {
                        ?>
                            <div class="hidden visible-lg col-md-6 col-xs-12">
                                <br><button class="btn btn-primary" id="editUser" style="width: 200px;" onclick="window.location='/bewerk-gebruikers'">Bewerk gebruikers</button>
                            </div>
                        <?php
                        }
                        if($user->hasPermission('dev') || $user->hasPermission('teamcreate')) {
                        ?>
                            <div class="col-md-6 col-xs-12">
                                <br><button class="btn btn-primary" id="uploadTeam" style="width: 200px;" onclick="showTeam()">Nieuw team maken</button>
                            </div>
                        <?php
                        }
                        if($user->hasPermission('dev') || $user->hasPermission('teamedit')) {
                        ?>
                            <div class="hidden visible-lg col-md-6 col-xs-12">
                                <br><button class="btn btn-primary" id="editTeam" style="width: 200px;" onclick="window.location='/bewerk-teams'">Bewerk teams</button>
                            </div>
                        <?php
                        }
                        if($user->hasPermission('dev') || $user->hasPermission('commissioncreate')) {
                        ?>
                            <div class="col-md-6 col-xs-12">
                                <br><button class="btn btn-primary" id="uploadCommission" style="width: 200px;" onclick="showCommission()">Nieuwe commissie maken</button>
                            </div>
                        <?php
                        }
                        if($user->hasPermission('dev') || $user->hasPermission('commissionedit')) {
                        ?>
                            <div class="hidden visible-lg col-md-6 col-xs-12">
                                <br><button class="btn btn-primary" id="editCommission" style="width: 200px;" onclick="window.location='/bewerk-commissies'">Bewerk commissies</button>
                            </div>
                        <?php
                        }
                        ?>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-12 col-xs-12" id="passwordContainer" hidden><br>

            <h1>Verander uw wachtwoord</h1>

            <form action="../includes/changePassword.php" method="post" class="myForm" name="myForm">
                <label>Oud wachtwoord:</label><input type="password" id="old_password" class="form-control" name="old_password" placeholder="Oud wachtwoord" maxlength="60" REQUIRED><br>
                <label>Nieuw wachtwoord:</label><input type="password" id="new_password" class="form-control" name="new_password" placeholder="Nieuw wachtwoord" maxlength="60" REQUIRED><br>
                <label>Herhaal nieuw wachtwoord:</label><input type="password" id="new_password_repeat" class="form-control" name="new_password_repeat" placeholder="Herhaal nieuw wachtwoord" maxlength="60" REQUIRED><br>
                <input type="hidden" name="token" value="<?php echo Token::generate() ?>">
                <input class="btn btn-primary submit" id="submit" type="submit">
            </form>
            <br>
        </div>
        <br>
        <br>


        <?php
        if($user->hasPermission('dev') || $user->hasPermission('usercreate')) {
            ?>

            <div class="col-md-12 col-xs-12" id="uploadContainer" hidden><br>

                <h1>Maak een nieuw account</h1>

                <form action="../includes/createAccount.php" method="post" class="myForm" name="myForm">
                    <label>Voornaam:</label><input type="text" id="name" class="form-control" name="name" placeholder="Voornaam" maxlength="60" REQUIRED><br>
                    <label>Tussenvoegsel:</label><input type="text" id="surname_prefix" class="form-control" name="surname_prefix" placeholder="Tussenvoegsel" maxlength="60"><br>
                    <label>Achternaam:</label><input type="text" id="surname" class="form-control" name="surname" placeholder="Achternaam" maxlength="60" REQUIRED><br>
                    <label>Email:</label><input type="email" id="email" class="form-control" name="email" placeholder="Email" maxlength="60" REQUIRED><br>
                    <label>Team:</label><select name="team" class="form-control" id="team" REQUIRED>
                        <option disabled selected value="">Selecteer een team</option>
                        <?php
                        $teams = $db->query("SELECT id, name FROM teams");
                        if ($teams->count()) {
                            $teamsArray = array();
                            foreach ($teams->results() as $team) {
                                $teamsArray[escape($team->id)] = escape($team->name);
                            }
                            asort($teamsArray);
                            foreach ($teamsArray as $id => $name) {
                                echo '<option value="' . escape($id) . '">' . escape($name) . '</option>';
                            }
                        }
                        ?>
                        <option value="0">Geen</option>
                    </select><br>
                    <label>Trainer/Coach van team:</label><select name="trainer" class="form-control" id="trainer" REQUIRED>
                        <option disabled selected value="">Selecteer een team</option>
                        <?php
                        $teams = $db->query("SELECT id, name FROM teams");
                        if ($teams->count()) {
                            $teamsArray = array();
                            foreach ($teams->results() as $team) {
                                $teamsArray[escape($team->id)] = escape($team->name);
                            }
                            asort($teamsArray);
                            foreach ($teamsArray as $id => $name) {
                                echo '<option value="' . escape($id) . '">' . escape($name) . '</option>';
                            }
                        }
                        ?>
                        <option value="0">Geen</option>
                    </select><br>
                    <label>Geslacht:</label><br>
                    <label class="radio-inline"><input type="radio" name="gender" value="M" REQUIRED>Man</label>
                    <label class="radio-inline"><input type="radio" name="gender" value="F">Vrouw</label><br><br>
                    <label>Geboortedatum:</label><input type="text" class="form-control" name="birthday" placeholder="YYYY-MM-DD" REQUIRED><br>
                    <label>Profielfoto:</label><input type="file" id="icon" name="icon"><br>
                    <label>Commissies:</label><br>
                    <?php
                    $commissions = $db->query("SELECT * FROM commissions");
                    if ($commissions->count()) {
                        foreach ($commissions->results() as $commission) {
                            echo '<div class="checkbox checkbox-primary">
                            <input id="'.escape($commission->name).'" type="checkbox" value="'.escape($commission->name).'" name="commission['.escape($commission->name).']">
                            <label for="'.escape($commission->name).'" style="font-weight: normal;">'.escape($commission->name).'</label>
                        </div>';
                        }
                    }
                    ?>
                    <br>
                    <label>Permissies:</label><br>
                    <div id="permissions" class="row">
                        <?php
                        if($user->hasPermission('dev') || $user->hasPermission('usercreate')) {
                        ?>
                        <div class="col-md-12">
                            <div class="col-md-3">
                                <div class="checkbox checkbox-success">
                                    <input id="admin" type="checkbox" value="1">
                                    <label for="admin" style="font-weight: normal;">Admin</label>
                                </div>
                            </div>
                        </div>
                        <?php
                        }
                        if($user->hasPermission('dev') || $user->hasPermission('chatapprove')) {
                        ?>
                        <div class="col-md-12">
                            <div class="col-md-3">
                                <label>Chatbox:</label><br>
                                <div class="checkbox checkbox-warning">
                                    <input id="chatapprove" type="checkbox" value="1" name="permissions[chatapprove]">
                                    <label for="chatapprove" style="font-weight: normal;">Chatbericht goedkeuring</label>
                            </div>
                         <?php
                        }
                        if($user->hasPermission('dev') || $user->hasPermission('chatremove')) {
                        ?>
                            <div class="checkbox checkbox-danger">
                                <input id="chatremove" type="checkbox" value="1" name="permissions[chatremove]">
                                <label for="chatremove" style="font-weight: normal;">Chatbericht verwijderen</label>
                            </div>
                        </div>
                        <?php
                        }
                        if($user->hasPermission('dev') || $user->hasPermission('sponsorupload')) {
                        ?>
                        <div class="col-md-3">
                            <label>Sponsoren:</label><br>
                            <div class="checkbox checkbox-primary">
                                <input id="sponsorupload" type="checkbox" value="1" name="permissions[sponsorupload]">
                                <label for="sponsorupload" style="font-weight: normal;">Sponsoren uploaden</label>
                            </div>
                        <?php
                        }
                        if($user->hasPermission('dev') || $user->hasPermission('sponsorremove')) {
                        ?>
                            <div class="checkbox checkbox-danger">
                                <input id="sponsorremove" type="checkbox" value="1" name="permissions[sponsorremove]">
                                <label for="sponsorremove" style="font-weight: normal;">Sponsoren verwijderen</label>
                            </div>
                         </div>
                        <?php
                        }
                        if($user->hasPermission('dev') || $user->hasPermission('documentupload')) {
                        ?>
                        <div class="col-md-3">
                            <label>Documenten:</label><br>
                            <div class="checkbox checkbox-primary">
                                <input id="documentupload" type="checkbox" value="1" name="permissions[documentupload]">
                                <label for="documentupload" style="font-weight: normal;">Documenten uploaden</label>
                            </div>
                        <?php
                        }
                        if($user->hasPermission('dev') || $user->hasPermission('documentremove')) {
                        ?>
                            <div class="checkbox checkbox-danger">
                                <input id="documentremove" type="checkbox" value="1" name="permissions[documentremove]">
                                <label for="documentremove" style="font-weight: normal;">Documenten verwijderen</label>
                            </div>
                        </div>
                        <?php
                        }
                        if($user->hasPermission('dev') || $user->hasPermission('newsupload')) {
                        ?>
                        <div class="col-md-3">
                            <label>Nieuws:</label><br>
                            <div class="checkbox checkbox-primary">
                                <input id="newsupload" type="checkbox" value="1" name="permissions[newsupload]">
                                <label for="newsupload" style="font-weight: normal;">Nieuws uploaden</label>
                            </div>
                        <?php
                        }
                        if($user->hasPermission('dev') || $user->hasPermission('newsedit')) {
                        ?>
                            <div class="checkbox checkbox-warning">
                                <input id="newsedit" type="checkbox" value="1" name="permissions[newsedit]">
                                <label for="newsedit" style="font-weight: normal;">Nieuws bewerken</label>
                            </div>
                        <?php
                        }
                        if($user->hasPermission('dev') || $user->hasPermission('newsremove')) {
                        ?>
                            <div class="checkbox checkbox-danger">
                                <input id="newsremove" type="checkbox" value="1" name="permissions[newsremove]">
                                <label for="newsremove" style="font-weight: normal;">Nieuws verwijderen</label>
                            </div>
                        </div>
                        </div>
                        <?php
                        }
                        if($user->hasPermission('dev') || $user->hasPermission('imageupload')) {
                        ?>
                        <div class="col-md-12">
                        <div class="col-md-3">
                            <label>Fotogalerij:</label><br>
                            <div class="checkbox checkbox-primary">
                                <input id="imageupload" type="checkbox" value="1" name="permissions[imageupload]">
                                <label for="imageupload" style="font-weight: normal;">Foto's/albums uploaden</label>
                            </div>
                        <?php
                        }
                        if($user->hasPermission('dev') || $user->hasPermission('imageremove')) {
                        ?>
                            <div class="checkbox checkbox-danger">
                                <input id="imageremove" type="checkbox" value="1" name="permissions[imageremove]">
                                <label for="imageremove" style="font-weight: normal;">Foto's/albums verwijderen</label>
                            </div>
                        </div>
                        <?php
                        }
                        if($user->hasPermission('dev') || $user->hasPermission('activityupload')) {
                        ?>
                        <div class="col-md-3">
                            <label>Activiteiten:</label><br>
                            <div class="checkbox checkbox-primary">
                                <input id="activityupload" type="checkbox" value="1" name="permissions[activityupload]">
                                <label for="activityupload" style="font-weight: normal;">Activiteiten uploaden</label>
                            </div>
                        <?php
                        }
                        if($user->hasPermission('dev') || $user->hasPermission('activityedit')) {
                        ?>
                            <div class="checkbox checkbox-warning">
                                <input id="activityedit" type="checkbox" value="1" name="permissions[activityedit]">
                                <label for="activityedit" style="font-weight: normal;">Activiteiten bewerken</label>
                            </div>
                        <?php
                        }
                        if($user->hasPermission('dev') || $user->hasPermission('activityremove')) {
                        ?>
                            <div class="checkbox checkbox-danger">
                                <input id="activityremove" type="checkbox" value="1" name="permissions[activityremove]">
                                <label for="activityremove" style="font-weight: normal;">Activiteiten verwijderen</label>
                            </div>
                        </div>
                        <?php
                        }
                        if($user->hasPermission('dev') || $user->hasPermission('reportupload')) {
                        ?>
                        <div class="col-md-3">
                            <label>Wedstrijdverslagen:</label><br>
                            <div class="checkbox checkbox-primary">
                                <input id="reportupload" type="checkbox" value="1" name="permissions[reportupload]">
                                <label for="reportupload" style="font-weight: normal;">Wedstrijdverslagen uploaden</label>
                            </div>
                        <?php
                        }
                        if($user->hasPermission('dev') || $user->hasPermission('reportedit')) {
                        ?>
                            <div class="checkbox checkbox-warning">
                                <input id="reportedit" type="checkbox" value="1" name="permissions[reportedit]">
                                <label for="reportedit" style="font-weight: normal;">Wedstrijdverslagen bewerken</label>
                            </div>
                        <?php
                        }
                        if($user->hasPermission('dev') || $user->hasPermission('reportremove')) {
                        ?>
                            <div class="checkbox checkbox-danger">
                                <input id="reportremove" type="checkbox" value="1" name="permissions[reportremove]">
                                <label for="reportremove" style="font-weight: normal;">Wedstrijdverslagen verwijderen</label>
                            </div>
                        </div>
                        <?php
                        }
                        if($user->hasPermission('dev') || $user->hasPermission('usercreate')) {
                        ?>
                        <div class="col-md-3">
                            <label>Gebruikers (alleen admins):</label><br>
                            <div class="checkbox checkbox-primary">
                                <input id="usercreate" type="checkbox" value="1" name="permissions[usercreate]" disabled>
                                <input id="usercreate" type="checkbox" value="1" name="permissions[usercreate]" hidden>
                                <label for="usercreate" style="font-weight: normal;">Gebruikers aanmaken</label>
                            </div>
                        <?php
                        }
                        if($user->hasPermission('dev') || $user->hasPermission('useredit')) {
                        ?>
                            <div class="checkbox checkbox-warning">
                                <input id="useredit" type="checkbox" value="1" name="permissions[useredit]" disabled>
                                <input id="useredit" type="checkbox" value="1" name="permissions[useredit]" hidden>
                                <label for="useredit" style="font-weight: normal;">Gebruikers bewerken</label>
                            </div>
                        <?php
                        }
                        if($user->hasPermission('dev') || $user->hasPermission('userremove')) {
                        ?>
                            <div class="checkbox checkbox-danger">
                                <input id="userremove" type="checkbox" value="1" name="permissions[userremove]" disabled>
                                <input id="userremove" type="checkbox" value="1" name="permissions[userremove]" hidden>
                                <label for="userremove" style="font-weight: normal;">Gebruikers verwijderen</label>
                            </div>
                        </div>
                        </div>
                        <?php
                        }
                        if($user->hasPermission('dev') || $user->hasPermission('teamcreate')) {
                        ?>
                        <div class="col-md-12">
                        <div class="col-md-3">
                            <label>Teams:</label><br>
                            <div class="checkbox checkbox-primary">
                                <input id="teamcreate" type="checkbox" value="1" name="permissions[teamcreate]">
                                <label for="teamcreate" style="font-weight: normal;">Team aanmaken</label>
                            </div>
                        <?php
                        }
                        if($user->hasPermission('dev') || $user->hasPermission('teamedit')) {
                        ?>
                            <div class="checkbox checkbox-warning">
                                <input id="teamedit" type="checkbox" value="1" name="permissions[teamedit]">
                                <label for="teamedit" style="font-weight: normal;">Team bewerken</label>
                            </div>
                        <?php
                        }
                        if($user->hasPermission('dev') || $user->hasPermission('teamremove')) {
                        ?>
                            <div class="checkbox checkbox-danger">
                                <input id="teamremove" type="checkbox" value="1" name="permissions[teamremove]">
                                <label for="teamremove" style="font-weight: normal;">Team verwijderen</label>
                            </div>
                        </div>
                        <?php
                        }
                        if($user->hasPermission('dev') || $user->hasPermission('commissioncreate')) {
                        ?>
                            <div class="col-md-3">
                            <label>Commissies:</label><br>
                            <div class="checkbox checkbox-primary">
                                <input id="commissioncreate" type="checkbox" value="1" name="permissions[commissioncreate]">
                                <label for="commissioncreate" style="font-weight: normal;">Commissie aanmaken</label>
                            </div>
                        <?php
                        }
                        if($user->hasPermission('dev') || $user->hasPermission('commissionedit')) {
                        ?>
                            <div class="checkbox checkbox-warning">
                            <input id="commissionedit" type="checkbox" value="1" name="permissions[commissionedit]">
                                 <label for="commissionedit" style="font-weight: normal;">Commissie bewerken</label>
                                 </div>
                        <?php
                        }
                        if($user->hasPermission('dev') || $user->hasPermission('commissionremove')) {
                        ?>
                             <div class="checkbox checkbox-danger">
                             <input id="commissionremove" type="checkbox" value="1" name="permissions[commissionremove]">
                                 <label for="commissionremove" style="font-weight: normal;">Commissie verwijderen</label>
                                 </div>
                             </div>

                        <?php
                        }
                        if($user->hasPermission('dev') || $user->hasPermission('ideas')) {
                        ?>
                            <div class="col-md-3">
                            <label>Idee&euml;nbus</label><br>
                                <div class="checkbox checkbox-primary">
                                    <input id="ideas" type="checkbox" value="1" name="permissions[ideas]">
                                    <label for="ideas" style="font-weight: normal;">Idee&euml;n inzien</label>
                                </div>
                            </div>
                        <?php
                        }
                        ?>
                        </div>
                    </div>
                    <br><br>
                    <input class="btn btn-primary submit" id="submit" type="submit">
                </form>
            </div>
            <?php
        }
        if($user->hasPermission('dev') || $user->hasPermission('teamcreate')) {
            ?>

            <div class="col-md-12 col-xs-12" id="uploadTeamDiv" hidden><br>

                <h1>Maak een nieuw team</h1>

                <form action="../includes/createTeam.php" method="post" class="myForm" name="myForm">
                    <label>Naam:</label><input type="text" id="name" class="form-control" name="name" placeholder="Naam" maxlength="60" REQUIRED><br>
                    <label>Foto:</label><input type="file" id="icon" name="icon" REQUIRED><br>
                    <label>trainingstijden:</label>
                    <div class="form-inline">
                        <label>Dag:</label>
                        <select class="form-control" name="day1" id="day1" REQUIRED>
                            <option disabled selected value="">Kies een dag</option>
                            <option value="1">Maandag</option>
                            <option value="2">Dinsdag</option>
                            <option value="3">Woensdag</option>
                            <option value="4">Donderdag</option>
                            <option value="5">Vrijdag</option>
                        </select>
                        <label>Begin:</label><input type="time" id="begin1" class="form-control" name="begin1" REQUIRED>
                        <label>Eind:</label><input type="time" id="end1" class="form-control" name="end1" REQUIRED>
                        <label>Locatie:</label><input type="text" id="location1" class="form-control" name="location1" REQUIRED><br><br>
                        <label>Dag:</label>
                        <select class="form-control" name="day2" id="day2">
                            <option disabled selected value="">Kies een dag</option>
                            <option value="1">Maandag</option>
                            <option value="2">Dinsdag</option>
                            <option value="3">Woensdag</option>
                            <option value="4">Donderdag</option>
                            <option value="5">Vrijdag</option>
                        </select>
                        <label>Begin:</label><input type="time" id="begin2" class="form-control" name="begin2">
                        <label>Eind:</label><input type="time" id="end2" class="form-control" name="end2">
                        <label>Locatie:</label><input type="text" id="location2" class="form-control" name="location2"><br><br>
                        <label>Dag:</label>
                        <select class="form-control" name="day3" id="day3">
                            <option disabled selected value="">Kies een dag</option>
                            <option value="1">Maandag</option>
                            <option value="2">Dinsdag</option>
                            <option value="3">Woensdag</option>
                            <option value="4">Donderdag</option>
                            <option value="5">Vrijdag</option>
                        </select>
                        <label>Begin:</label><input type="time" id="begin3" class="form-control" name="begin3">
                        <label>Eind:</label><input type="time" id="end3" class="form-control" name="end3">
                        <label>Locatie:</label><input type="text" id="location3" class="form-control" name="location3"><br><br>
                    </div>
                    <input class="btn btn-primary submit" id="submit" type="submit">
                </form>
            </div>
            <?php
            }
            if($user->hasPermission('dev') || $user->hasPermission('commissioncreate')) {
            ?>
        <div class="col-md-12 col-xs-12" id="uploadCommissionDiv" hidden><br>

            <h1>Maak een nieuwe commissie</h1>

            <form action="../includes/createCommission.php" method="post" class="myForm" name="myForm">
                <label>Naam:</label><input type="text" id="name" class="form-control" name="name" placeholder="Naam" maxlength="60" REQUIRED><br>
                <label>Email:</label><input type="email" id="mail" class="form-control" name="mail" placeholder="Email" maxlength="256" REQUIRED><br>
                <label>Telefoonnummer:</label><input type="text" id="phone" class="form-control" name="phone" placeholder="Telefoonnummer" maxlength="10"><br>
                <input class="btn btn-primary submit" id="submit" type="submit">
            </form>
        </div>
        <?php
        }
        ?>
        <button class="btn btn-info" id="refresh" onclick="history.go(0)">Refresh</button><br><br>
        <div id="error"></div>
    </div>
    <?php
} else {
    include_once '403.php';
}
?>
    <script>
        $(document).ready(function () {
            $('.myForm').ajaxForm({
                beforeSend: function () {
                    $(".submit").hide();
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

        function showUpload() {
            $("#upload").attr("onclick", "hideUpload()");
            $("#upload").text("Verberg");
            $("#uploadContainer").show();
        }
        function hideUpload() {
            $("#upload").attr("onclick", "showUpload()");
            $("#upload").text("Nieuw account maken");
            $("#uploadContainer").hide();
        }
        function showTeam() {
            $("#uploadTeam").attr("onclick", "hideTeam()");
            $("#uploadTeam").text("Verberg");
            $("#uploadTeamDiv").show();
        }
        function hideTeam() {
            $("#uploadTeam").attr("onclick", "showTeam()");
            $("#uploadTeam").text("Nieuw team maken");
            $("#uploadTeamDiv").hide();
        }
        function showCommission() {
            $("#uploadCommission").attr("onclick", "hideCommission()");
            $("#uploadCommission").text("Verberg");
            $("#uploadCommissionDiv").show();
        }
        function hideCommission() {
            $("#uploadCommission").attr("onclick", "showCommission()");
            $("#uploadCommission").text("Nieuwe commissie maken");
            $("#uploadCommissionDiv").hide();
        }

        function showPassword() {
            $("#password").attr("onclick", "hidePassword()");
            $("#password").text("Verberg");
            $("#passwordContainer").show();
        }
        function hidePassword() {
            $("#password").attr("onclick", "showPassword()");
            $("#password").text("Wachtwoord veranderen");
            $("#passwordContainer").hide();
        }

        $("#admin").change(function() {
            if(this.checked) {
                //Do stuff
                $('#permissions input[type=checkbox]').prop('checked', true);
            } else {
                $('#permissions input[type=checkbox]').prop('checked', false);
            }
        });

        $("#permissions input[type=checkbox]").change(function() {
            if(!this.checked) {
                //Do stuff
                var cbadmin = $("#admin");
                if(cbadmin.is(':checked')){
                    $('#permissions input[type=checkbox]').prop('checked', false);
                }
                cbadmin.prop('checked', false);
            }
        });


    </script>
<?php include '../includes/htmlUnder.php'; ?>