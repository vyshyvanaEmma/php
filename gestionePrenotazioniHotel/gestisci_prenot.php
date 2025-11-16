<?php
session_start();

if (!isset($_SESSION["utenti_logato"])) {
    header("Location: login.php");
    exit;
}

if ($_SERVER["REQUEST_METHOD"] != "POST") {
    header("Location: prenota.php");
    exit;
}

$nome = htmlspecialchars(trim($_POST["nome"]));
$cognome = htmlspecialchars(trim($_POST["cognome"]));
$email = htmlspecialchars(trim($_POST["email"]));
$persone = intval($_POST["tables"]);
$camera = $_POST["tipo_camera"];
$checkin = $_POST["data_checkin"];
$checkout = $_POST["data_checkout"];

switch ($camera) {
    case "singola":
        $prezzo_camera = 80;
        break;
    case "doppia":
        $prezzo_camera = 120;
        break;
    case "suite":
        $prezzo_camera = 200;
        break;
    default:
        $prezzo_camera = 0;
}

$data_checkin = new DateTime($checkin);
$data_checkout = new DateTime($checkout);
$notti = $data_checkin->diff($data_checkout)->days;

$prezzo_totale_camera = $prezzo_camera * $notti;

$servizi_selezionati = [];
$prezzo_servizi = 0;

if (isset($_POST['servizi'])) {
    $servizi_selezionati = $_POST['servizi'];
    
    foreach ($servizi_selezionati as $servizio) {
        switch ($servizio) {
            case "colazione":
                $prezzo_servizi += 15 * $persone * $notti;
                break;
            case "spa":
                $prezzo_servizi += 25 * $persone * $notti;
                break;
            case "garage":
                $prezzo_servizi += 10 * $notti;
                break;
            case "wifi":
                $prezzo_servizi += 5 * $notti;
                break;
            case "cena":
                $prezzo_servizi += 40 * ceil($persone / 2);
                break;
        }
    }
}

$prezzo_totale = $prezzo_totale_camera + $prezzo_servizi;

$prenotazione = [
    "id" => uniqid(),
    "nome" => $nome,
    "cognome" => $cognome,
    "email" => $email,
    "persone" => $persone,
    "camera" => $camera,
    "servizi_extra" => $servizi_selezionati,
    "checkin" => $checkin,
    "checkout" => $checkout,
    "notti" => $notti,
    "prezzo_camera" => $prezzo_totale_camera,
    "prezzo_servizi" => $prezzo_servizi,
    "prezzo_totale" => $prezzo_totale,
    "data_prenotazione" => date('Y-m-d H:i:s')
];

if (!isset($_SESSION["prenotazioni"])) {
    $_SESSION["prenotazioni"] = [];
}

$_SESSION["prenotazioni"][] = $prenotazione;

header("Location: riepilogo.php");
exit;

?>