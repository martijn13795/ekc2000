<?php include '../includes/html.php'; ?>
    <script src="http://malsup.github.com/jquery.form.js"></script>
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
                            <br><button class="btn btn-primary" id="password" onclick="showPassword()">Wachtwoord veranderen</button>
                        </div>
                        <?php
                        if ($user->hasPermission('admin')) {
                        ?>
                            <div class="col-md-6 col-xs-12">
                                <br><button class="btn btn-primary" id="upload" onclick="showUpload()">Nieuw account maken</button>
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
                <input class="btn btn-primary" id="submit" type="submit">
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
                    <label>Profielfoto:</label><input type="file" id="icon" name="icon"><br>
                    <input class="btn btn-primary" id="submit" type="submit">
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