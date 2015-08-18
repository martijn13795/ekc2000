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
                        Telefoonnummer: 0591-617979
                    </p><hr>
                    <h3><strong>Zaal</strong></h3>
                    <p class="lead">
                        Plaats: Bargeres<br>
                        Straat: Calthornerbrink<br>
                        Postcode: 7812 HS Emmen<br>
                        Telefoonnummer: 0591-618868
                    </p>
                </div>
            </div>
            <div class="col-md-5 col-xs-12">
                <div id="map"></div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-7 col-xs-12">
                <h3><strong>Overig</strong></h3>
                <p class="lead">
                    Bestuur:<br>
                    Via het onderstaande E-mail adres kunt u contact opnemen met het bestuur<br>
                    ekc2000.emmen@knkv.nl<br><br>
                    Wedstrijdsecretariaat:<br>
                    Senioren: Petra Bethlehem: 0591-642123<br>
                    Jeugd: Ilse Schuttrups: 06-10433293<br><br>
                    Scheidsrechteraanwijzer:<br>
                    Michael Beekman: 06-49077377.<br><br>
                    Webmaster: Heeft u vragen of opmerkingen m.b.t de website? mail dan naar
                    
                </p>
            </div>
            <div class="col-md-5 col-xs-12 well social">
                <i class="fa fa-facebook"></i> Volg ons op Facebook<br>
                <i class="fa fa-twitter"></i> Volg ons op Twitter<br>
                <i class="fa fa-linkedin"></i>
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
<script src="https://maps.googleapis.com/maps/api/js?callback=initMap" async defer></script>