<?php
session_start();
if(isset($_SESSION["prenotazioni"])){
    $_SESSION["prenotazioni"] = [];
}
header("Location: gestionecampo.php");

?>