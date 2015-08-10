<?php
include '../includes/html.php';
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
                        Redirect::to('/home');
                    } else {
                        echo "<div class='error'>Loggin in failed</div>";
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
            <div class="row-fluid inloggenDiv">
                <div class="col-md-4 col-md-offset-4 well">
                    <legend>Inloggen</legend>
                    <div class="form-group">
                        <form method="POST" action="/inloggen" id="inloggen" accept-charset="UTF-8">
                            <input type="text" id="username" class="form-control" name="username"
                                   placeholder="Gebruikersnaam"><br/>
                            <input type="password" id="password" class="form-control" name="password"
                                   placeholder="Wachtwoord"><br/>
                            <label for="remember">
                                <input type="checkbox" name="remember" id="remember"/>
                                Remember me
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

        ?>

<script>
    $('.alert').remove();
    var tmpl = '<div class="alert alert-success alert-dismissable">'+
        '<button class="close" data-dismiss="alert">&times;</button>'+
        'U bent ingelogt'+
        '</div>';
    $('.row-fluid').append(tmpl);
    setTimeout(function(){
        $('.alert').addClass('on');
        setTimeout(function(){
            $('.alert').removeClass('on');
            setTimeout(function(){
                $('.alert').remove();
            },1000);
        },3000);
    },10);
</script>
