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
            <h1>De ‘Kangoeroe Klup’ gaat weer van start!<h1/><hr>
                <img src="../images/Kangoeroeklup.png" alt="Kangoeroe klup" style="margin: 10px; float: right;" class="img-responsive"/>
                <h3>Op zaterdag 1, 15 april en 13, 20 mei is iedereen weer welkom!</h3>
                <p>Zaterdag 1 april van 10:00 tot ca. 11:30.<br>Zaterdag 15 april van 12:00 tot ca. 13:30.<br>Zaterdag 13 mei van 11:00 to ca. 12:30.<br>Zaterdag 20 mei van 10:00 tot ca. 11:30.<br><br>Op het korfbalveld te sportpark Zwanenveld (Zwanenveld 5) in de wijk Rietlanden.<br><br>
                    De Kangoeroe Klup is een gezellige club voor kinderen van 3 tot 7 jaar waarbij je lekker kunt sporten met leeftijdsgenootjes. Bij de korfbalvereniging EKC 2000 bereiden elke week speciaal hiervoor opgeleide leiders een training voor.<br><br>
                    De naam ‘Kangoeroe Klup’ is door het korfbalverbond (KNKV) gekozen daar de kangoeroe veel overeenkomsten heeft met vaardigheden die horen bij de korfbalsport, zoals snelheid, wendbaarheid en sprongkracht. Daarnaast heeft de kangoeroe een buidel die aan jonge kangoeroes bescherming en veiligheid biedt! Om de Kangoeroe Klup sprekend te maken, is door het KNKV een viertal jeugdige kangoeroes ontwikkeld. Deze figuurtjes, genaamd Scoro, Jumper, Funny en Spurt , vervullen een hoofdrol binnen de Kangoeroe Klup.
                </p><br>
                <p>Graag extra informatie? Neem dan vrijblijvend contact op via <a href="mailto:info@ekc2000.nl">info@ekc2000.nl</a></p>
                <p>S.v.p. van tevoren aanmelden via <a href="mailto:info@ekc2000.nl">info@ekc2000.nl</a> of via het formulier rechtsonder.</p><br>
                <div class="col-md-6 col-xs-12">
                    <img src="../images/Kangoeroes.png" alt="Kangoeroes" class="img-responsive"/>
                </div>
                <div class="col-md-6 col-xs-12">
                    <form method="post" name="myForm" class="myForm" action="../includes/kangarooContact.php">
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