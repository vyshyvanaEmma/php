<?php
session_start();

if ($_SESSION["loggedIn"] == false || empty($_SESSION["user"])) {
    header("Location: login.php");
    exit();
}

$errore = "";
$prenotazione = [];

if (isset($_GET['id']) && isset($_SESSION["prenotazioni"][$_GET['id']])) {
    $id = $_GET['id'];
    $prenotazione = $_SESSION["prenotazioni"][$id];
}


$prenotazione_aggiornata = [
    "nomeP" => $_POST["nomeP"] ?? "",
    "oraInizio" => $_POST["oraInizio"] ?? "",
    "oraFine" => $_POST["oraFine"] ?? "",
    "tipo" => $_POST["tipo"] ?? ""
];

$oraInizio = $prenotazione_aggiornata["oraInizio"];
$oraFine = $prenotazione_aggiornata["oraFine"];

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
        $_SESSION["prenotazioni"][$id] = $prenotazione_aggiornata;
        header("Location: gestionecampo.php");
        exit();
    }
} else {
    $errore = "Formato orario non valido";
}

$prenotazione = $prenotazione_aggiornata;

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modifica Prenotazione</title>
</head>

<body>
    <h1>Modifica Prenotazione</h1>
    <form action="" method="POST">
        <input type="hidden" name="id" value="<?= $_GET['id'] ?? '' ?>">

        <label for="nomeP">Nome della persona che prenota:</label>
        <input type="text" id="nomeP" name="nomeP" value="<?= htmlspecialchars($prenotazione['nomeP'] ?? '') ?>" required><br><br>

        <label for="oraInizio">Ora Inizio:</label>
        <input type="time" id="oraInizio" name="oraInizio" value="<?= $prenotazione['oraInizio'] ?? '' ?>" required><br><br>

        <label for="oraFine">Ora Fine:</label>
        <input type="time" id="oraFine" name="oraFine" value="<?= $prenotazione['oraFine'] ?? '' ?>" required><br><br>

        <label for="tipo">Tipo di Campo:</label>
        <select id="tipo" name="tipo" required>
            <option value="Calcio" <?= ($prenotazione['tipo'] ?? '') == 'Calcio' ? 'selected' : '' ?>>Calcio</option>
            <option value="Tennis" <?= ($prenotazione['tipo'] ?? '') == 'Tennis' ? 'selected' : '' ?>>Tennis</option>
            <option value="Pallavolo" <?= ($prenotazione['tipo'] ?? '') == 'Pallavolo' ? 'selected' : '' ?>>Pallavolo</option>
            <option value="Basket" <?= ($prenotazione['tipo'] ?? '') == 'Basket' ? 'selected' : '' ?>>Basket</option>
            <option value="Padel" <?= ($prenotazione['tipo'] ?? '') == 'Padel' ? 'selected' : '' ?>>Padel</option>
        </select><br><br>

        <button type="submit">Salva Modifiche</button>
        <a href="gestionecampo.php">Annulla</a>
    </form>

    <?php if (!empty($errore)) {
        echo $errore;
    } ?>
</body>

</html>