<?php
$conn = mysqli_connect("localhost", "root", "", "gestione_fatture");

if (!$conn) {
    die("Connessione fallita: " . mysqli_connect_error());
}
