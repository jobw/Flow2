<!DOCTYPE html>
<html lang="nl">

<head>
    <title>Luchtkwaliteit</title>

    <script src="index.js" onload="httpGet()"></script>

    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="icon" href="../favicon.ico" type="image/x-icon" />
    <link rel="stylesheet" href="stylesheet.css">
    <?php session_start();
    if (!isset($_SESSION['userggvns'])) {
        echo "geen session gevonden";
        header("Location:https://informaticacals.nl/jvdwilt/oo/");
    }
    ?>
</head>

<body>

    <div id="top">
        <div id="logosect">
            <img src="../images/Logo.png" style="height: 80px; float:left;">
        </div><a href="../home/">
            <div id="datacmd">
                <div style="height: 100px; background-color: beige;display:table-cell; vertical-align:middle; text-align:center; width:200px; font-size:20pt">
                    <tr>
                        <div id="innnerinnerdatacmd">
                            <b> Dashboard </b>
                        </div>
                    </tr>
                </div>
        </a>

    </div><a href="../data/">
        <div id="datacmd">
            <div style="height: 100px; display:table-cell; vertical-align:middle; text-align:center; width:200px; font-size:20pt">
                <tr>
                    <div id="innnerinnerdatacmd">
                        <b> Geschiedenis </b>
                    </div>
                </tr>
            </div>
    </a>

    </div>

    <div id="accountsect" style="height: 100%;">
        <form style="height: 100px; display:table-cell; vertical-align:middle;" action="verwerk.php" method="POST">
            <tr>
                <div id="accounttop">
                    <b> Uw Flow2 Live Dashboard: </b>
                </div>
            </tr>
            <tr>
                <div id="accountmiddle">
                    <?php echo $_SESSION['userggvns']['voornaam'] . " " . $_SESSION['userggvns']['achternaam'] ?>
                </div>
            </tr>
            <tr>
                <div id="accountbottom">
                    <input id="registreercmd" type="submit" formaction="login/registreer.php" value="Log uit">
                </div>
            </tr>
        </form>
    </div>
    </div> <br>

    <div id="shortinfo">
        <p id="welcomep"> Welkom op uw persoonlijke Live Flow2 Dashboard:
            <?php echo $_SESSION['userggvns']['voornaam'] . " " . $_SESSION['userggvns']['achternaam'] ?>. </p>
        <p id="shorttxt">
            <i> Korte samenvatting van de huidige situatie: </i><br>
        <p id="shorttxttxt">
            De Co2 waarde is erg hoog
        </p>
        </p>
    </div>

    <div id="livewaardes">
        <div class="trends">
            <i class="trendtitle">Laatst gemeten waarde op </i>
            <i class="trendtitle" id="co2trendtijd"><b>-</b></i>
        </div>
        <div id="co2div">
            <div id="co2live">
                <td>
                    <div class="waardedesc">
                        <p>Huidige co<sub style="font-size: 12pt;">2</sub> waarde:</p>
                    </div>
                </td>
                <td>
                    <div class="waardes">
                        <p id="co2">-</p>
                        <p style="font-size: 40pt;">ppm</p> <br>
                    </div>
                </td>
            </div>

            <td>
                <div class="waardedesc">
                    <p id="trendtitle">trends:</p>
                </div>
            </td>
            <div id="trenddiv">
                <td>
                    <div class="trends" id="co2trend1div">
                        <p class="trendtitle">Vorige waarde: </p>

                        <p class="trendvalue" id="co2trend1arrow"></p>
                        <p class="trendvalue" id="co2trend1">-</p>
                    </div>
                </td>
                <td>
                    <div class="trends" id="co2trend2div">
                        <p class="trendtitle">Gem. vorige 5 waardes: </p>
                        <p class="trendvalue" id="co2trend2arrow"></p>
                        <p class="trendvalue" id="co2trend2">-</p>
                    </div>
                </td>
                <td>
                    <div class="trends" id="co2tredn3div">
                        <p class="trendtitle">Gem. vorige 20 waardes: </p>
                        <p class="trendvalue" id="co2trend3arrow"></p>
                        <p class="trendvalue" id="co2trend3">-</p>
                    </div>
                </td>
            </div>
        </div>

        <div id="tempdiv">
            <td>
                <div class="waardedesc">
                    <p> Huidige tempteratuur:</p>
                </div>
            </td>
            <td>
                <div class="waardes">
                    <p id="temp">-</p>
                    <p style="font-size: 40pt;">°C</p> <br>
                </div>
            </td>
            <td>
                <div class="waardedesc">
                    <p id="trendtitle">trends:</p>
                </div>
            </td>
            <div id="trenddiv">
                <td>
                    <div class="trends" id="temptrend1div">
                        <p class="trendtitle">Vorige waarde: </p>

                        <p class="trendvalue" id="temptrend1arrow"></p>
                        <p class="trendvalue" id="temptrend1">-</p>
                    </div>
                </td>
                <td>
                    <div class="trends" id="temptrend2div">
                        <p class="trendtitle">Gem. vorige 5 waardes: </p>
                        <p class="trendvalue" id="temptrend2arrow"></p>
                        <p class="trendvalue" id="temptrend2">-</p>
                    </div>
                </td>
                <td>
                    <div class="trends" id="temptredn3div">
                        <p class="trendtitle">Gem. vorige 20 waardes: </p>
                        <p class="trendvalue" id="temptrend3arrow"></p>
                        <p class="trendvalue" id="temptrend3">-</p>
                    </div>
                </td>
            </div>
        </div>

        <div id="humiddiv">
            <td>
                <div class="waardedesc">
                    <p>Huidige luchtvochtigheid:</p>
                </div>
            </td>
            <td>
                <div class="waardes">
                    <p id="humid">-</p>
                    <p style="font-size: 40pt;">%</p> <br>
                </div>
            </td>
            <td>
                <div class="waardedesc">
                    <p id="trendtitle">trends:</p>
                </div>
            </td>
            <div id="trenddiv">
                <td>
                    <div class="trends" id="humidtrend1div">
                        <p class="trendtitle">Vorige waarde: </p>

                        <p class="trendvalue" id="humidtrend1arrow"></p>
                        <p class="trendvalue" id="humidtrend1">-</p>
                    </div>
                </td>
                <td>
                    <div class="trends" id="humidtrend2div">
                        <p class="trendtitle">Gem. vorige 5 waardes: </p>
                        <p class="trendvalue" id="humidtrend2arrow"></p>
                        <p class="trendvalue" id="humidtrend2">-</p>
                    </div>
                </td>
                <td>
                    <div class="trends" id="humidtredn3div">
                        <p class="trendtitle">Gem. vorige 20 waardes: </p>
                        <p class="trendvalue" id="humidtrend3arrow"></p>
                        <p class="trendvalue" id="humidtrend3">-</p>
                    </div>
                </td>
            </div>
        </div>
    </div>


</body>

</html>