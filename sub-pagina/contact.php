<?php include '../includes/html.php';?>
    <div class="container">
        <h1>Contact informatie <strong>EKC 2000</strong></h1><hr>
        <div class="row">
            <div class="col-md-7 col-xs-12">
                <div class="col-md-12 col-xs-12 well">
                    <h3><strong>Veld</strong></h3>
                    <p class="lead">
                        Kantine 'De uitwijk'<br>
                        Plaats: Emmen<br>
                        Straat: zwanenveld 5<br>
                        Postcode: 7827 XA<br>
                        Telefoonnummer: 0591-617979&#42;
                    </p><hr>
                    <h3><strong>Zaal</strong></h3>
                    <p class="lead">
                        Plaats: Bargeres<br>
                        Straat: Calthornerbrink<br>
                        Postcode: 7812 HS Emmen<br>
                        Telefoonnummer: 0591-618868&#42;
                    </p><hr>
                    <h3><strong>Overig</strong></h3>
                    <p class="lead">
                        Bestuur: <a href="mailto:bestuur@ekc2000.nl">bestuur@ekc2000.nl</a><br><br>
                        Technische zaken: <a href="mailto:tc@ekc2000.nl">tc@ekc2000.nl</a><br><br>
                        Voorzitter TC:<br>
                        Wim Bloeming: 06-50422677&#42;<br><br>
                        Wedstrijdsecretariaat:<br>
                        Nienke Kremer: 06-51207713&#42; / <a href="mailto:wedstrijdsecretariaat@ekc2000.nl">wedstrijdsecretariaat@ekc2000.nl</a><br><br>
                        Scheidsrechters-coördinator:<br>
                        Nienke Kremer: 06-51207713&#42; / <a href="mailto:scheidsrechter.ekc2000@gmail.com">scheidsrechter.ekc2000@gmail.com</a><br><br>
                        Ledenadministratie:<br>
                        Aaltje Machiela: 06-48042904&#42; / <a href="mailto:ledenadministratie@ekc2000.nl">ledenadministratie@ekc2000.nl</a><br><br>
                        Developers: <a href="https://nl.linkedin.com/in/martijnet" target="_blank">Martijn Posthuma</a>, <a href="https://nl.linkedin.com/in/casvandinter" target="_blank">Cas van Dinter</a>
                    </p>
                    <sub>&#42; Telefoonnummers mogen niet voor commerci&#235;le doeleinden gebruikt worden.</sub>
                </div>
            </div>
            <div class="col-md-5 col-xs-12">
                <div id="map"></div>
            </div>
            <div class="col-md-5 col-xs-12">
                <div class="col-md-12 col-xs-12 well social">
                    <h3><strong>Social media</strong></h3><hr><br>
                    <a href="https://facebook.com/EKC2000" target="_blank">
                        <i class="fa fa-facebook-official"></i><p>Like ons op Facebook</p>
                    </a><br><br>
                    <a href="https://twitter.com/EKC2000_Emmen" target="_blank">
                        <i class="fa fa-twitter"></i><p>Volg ons op Twitter</p>
                    </a>
                </div>
            </div>
        </div>
    </div>
<script>

    var map;
    function initMap() {
        var myLatLng = {lat: 52.7470678, lng: 6.8850779};
        map = new google.maps.Map(document.getElementById('map'), {
            center: myLatLng,
            zoom: 16
        });
        var marker = new google.maps.Marker({
            position: myLatLng,
            map: map,
            title: 'EKC 2000'
        });
    }

</script>
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBQfgfZkvB_beJBG6Gg_C7Mubnts5A7mOc&callback=initMap" async defer></script>
<?php include '../includes/htmlUnder.php'; ?>
