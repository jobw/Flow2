<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Welkom bij Flow2</title>
    <link rel="icon" href="favicon.ico" type="image/x-icon" />
    <link rel="stylesheet" href="stylesheet.css" />
</head>

<body>
    <div id="top">
        <div id="logosect">
            <img src="images/Logo.png" style="height: 80px; float:left;">
        </div>

        <div id="accountsect" style="height: 100%;">
            <form style="height: 100px; display:table-cell; vertical-align:middle;" action="verwerk.php" method="POST">
                <tr>
                    <div id="accounttop">
                        <input class="logintxt" type="text" name="gebruikersnaam" placeholder="Gebruikersnaam">
                        <input class="logintxt" type="password" name="wachtwoord" placeholder="Wachtwoord">
                        <input class="logincmd" type="submit" value="Log in">
                    </div>
                </tr>
                <tr>
                    <div id="accountmiddle">
                        of
                    </div>
                </tr>
                <tr>
                    <div id="accountbottom">
                        <input id="registreercmd" type="submit" formaction="login/registreer.php" value="Koppel uw meter">
                    </div>
                </tr>
            </form>
        </div>
    </div>

    <div id="middle">
        <img id="meterimg" src="images/meter.png" />
        <div id="slogan">
            Meten is weten met Flow<sub style="font-size:80px">2</sub>
        </div>
        <p style="font-size: 30px;" id="shorttext">
            Welkom op de website van Flow<sub style="font-size:20px">2</sub>, uw nieuwe verbonden CO<sub
                style="font-size:20px">2</sub> meter voor binnenshuis
        </p>
        <p style="font-size: 20px;" id="shorttext">

            ‘Ontwikkel een CO2 meter die binnen te gebruiken is en makkelijk te hanteren’. Dit was de opdracht van het
            bedrijf SODAQ, dat aan ons was aangeboden door CEO Jan-Willem Smeenk.
            <br>
            Wij vonden het zeer boeiend om aan deze opdracht te werken, vooral omdat je erg veel te weten krijgt over
            een branche waar je normaal gesproken als jongeren zeer weinig mee te maken hebt. Daarnaast zijn CO2 meters
            erg actueel. De meters worden massaal gebruikt door scholen, instanties en bedrijven om de luchtcirculatie
            op pijl te houden, in verband met de COVID-19 pandemie. Het blijkt dat de gasmeter branche veel diverser is
            dan je van te voren zou denken. Er moest hier dus veel onderzoek naar gedaan worden. Dit maakte het project
            ook zeer leerzaam. Deze opgedane kennis uit onderzoek was echt nodig om het project goed te laten verlopen.
            Het uitdagende stuk van het project was het programmeren van een meter die waardes weergeeft die goed te
            overzien zijn. Dit maakte ons product echter veel gebruiksvriendelijker en heeft gezorgd voor een
            eindproduct van goede kwaliteit.
        </p>
    </div>

    <div id="bottom">
        <p>
            <a href="https://github.com/jobw/Flow2">Github</a> - Copyright Flow2 2020
        </p>
    </div>
</body>

</html>