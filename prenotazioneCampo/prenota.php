<?php
session_start();

if ($_SESSION["loggedIn"] == false || empty($_SESSION["user"])) {
    header("Location: login.php");
    exit();
}

$errore = "";

// AGGIUNGI QUESTO CONTROLLO - ESEGUI SOLO SE IL FORM È STATO INVIATO
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $prenotazione = [
        "nomeP" => $_POST["nomeP"] ?? "",
        "oraInizio" => $_POST["oraInizio"] ?? "",
        "oraFine" => $_POST["oraFine"] ?? "",
        "tipo" => $_POST["tipo"] ?? ""
    ];

    // controllo tempi durata
    $oraInizio = $prenotazione["oraInizio"];
    $oraFine = $prenotazione["oraFine"];

    $inizio = DateTime::createFromFormat('H:i', $oraInizio);
    $fine = DateTime::createFromFormat('H:i', $oraFine);

    if ($inizio && $fine) {
        if ($inizio >= $fine) {
            $errore = "L'ora di inizio deve essere precedente all'ora di fine";
        } else {
            $diff = $inizio->diff($fine);
            $oreTot = $diff->h + ($diff->i / 60);

            if ($oreTot > 6) {
                $errore = "La durata non può superare le 6 ore";
            }
        }

        if (empty($errore)) {
            if (!isset($_SESSION["prenotazioni"])) {
                $_SESSION["prenotazioni"] = [];
            }
            $_SESSION["prenotazioni"][] = $prenotazione;
            header("Location: gestionecampo.php");
            exit(); // AGGIUNGI ANCHE exit() DOPO header
        }
    } else {
        $errore = "Formato orario non valido";
    }
}
// FINE DEL CONTROLLO POST
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Prenotazione</title>
</head>
<body>
    <h1>Aggiungi la prenotazione</h1>
    <form action="" method="POST">
        <label for="nomeP">Nome della persona che prenota:</label>
        <input type="text" id="nomeP" name="nomeP" required><br><br>

        <label for="oraInizio">Ora Inizio:</label>
        <input type="time" id="oraInizio" name="oraInizio" required><br><br>

        <label for="oraFine">Ora Fine:</label>
        <input type="time" id="oraFine" name="oraFine" required><br><br>

        <label for="tipo">Tipo di Campo:</label>
        <select id="tipo" name="tipo" required>
            <option value="Calcio">Calcio</option>
            <option value="Tennis">Tennis</option>
            <option value="Pallavolo">Pallavolo</option>
            <option value="Basket">Basket</option>
            <option value="Padel">Padel</option>
        </select><br><br>
        <button type="submit">Prenota</button>
    </form>
    <?php if (!empty($errore)) {
        echo $errore;
    } ?>
</body>
</html>