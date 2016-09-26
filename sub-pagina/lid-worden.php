<?php include '../includes/html.php';?>
    <script src="http://malsup.github.com/jquery.form.js"></script>
<style>
    input[type=number]::-webkit-inner-spin-button,
    input[type=number]::-webkit-outer-spin-button {
        -webkit-appearance: none;
        margin: 0;
    }
</style>
    <div class="container">
        <div class="col-md-12 col-xs-12">
            <h1>Lid worden</h1><hr>
            <p>EKC 2000 is een korfbalvereniging waar zowel wedstrijd- als breedtekorfbal wordt gespeeld.
                Hierdoor is er voor iedereen ruimte om te korfballen, ongeacht niveau of leeftijd.
                Om lid te worden kun je het onderstaande aanmeldformulier downloaden, invullen en mailen naar <a href="mailto:ledenadministratie@ekc2000.nl">ledenadministratie@ekc2000.nl</a>.
                Wil je eerst eens vrijblijvend meetrainen of meer informatie?
                Bel/mail ons of laat hieronder je contactgegevens achter. We hopen je snel te mogen begroeten als nieuw EKC 2000-lid!<p/><br>
        </div>
        <div class="col-md-6 col-xs-12">
            <table class="table table-bordered">
                <thead>
                <tr>
                    <th colspan="2" class="tableHeader">Contactgegevens ledenadministratie</th>
                </tr>
                </thead>
                <tbody>
                <tr>
                    <th scope="row">Naam:</th>
                    <td>Jolanda ten Broeke</td>
                </tr>
                <tr>
                    <th scope="row">Telefoonnummer:</th>
                    <td>0591-634459</td>
                </tr>
                <tr>
                    <th scope="row">E-mail adres:</th>
                    <td><a href="mailto:ledenadministratie@ekc2000.nl">ledenadministratie@ekc2000.nl</a></td>
                </tr>
                <tr>
                    <th scope="row">Download hier het inschrijfformulier:</th>
                    <td><a href="../documents/Inschrijfformulier EKC 2000.pdf">Inschrijfformulier</a></td>
                </tr>
                </tbody>
            </table>
        </div>
        <div class="col-md-6 col-xs-12">
            <form method="post" name="myForm" class="myForm" action="../includes/memberContact.php">
            <table class="table table-bordered">
                <thead>
                <tr>
                    <th colspan="2" class="tableHeader">Laat ons contact met u opnemen</th>
                </tr>
                </thead>
                <tbody>
                <tr>
                    <th scope="row">Naam:</th>
                    <td style="padding: 2px;"><input type="text" style="height: 32px;" class="form-control" placeholder="Naam" id="name" name="name" REQUIRED/></td>
                </tr>
                <tr>
                    <th scope="row">Telefoonnummer:</th>
                    <td style="padding: 2px;"><input type="number" style="height: 32px;" class="form-control" placeholder="Telefoonnummer" id="phoneNumber" name="phoneNumber" REQUIRED/></td>
                </tr>
                <tr>
                    <th scope="row">E-mail adres:</th>
                    <td style="padding: 2px;"><input type="email" style="height: 32px;" class="form-control" placeholder="Email" id="email" name="email" REQUIRED/></td>
                </tr>
                <tr>
                    <th scope="row">Versturen:</th>
                    <td style="padding: 2px;"><input type="submit" id="submit" class="btn btn-success"><button class="btn btn-info" id="refresh" onclick="history.go(0)">Refresh</button></td>
                </tr>
                </tbody>
            </table>
            </form>
            <div id="error"></div>
        </div>
    </div>
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
                    $('.alerts').append('<div class="alert alert-success alert-dismissable">' +
                        '<button class="close" data-dismiss="alert">&times;</button>' +
                        'Er wordt zo spoedig mogelijk contact met u opgenomen' +
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
                    $("#error").show();
                    $("#error").html(response);
                    $("#name").val('');
                    $("#phoneNumber").val('');
                    $("#email").val('');
                }
            });
            $("#refresh").hide();
            $("#error").hide();
        });
    </script>
<?php include '../includes/htmlUnder.php'; ?>