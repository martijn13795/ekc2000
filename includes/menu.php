<div class="alerts"></div>
<div id="menuHeader" class="hidden-xs">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <a href="/home"><img class="logo" src="/images/logo.png" alt="Logo"/></a>
                <a href="/home"><h3>Welkom bij <strong>EKC 2000</strong></h3></a>
            </div>
        </div>
    </div>
</div>
<div id="menu" class="navbar navbar-default navbar-static-top" role="navigation">
    <div class="container">
        <div class="navbar-header hidden-md hidden-sm hidden-lg"><a class="navbar-brand" href="/home">EKC 2000</a>
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-menubuilder"><span class="sr-only">Toggle navigation</span><span class="icon-bar"></span><span class="icon-bar"></span><span class="icon-bar"></span>
            </button>
        </div>
        <div class="collapse navbar-collapse navbar-menubuilder">
            <ul class="nav navbar-nav navbar-left">
                <li <?=activeClass("home"),activeClass("index"),activeClass("")?>><a href="/home">Home</a></li>

                <li <?=activeClass("over-de-club"),activeClass("sponsoren"),activeClass("bestuur"),activeClass("commissies"),activeClass("contact"),activeClass("ideeenbus"),activeClass("documenten")?> class="closed">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">Vereniging<span class="caret"></span></a>
                    <ul class="dropdown-menu" role="menu">
                        <li <?=activeClass("over-de-club")?>><a href="/over-de-club">Over de club</a></li>
                        <li <?=activeClass("sponsoren")?>><a href="/sponsoren">Sponsoren</a></li>
                        <li <?=activeClass("commissies")?>><a href="/commissies">Commissies</a></li>
                        <?php if ($user->isLoggedIn()) { ?><li <?=activeClass("ideeenbus")?>><a href="/ideeenbus">Idee&euml;nbus</a></li><?php } ?>
                        <?php if ($user->isLoggedIn()) { ?><li <?=activeClass("documenten")?>><a href="/documenten">Documenten</a></li><?php } ?>
                        <li <?=activeClass("contact")?>><a href="/contact">Contact</a></li>
                    </ul>
                </li>

                <li <?=activeClass("lid-worden"),activeClass("kangoeroeklup"),activeClass("contributie")?> class="closed">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">Lid worden<span class="caret"></span></a>
                    <ul class="dropdown-menu" role="menu">
                        <li <?=activeClass("lid-worden")?>><a href="/lid-worden">Lid worden</a></li>
                        <li <?=activeClass("kangoeroeklup")?>><a href="/kangoeroeklup">Kangoeroeklup</a></li>
                        <li <?=activeClass("contributie")?>><a href="/contributie">Contributie</a></li>
                    </ul>
                </li>

                <li <?php activeClass("nieuws"); $testGet = isset($_GET['artikelName']) ? activeClass($_GET['artikelName']) : ''; ?>><a href="/nieuws">Nieuws</a></li>

                <li <?php activeClass("fotogalerij"); $testGet = isset($_GET['name']) ? activeClass($_GET['name']) : ''; ?>><a href="/fotogalerij">Fotogalerij</a></li>

                <li <?php activeClass("activiteiten"); $testGet = isset($_GET['activiteitName']) ? activeClass($_GET['activiteitName']) : ''; ?>><a href="/activiteiten">Activiteiten</a></li>

                <li <?=activeClass("teams"),activeClass("wedstrijdschema"),activeClass("standen"),activeClass("uitslagen"),activeClass("uitslag-invoeren"),activeClass("uitslag-poules"),activeClass("wedstrijdverslagen"),activeClass("trainingstijden"),activeClass("kantinedienst")?> class="closed">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">Competitie<span class="caret"></span></a>
                    <ul class="dropdown-menu" role="menu">
                        <li <?=activeClass("teams")?>><a href="/teams">Teams</a></li>
                        <li <?=activeClass("wedstrijdschema")?>><a href="/wedstrijdschema">Wedstrijdschema</a></li>
                        <li <?=activeClass("standen")?>><a href="/standen">Standen</a></li>
                        <li <?=activeClass("uitslagen")?>><a href="/uitslagen">Uitslagen</a></li>
                        <li <?=activeClass("uitslag-poules")?>><a href="/uitslag-poules">Uitslagen poules</a></li>
                        <li <?=activeClass("uitslag-invoeren")?>><a href="/uitslag-invoeren">Uitslagen invoeren</a></li>
                        <li <?=activeClass("wedstrijdverslagen")?>><a href="/wedstrijdverslagen">Wedstrijdverslagen</a></li>
                        <li <?=activeClass("trainingstijden")?>><a href="/trainingstijden">Trainingstijden</a></li>
                        <li <?=activeClass("kantinedienst")?>><a href="/kantinedienst">Zaal-/kantinedienst</a></li>
                    </ul>
                </li>
                <?php
                    $user = new User();
                    if ($user->isLoggedIn()) {
                        if($user->hasPermission("dev")){
                            ?>
                            <li <?= activeClass("profiel") ?>><a href="/profiel">Profiel Dev</a></li>
                            <?php
                        } else {
                            ?>
                            <li <?= activeClass("profiel") ?>><a href="/profiel">Profiel</a></li>
                            <?php
                        }
                    } else {
                        ?>
                        <li <?=activeClass("inloggen")?>><a href="/inloggen"><i class="fa fa-sign-in"></i> Inloggen</a></li>
                        <?php
                    }
                ?>
            </ul>
        </div>
    </div>
</div>
<!--    snowflakes begin -->
<style>
    #snowflakeContainer {
            position: absolute !important;
            left: 0px !important;
            top: 0px !important;
    }
    .snowflake {
            padding-left: 15px;
            font-family: Cambria, Georgia, serif;
            font-size: 14px;
            line-height: 24px;
            position: fixed;
            color: #FFFFFF;
            user-select: none;
            z-index: 1000;
    }
    .snowflake:hover {
            cursor: default;
    }
</style>
<script>
    // The star of every good animation
    var requestAnimationFrame = window.requestAnimationFrame ||
        window.mozRequestAnimationFrame ||
        window.webkitRequestAnimationFrame ||
        window.msRequestAnimationFrame;

    var transforms = ["transform",
        "msTransform",
        "webkitTransform",
        "mozTransform",
        "oTransform"];

    var transformProperty = getSupportedPropertyName(transforms);

    // Array to store our Snowflake objects
    var snowflakes = [];

    // Global variables to store our browser's window size
    var browserWidth;
    var browserHeight;

    // Specify the number of snowflakes you want visible
    var numberOfSnowflakes = 50;

    // Flag to reset the position of the snowflakes
    var resetPosition = false;

    //
    // It all starts here...
    //
    function setup() {
        window.addEventListener("DOMContentLoaded", generateSnowflakes, false);
        window.addEventListener("resize", setResetFlag, false);
    }
    setup();

    //
    // Vendor prefix management
    //
    function getSupportedPropertyName(properties) {
        for (var i = 0; i < properties.length; i++) {
            if (typeof document.body.style[properties[i]] != "undefined") {
                return properties[i];
            }
        }
        return null;
    }

    //
    // Constructor for our Snowflake object
    //
    function Snowflake(element, radius, speed, xPos, yPos) {

        // set initial snowflake properties
        this.element = element;
        this.radius = radius;
        this.speed = speed;
        this.xPos = xPos;
        this.yPos = yPos;

        // declare variables used for snowflake's motion
        this.counter = 0;
        this.sign = Math.random() < 0.5 ? 1 : -1;

        // setting an initial opacity and size for our snowflake
        this.element.style.opacity = .1 + Math.random();
        this.element.style.fontSize = 12 + Math.random() * 50 + "px";
    }

    //
    // The function responsible for actually moving our snowflake
    //
    Snowflake.prototype.update = function () {

        // using some trigonometry to determine our x and y position
        this.counter += this.speed / 5000;
        this.xPos += this.sign * this.speed * Math.cos(this.counter) / 40;
        this.yPos += Math.sin(this.counter) / 40 + this.speed / 30;

        // setting our snowflake's position
        setTranslate3DTransform(this.element, Math.round(this.xPos), Math.round(this.yPos));

        // if snowflake goes below the browser window, move it back to the top
        if (this.yPos > browserHeight) {
            this.yPos = -50;
        }
    }

    //
    // A performant way to set your snowflake's position
    //
    function setTranslate3DTransform(element, xPosition, yPosition) {
        var val = "translate3d(" + xPosition + "px, " + yPosition + "px" + ", 0)";
        element.style[transformProperty] = val;
    }

    //
    // The function responsible for creating the snowflake
    //
    function generateSnowflakes() {

        // get our snowflake element from the DOM and store it
        var originalSnowflake = document.querySelector(".snowflake");

        // access our snowflake element's parent container
        var snowflakeContainer = originalSnowflake.parentNode;

        // get our browser's size
        browserWidth = document.documentElement.clientWidth;
        browserHeight = document.documentElement.clientHeight;

        // create each individual snowflake
        for (var i = 0; i < numberOfSnowflakes; i++) {

            // clone our original snowflake and add it to snowflakeContainer
            var snowflakeCopy = originalSnowflake.cloneNode(true);
            snowflakeContainer.appendChild(snowflakeCopy);

            // set our snowflake's initial position and related properties
            var initialXPos = getPosition(50, browserWidth);
            var initialYPos = getPosition(50, browserHeight);
            var speed = 5+Math.random()*40;
            var radius = 4+Math.random()*10;

            // create our Snowflake object
            var snowflakeObject = new Snowflake(snowflakeCopy,
                radius,
                speed,
                initialXPos,
                initialYPos);
            snowflakes.push(snowflakeObject);
        }

        // remove the original snowflake because we no longer need it visible
        snowflakeContainer.removeChild(originalSnowflake);

        // call the moveSnowflakes function every 30 milliseconds
        moveSnowflakes();
    }

    //
    // Responsible for moving each snowflake by calling its update function
    //
    function moveSnowflakes() {
        for (var i = 0; i < snowflakes.length; i++) {
            var snowflake = snowflakes[i];
            snowflake.update();
        }

        // Reset the position of all the snowflakes to a new value
        if (resetPosition) {
            browserWidth = document.documentElement.clientWidth;
            browserHeight = document.documentElement.clientHeight;

            for (var i = 0; i < snowflakes.length; i++) {
                var snowflake = snowflakes[i];

                snowflake.xPos = getPosition(50, browserWidth);
                snowflake.yPos = getPosition(50, browserHeight);
            }

            resetPosition = false;
        }

        requestAnimationFrame(moveSnowflakes);
    }

    //
    // This function returns a number between (maximum - offset) and (maximum + offset)
    //
    function getPosition(offset, size) {
        return Math.round(-1*offset + Math.random() * (size+2*offset));
    }

    //
    // Trigger a reset of all the snowflakes' positions
    //
    function setResetFlag(e) {
        resetPosition = true;
    }
</script>
<div id="snowflakeContainer">
        <p class="snowflake">*</p>
</div>
<!--snowflakes end -->
<div class="header-line"></div>