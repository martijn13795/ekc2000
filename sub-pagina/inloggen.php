<?php include '../includes/html.php'; ?>
<script>
    function warning() {
        $('.alerts').append('<div class="alert alert-warning alert-dismissable">' +
            '<button class="close" data-dismiss="alert">&times;</button>' +
            'Gebruikersnaam of wachtwoord is niet juist' +
            '</div>');
        setTimeout(function () {
            $('.alerts').children('.alert:last-child').addClass('on');
            setTimeout(function () {
                $('.alerts').children('.alert:first-child').removeClass('on');
                setTimeout(function () {
                    $('.alerts').children('.alert:first-child').remove();
                }, 900);
            }, 5000);
        }, 10);
    }
</script>
<?php
$user = new User();
if(!$user->isLoggedIn()) {
    if (Input::exists()) {
        if (Token::check(Input::get('token'))) {
            $validate = new Validate();
            $validation = $validate->check($_POST, array(
                'username' => array(
                    'required' => true
                ),
                'password' => array(
                    'required' => true
                )
            ));

            if ($validation->passed()) {


                $remember = (Input::get('remember') === 'on') ? true : false;
                $login = $user->login(Input::get('username'), Input::get('password'), $remember);

                if ($login) {
                    echo '<script>
                            var logedin = "ja";
                            localStorage.setItem("logedin", logedin);
                            window.location.replace("/home");
                        </script>';
                } else {
                    echo '<script>warning();</script>';
                }
            } else {
                foreach ($validation->errors() as $error) {
                    echo "<div class='error'>" . $error . "</div>";
                }
            }
        }
    }
    ?>
    <div class="container">
        <br><div class="col-md-6 col-md-offset-3 well">
            <p>Gebruikersnaam: voornaam.(tussenvoegsel).achternaam</p>
            <p>Wachtwoord: Geboortedatum jaar-maand-dag (1900-01-01)</p>
            <p>Voor vragen mail naar: <a href="mailto:website@ekc2000.nl">website@ekc2000.nl</a></p>
        </div>
        <div class="row-fluid inloggenDiv">
            <div class="col-md-4 col-md-offset-4 well">
                <legend>Inloggen</legend>
                <div class="form-group">
                    <form method="POST" action="/inloggen" id="inloggen" accept-charset="UTF-8">
                        <input type="text" id="username" class="form-control" name="username"
                               placeholder="Gebruikersnaam" REQUIRED><br/>
                        <input type="password" id="password" class="form-control" name="password"
                               placeholder="Wachtwoord" REQUIRED><br/>
                        <label for="remember">
                            <input type="checkbox" name="remember" id="remember"/>
                            Ingelogd blijven
                        </label><br/>
                        <input type="hidden" name="token" value="<?php echo Token::generate(); ?>"/>
                        <button type="submit" name="submit" class="btn btn-primary btn-block">Inloggen</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <?php
}else{
    Redirect::to("/home");
}
include '../includes/htmlUnder.php';
?>
