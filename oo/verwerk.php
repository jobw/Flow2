<?php
    session_start();

    $gebruikersnaam = $_POST["gebruikersnaam"];
    $wachtwoord = hash("sha256", $_POST["wachtwoord"]);

    $dbc=Mysqli_connect('');
    $query="SELECT * FROM '' WHERE ''='$gebruikersnaam' and ''='$wachtwoord'";

    $result=mysqli_query($dbc,$query);

    if (mysqli_num_rows($result)==1){
        $row=mysqli_fetch_array($result);
        $_SESSION['ingelogd']=true;
        $_SESSION['inlogfoutcode']=false;
        $_SESSION['userggvns'] = $row;
        header('location:home/');
    }else{
        $_SESSION['inlogfoutcode']=true;
    }
    mysqli_close($dbc);

    $_SESSION['userggvns']['gebruikersnaam'];
?>