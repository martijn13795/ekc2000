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
                <li <?=echoActiveClassIfRequestMatches("home"); echoActiveClassIfRequestMatches("index"); echoActiveClassIfRequestMatches("")?>><a href="/home">Home</a></li>

                <li <?=echoActiveClassIfRequestMatches("vereniging"); echoActiveClassIfRequestMatches("sponsoren")?>>
                    <a href="/vereniging" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">Vereniging<span class="caret"></span></a>
                    <ul class="dropdown-menu" role="menu">
                        <li><a href="/vereniging">Over de club</a></li>
                        <li <?=echoActiveClassIfRequestMatches("sponsoren")?>><a href="/sponsoren">Sponsoren</a></li>
                        <li><a href="/vereniging">Bestuur</a></li>
                        <li><a href="/vereniging">Commissies</a></li>
                        <li><a href="/vereniging">lid worden</a></li>
                        <li><a href="/vereniging">Contact</a></li>
                    </ul>
                </li>

                <li <?=echoActiveClassIfRequestMatches("nieuws")?>><a href="/nieuws">Nieuws</a></li>

                <li <?=echoActiveClassIfRequestMatches("activiteiten")?>><a href="/activiteiten">Activiteiten</a></li>

                <li <?=echoActiveClassIfRequestMatches("documenten")?>><a href="/documenten">Documenten</a></li>

                <li <?=echoActiveClassIfRequestMatches("competitie")?>>
                    <a href="/competitie" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">Competitie<span class="caret"></span></a>
                    <ul class="dropdown-menu" role="menu">
                        <li><a href="/competitie">Teams</a></li>
                        <li><a href="/competitie">Wedstrijdschema</a></li>
                        <li><a href="/competitie">Standen</a></li>
                        <li><a href="/competitie">Uitslagen</a></li>
                        <li><a href="/competitie">Wedstrijd verslagen</a></li>
                        <li><a href="/competitie">Trainingstijden</a></li>
                        <li><a href="/competitie">Kantinedienst</a></li>
                    </ul>
                </li>
                <li <?=echoActiveClassIfRequestMatches("inloggen")?>><a href="/inloggen"><i class="fa fa-sign-in"></i> Inloggen</a></li>
            </ul>
        </div>
    </div>
</div>
<div class="header-line"></div>