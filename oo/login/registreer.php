<!DOCTYPE html>

<script>
    function checkggvns() {
        if (document.getElementById("password1").value == document.getElementById("password2").value) {
            document.getElementById("form1").submit();
        } else {
            window.alert("De wachtwoorden komen niet overeen.");
        }
    }
</script>
<html lang="nl">

<head>
    <link rel="stylesheet" href="registreerstyle.css">
    <title>Maak uw account aan</title>
    <link rel="icon" href="../favicon.ico" type="image/x-icon" />
    <?php session_start(); ?>
</head>

<body>
    <form id="form1" class="form" action="slaop.php" method="POST">
        <a class="bannerlink">
            <img class="bannerlogo" src="../images/Logo.png">
        </a>
        <div class="accountarea">
            <input class="logintxt" type="text" name="gebruikersnaam" placeholder="Gebruikersnaam" required="required"> <br><br>
            <input class="logintxt" id="password1" type="password" name="wachtwoord" placeholder="Wachtwoord" required="required"><br><br>
            <input class="logintxt" id="password2" type="password" placeholder="Herhaal Wachtwoord" required="required"><br><br><br><br>

            <input class="gegevenstxt" type="password2" name="voornaam" placeholder="Voornaam" required="required">
            <input class="gegevenstxt" type="password2" name="achternaam" placeholder="Achternaam" required="required"><br><br>
            <input class="logintxt" type="password2" name="email" placeholder="E-mail adres" required="required"><br><br>
            <input class="logincmd" type="button" onclick="checkggvns()" value="Maak account"><br><br>
        </div>
    </form>
</body>


</html>