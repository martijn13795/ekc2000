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
                <li <?=echoActiveClassIfRequestMatches("home"),echoActiveClassIfRequestMatches("index"),echoActiveClassIfRequestMatches("")?>><a href="/home">Home</a></li>

                <li <?=echoActiveClassIfRequestMatches("over-de-club"),echoActiveClassIfRequestMatches("sponsoren"),echoActiveClassIfRequestMatches("bestuur"),echoActiveClassIfRequestMatches("commissies"),echoActiveClassIfRequestMatches("lid-worden"),echoActiveClassIfRequestMatches("contact")?> class="closed">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">Vereniging<span class="caret"></span></a>
                    <ul class="dropdown-menu" role="menu">
                        <li <?=echoActiveClassIfRequestMatches("over-de-club")?>><a href="/over-de-club">Over de club</a></li>
                        <li <?=echoActiveClassIfRequestMatches("sponsoren")?>><a href="/sponsoren">Sponsoren</a></li>
                        <li <?=echoActiveClassIfRequestMatches("bestuur")?>><a href="/bestuur">Bestuur</a></li>
                        <li <?=echoActiveClassIfRequestMatches("commissies")?>><a href="/commissies">Commissies</a></li>
                        <li <?=echoActiveClassIfRequestMatches("lid-worden")?>><a href="/lid-worden">lid worden</a></li>
                        <li <?=echoActiveClassIfRequestMatches("contact")?>><a href="/contact">Contact</a></li>
                    </ul>
                </li>

                <li <?=echoActiveClassIfRequestMatches("nieuws")?>><a href="/nieuws">Nieuws</a></li>

                <li <?=echoActiveClassIfRequestMatches("activiteiten")?>><a href="/activiteiten">Activiteiten</a></li>

                <li <?=echoActiveClassIfRequestMatches("documenten")?>><a href="/documenten">Documenten</a></li>

                <li <?=echoActiveClassIfRequestMatches("teams"),echoActiveClassIfRequestMatches("wedstrijdschema"),echoActiveClassIfRequestMatches("standen"),echoActiveClassIfRequestMatches("uitslagen"),echoActiveClassIfRequestMatches("wedstrijd-verslagen"),echoActiveClassIfRequestMatches("trainingstijden"),echoActiveClassIfRequestMatches("kantinedienst")?> class="closed">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">Competitie<span class="caret"></span></a>
                    <ul class="dropdown-menu" role="menu">
                        <li <?=echoActiveClassIfRequestMatches("teams")?>><a href="/teams">Teams</a></li>
                        <li <?=echoActiveClassIfRequestMatches("wedstrijdschema")?>><a href="/wedstrijdschema">Wedstrijdschema</a></li>
                        <li <?=echoActiveClassIfRequestMatches("standen")?>><a href="/standen">Standen</a></li>
                        <li <?=echoActiveClassIfRequestMatches("uitslagen")?>><a href="/uitslagen">Uitslagen</a></li>
                        <li <?=echoActiveClassIfRequestMatches("wedstrijd-verslagen")?>><a href="/wedstrijd-verslagen">Wedstrijd verslagen</a></li>
                        <li <?=echoActiveClassIfRequestMatches("trainingstijden")?>><a href="/trainingstijden">Trainingstijden</a></li>
                        <li <?=echoActiveClassIfRequestMatches("kantinedienst")?>><a href="/kantinedienst">Kantinedienst</a></li>
                    </ul>
                </li>
                <li <?=echoActiveClassIfRequestMatches("inloggen")?>><a href="/inloggen"><i class="fa fa-sign-in"></i> Inloggen</a></li>
            </ul>
        </div>
    </div>
</div>
<div class="header-line"></div>