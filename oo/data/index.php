<!DOCTYPE html>
<html lang="nl">

<head>
    <title>Luchtkwaliteit</title>

    <script src="data.js"></script>
    <script src="https://cdn.zingchart.com/zingchart.min.js"></script>
    </script>

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
        </div> <a href="../home/">
            <div id="datacmd">
                <div
                    style="height: 100px; display:table-cell; vertical-align:middle; text-align:center; width:200px; font-size:20pt">
                    <tr>
                        <div id="innnerinnerdatacmd">
                            <b> Dashboard </b>
                        </div>
                    </tr>
                </div>
        </a>

    </div><a href="../data/">
        <div id="datacmd">
            <div
                style="height: 100px; display:table-cell; vertical-align:middle; text-align:center; width:200px; font-size:20pt;background-color: beige;">
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
                    <b> Uw Historische Flow2 Data: </b>
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

    <div id="buttons" style="width: 600px;">
        <!-- <button style="width: 300px; float: left;" onclick="renderchart();">
            <h3> placeholder </h3>
            </h1>
        </button> -->
        <button style="width: 300px; float: left;" onclick="fetchhistodatres();">
            <h3> Get average data </h3>
            </h1>
        </button><br>
    </div><br>

    <div id="loading" style="float: left; visibility: hidden;"> <img src="../images/loading.gif" style="width: 30px; float: left;">
    </div> <br>
    <br>
    dag vanaf: <input type="text" id="dayv"> maand vanaf: <input type="text" id="monthv"> <br>
    dag tot: <input type="text" id="dayt"> maand tot: <input type="text" id="montht">
    <h2>---------------------------------------------------------------</h2> <br>
    <div id="myChart"></div>
    <h2>---------------------------------------------------------------</h2> <br>
    <p style="float: left; max-width: 300px;" id="at"></p>
    <p style="float: left; max-width: 300px;" id="data"></p>
</body>

</html>