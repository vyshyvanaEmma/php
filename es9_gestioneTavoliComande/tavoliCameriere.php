<?php
session_start();
$piatti = $_SESSION["piatti"];
$quantita = $_SESSION["quantita"];
$numTavopli = $_SESSION['tavolo'];
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tavoli del cameriere</title>
</head>

<body>
    <h1 class="text-3xl font-semibold text-blue-600 mb-6">I tuoi tavoli</h1>

</body>

</html>