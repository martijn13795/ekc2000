<div id="menuHeader"><a href="index.php">Welkom bij EKC 2000</a></div>
<div id="menu" class="navbar navbar-default navbar-static-top" role="navigation">
    <div class="container-fluid">
        <div class="navbar-header"><a class="navbar-brand" href="../index.php">EKC 2000</a>
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-menubuilder"><span class="sr-only">Toggle navigation</span><span class="icon-bar"></span><span class="icon-bar"></span><span class="icon-bar"></span>
            </button>
        </div>
        <div class="collapse navbar-collapse navbar-menubuilder">
            <ul class="nav navbar-nav navbar-left">
                <li <?=echoActiveClassIfRequestMatches("index")?><?=echoActiveClassIfRequestMatches("")?>><a href="../index.php">Home</a></li>

                <li class="dropdown" <?=echoActiveClassIfRequestMatches("vereniging")?>>
                    <a href="../sub-pagina/vereniging.php" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">Vereniging<span class="caret"></span></a>
                    <ul class="dropdown-menu" role="menu">
                        <li><a href="../sub-pagina/vereniging.php">Over de club</a></li>
                        <li><a href="../sub-pagina/vereniging.php">Bestuur</a></li>
                        <li><a href="../sub-pagina/vereniging.php">Commissies</a></li>
                        <li><a href="../sub-pagina/vereniging.php">lid worden</a></li>
                        <li><a href="../sub-pagina/vereniging.php">Contact</a></li>
                    </ul>
                </li>

                <li <?=echoActiveClassIfRequestMatches("nieuws")?>><a href="../sub-pagina/nieuws.php">Nieuws</a></li>

                <li <?=echoActiveClassIfRequestMatches("activiteiten")?>><a href="../sub-pagina/activiteiten.php">Activiteiten</a></li>

                <li <?=echoActiveClassIfRequestMatches("documenten")?>><a href="../sub-pagina/documenten.php">Documenten</a></li>

                <li <?=echoActiveClassIfRequestMatches("sponsoren")?>><a href="../sub-pagina/sponsoren.php">Sponsoren</a></li>

                <li <?=echoActiveClassIfRequestMatches("competitie")?>><a href="../sub-pagina/competitie.php">Competitie</a></li>
            </ul>
        </div>
    </div>
</div>
<div class="header-line"></div>