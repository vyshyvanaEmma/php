<?php
session_start();

if (!isset($_SESSION["prenotazioni"]) || !is_array($_SESSION["prenotazioni"])) {
    $_SESSION["prenotazioni"] = [];
}

if ($_SESSION["loggedIn"] == false || empty($_SESSION["user"])) {
    header("Location: login.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Prenotazioni</title>
</head>

<body>
    <h1>Benvenuto <?= $_SESSION["user"] ?></h1>
    <h3>Prenotazioni: </h3>
    <?php
    if (!empty($_SESSION["prenotazioni"])) {
        foreach ($_SESSION["prenotazioni"] as $index => $prenotazione) {
            echo "<form method='POST'>";
            echo "<p>Nome: " . $prenotazione["nomeP"] . " - Ora: " . $prenotazione["oraInizio"] . " - " . $prenotazione["oraFine"] . " | " . $prenotazione["tipo"] . "</p>";
            echo "<button type='submit' formaction='cancella.php?id=$index'>Cancella</button>";
            echo "<button type='submit' formaction='modifica.php?id=$index'>Modifica</button>";
            echo "</form>";
        }
    } else {
        echo "<p>Nessuna prenotazione effettuata.</p>";
    }
    ?>
    <br>
    <a href="prenota.php">Aggiungi Prenotazione</a>
    <br>
    <a href="svuotaLista.php">Svuota lista</a>
    <br>
    <a href="logout.php">Logout</a>
</body>

</html>