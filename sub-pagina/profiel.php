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
                        if ($user->hasPermission('admin')) {
                        ?>
                            <div class="col-md-6 col-xs-12">
                                <br><button class="btn btn-primary" id="upload" style="width: 200px;" onclick="showUpload()">Nieuw account maken</button>
                            </div>
                            <div class="hidden visible-lg col-md-6 col-xs-12">
                                <br><button class="btn btn-primary" id="editUser" style="width: 200px;" onclick="window.location='/bewerk-gebruikers'">Bewerk gebruikers</button>
                            </div>
                            <div class="col-md-6 col-xs-12">
                                <br><button class="btn btn-primary" id="uploadTeam" style="width: 200px;" onclick="showTeam()">Nieuw team maken</button>
                            </div>
                            <div class="hidden visible-lg col-md-6 col-xs-12">
                                <br><button class="btn btn-primary" id="editTeam" style="width: 200px;" onclick="window.location='/bewerk-teams'">Bewerk teams</button>
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
        if ($user->hasPermission('admin')) {
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
                    <label>Profielfoto:</label><input type="file" id="icon" name="icon" REQUIRED><br>
                    <label>Permissies:</label><br>
                    <div class="checkbox checkbox-danger">
                        <input id="chatapprove" type="checkbox" value="1" name="permissions[chatapprove]">
                        <label for= "chatapprove" style="font-weight: normal;">Chatbericht goedkeuring</label>
                    </div>
                    <label><input type="checkbox" value="1" name="permissions[chatremove]">
                        Chatbericht verwijderen
                    </label><br>
                    <label><input type="checkbox" value="1" name="permissions[sponsorupload]">
                        Sponsoren uploaden
                    </label><br>
                    <label><input type="checkbox" value="1" name="permissions[sponsorremove]">
                        Sponsoren verwijderen
                    </label><br>
                    <label><input type="checkbox" value="1" name="permissions[documentupload]">
                        Documenten uploaden
                    </label><br>
                    <label><input type="checkbox" value="1" name="permissions[documentremove]">
                        Documenten verwijderen
                    </label><br>
                    <label><input type="checkbox" value="1" name="permissions[newsupload]">
                        Nieuws uploaden
                    </label><br>
                    <label><input type="checkbox" value="1" name="permissions[newsremove]">
                        Nieuws verwijderen
                    </label><br>
                    <label><input type="checkbox" value="1" name="permissions[newschange]">
                        Nieuws aanpassen
                    </label><br>
                    <label><input type="checkbox" value="1" name="permissions[imageupload]">
                        Foto's/albums uploaden
                    </label><br>
                    <label><input type="checkbox" value="1" name="permissions[imageremove]">
                        Foto's/albums verwijderen
                    </label><br>
                    <label><input type="checkbox" value="1" name="permissions[activityupload]">
                        Activiteiten uploaden
                    </label><br>
                    <label><input type="checkbox" value="1" name="permissions[activityremove]">
                        Activiteiten verwijderen
                    </label><br>
                    <label><input type="checkbox" value="1" name="permissions[activitychange]">
                        Activiteiten aanpassen
                    </label><br>
                    <label><input type="checkbox" value="1" name="permissions[reportupload]">
                        Wedstrijdverslagen uploaden
                    </label><br>
                    <label><input type="checkbox" value="1" name="permissions[reportremove]">
                        Wedstrijdverslagen verwijderen
                    </label><br>
                    <label><input type="checkbox" value="1" name="permissions[reportchange]">
                        Wedstrijdverslagen aanpassen
                    </label><br>
                    <label><input type="checkbox" value="1" name="permissions[createuser]">
                        Gebruikers aanmaken
                    </label><br>
                    <label><input type="checkbox" value="1" name="permissions[edituser]">
                        Gebruikers bewerken
                    </label><br>
                    <label><input type="checkbox" value="1" name="permissions[createteam]">
                        Team aanmaken
                    </label><br>
                    <label><input type="checkbox" value="1" name="permissions[editteam]">
                        Team bewerken
                    </label><br>
                    <br><br>
                    <input class="btn btn-primary submit" id="submit" type="submit">
                </form>
            </div>
            <?php
        }
        if ($user->hasPermission('admin')) {
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
                        <label>Eind:</label><input type="time" id="end1" class="form-control" name="end1" REQUIRED><br><br>
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
                        <label>Eind:</label><input type="time" id="end2" class="form-control" name="end2"><br><br>
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
                        <label>Eind:</label><input type="time" id="end3" class="form-control" name="end3"><br><br>
                    </div>
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
    </script>
<?php include '../includes/htmlUnder.php'; ?>