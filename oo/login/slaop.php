<?php
$gebruikersnaam = $_POST['gebruikersnaam'];
$wachtwoord = hash("sha256", $_POST["wachtwoord"]);
$voornaam = $_POST['voornaam'];
$achternaam = $_POST['achternaam'];
$email = $_POST['email'];

$dbc = Mysqli_connect('localhost', 'admin_jvdwilt', 'PgPaGa6r1s', 'admin_jvdwilt');
$query = "INSERT INTO flow2accounts(gebruikersnaam, wachtwoord, voornaam, achternaam, email) VALUES('$gebruikersnaam','$wachtwoord','$voornaam','$achternaam','$email')";
mysqli_query($dbc, $query);
mysqli_close($dbc);
?>

<script>
    alert("U kunt nu inloggen!")
    window.open('../index.php', '_self');
</script>
