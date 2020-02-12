<?php include '../includes/html.php';?>
    <div class="container">
        <div class="col-md-12 col-xs-12">
            <h1>Contributie</h1><hr>
            <p>De contributie wordt bepaald op basis van de leeftijd (peildatum 1 januari). Elk jaar dient in oktober bondscontributie te worden betaald.
                Wanneer je het lidmaatschap wilt opzeggen, dan dien je dit vóór 30 mei door te geven aan de ledenadministratie. De contributie loopt echter door tot het einde van het seizoen (30 juni).
            </p>
            </div>
            <div class="col-md-3 col-xs-12">
                <form>
                    <label>Geboortedatum:</label><input type="date" id="birthday" class="form-control" name="birthday" placeholder="Geboortedatum" maxlength="30"><br>
                </form>
            </div>
        <div class="col-md-12 col-xs-12">
            <table class="table table-bordered table-hover">
                <thead>
                <tr>
                    <th colspan="4" class="tableHeader">Contributie</th>
                </tr>
                <tr>
                    <th scope="row" class="tableHeader">Team categorie</th>
                    <th scope="row" class="tableHeader">Leeftijd</th>
                    <th scope="row" class="tableHeader">Lid contributie per maand</th>
                    <th scope="row" class="tableHeader">Bondscontributie per jaar</th>
                </tr>
                </thead>
                <tbody>
                <tr id="18" class="reset">
                    <th scope="row">senioren</th>
                    <td>18+</td>
                    <td>&euro; 22,50</td>
                    <td>&euro; 35,00</td>
                </tr>
                <tr id="15" class="reset">
                    <th scope="row">Junioren A's</th>
                    <td>15-17</td>
                    <td>&euro; 17,80</td>
                    <td>&euro; 28,00</td>
                </tr>
                <tr id="13" class="reset">
                    <th scope="row">Aspiranten B's</th>
                    <td>13-14</td>
                    <td>&euro; 13,20</td>
                    <td>&euro; 21,00</td>
                </tr>
                <tr id="11" class="reset">
                    <th scope="row">Aspiranten C's</th>
                    <td>11-12</td>
                    <td>&euro; 13,20</td>
                    <td>&euro; 21,00</td>
                </tr>
                <tr id="9" class="reset">
                    <th scope="row">Pupillen D's</th>
                    <td>9-10</td>
                    <td>&euro; 12,20</td>
                    <td>&euro; 17,50</td>
                </tr>
                <tr id="7" class="reset">
                    <th scope="row">Pupillen E's</th>
                    <td>7-8</td>
                    <td>&euro; 12,20</td>
                    <td>&euro; 17,50</td>
                </tr>
                <tr id="5" class="reset">
                    <th scope="row">Welpen F's</th>
                    <td>5-6</td>
                    <td>&euro; 10,80</td>
                    <td>&euro; 10,50</td>
                </tr>
                <tr id="0" class="reset">
                    <th scope="row">Welpen kangoeroes</th>
                    <td>0-4</td>
                    <td>&euro; 5,50</td>
                    <td>&euro; 10,50</td>
                </tr>
                <tr>
                    <th scope="row">Niet spelende leden</th>
                    <td></td>
                    <td>50% van leefdtijdscategorie</td>
                    <td>&euro; 5,00</td>
                </tr>
                <tr>
                    <th scope="row">Donateurs</th>
                    <td></td>
                    <td>&euro; 25,00 per jaar</td>
                    <td></td>
                </tr>
                </tbody>
            </table>
        </div>
    </div>
<script>
    $('#birthday').on("change", function () {
        var getValue = $(this).val();
        var value = getValue.split("-").join("/");
        var referenceDate = "";
        var year = new Date().getFullYear();
        var changeDate = "01-07-" + year;

        var changeDate = new Date(changeDate);
        var today = new Date();

        if (changeDate.setHours(0,0,0,0) <= today.setHours(0,0,0,0)) {
            referenceDate = "01-01-" + year;
        } else {
            referenceDate = "01-01-" + (year - 1);
        }
        referenceDate = referenceDate.split("-").reverse().join("/");
        referenceDate = new Date(referenceDate);

        var birthDate = new Date(value);
        var age = referenceDate.getFullYear() - birthDate.getFullYear();
        var m = referenceDate.getMonth() - birthDate.getMonth();
        if (m < 0 || (m === 0 && referenceDate.getDate() < birthDate.getDate())) {
            age--;
        }

        $(".reset").removeAttr("style");
        if (new Date(value).setHours(0,0,0,0) <= new Date().setHours(0,0,0,0) && new Date(value).getFullYear() > 1900) {
            if (age >= 18) {
                $("#18").css("background", "#eee");
            }
            else if (age == 15 || age == 16 || age == 17) {
                $("#15").css("background", "#eee");
            }
            else if (age == 13 || age == 14) {
                $("#13").css("background", "#eee");
            }
            else if (age == 11 || age == 12) {
                $("#11").css("background", "#eee");
            }
            else if (age == 9 || age == 10) {
                $("#9").css("background", "#eee");
            }
            else if (age == 7 || age == 8) {
                $("#7").css("background", "#eee");
            }
            else if (age == 5 || age == 6) {
                $("#5").css("background", "#eee");
            }
            else if (age == 0 || age == 1 || age == 2 || age == 3 || age == 4) {
                $("#0").css("background", "#eee");
            }
        }
    });
</script>
<?php include '../includes/htmlUnder.php'; ?>