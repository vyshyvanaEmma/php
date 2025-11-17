<?php 
session_start();
if ($_SESSION["loggedIn"] == false || empty($_SESSION["user"])) {
    header("Location: login.php");
    exit();
}

if (isset($_GET['id']) && isset($_SESSION["prenotazioni"])) {
    $id = $_GET['id'];
    
    if (isset($_SESSION["prenotazioni"][$id])) {
        unset($_SESSION["prenotazioni"][$id]);
    }
}

header("Location: gestionecampo.php");
exit();
?>