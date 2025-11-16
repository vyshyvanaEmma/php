<?php
    session_start();
    if (!$_SESSION['loggedIn']) {
        header('Location:login.php');
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home page</title>
</head>
<body>
    <h1>Benvenuto <?php echo $_SESSION["utente"] ?></h1>
    <a href="./prenota.php">Prenota</a>
    <hr>
    <a href="./riepilogo.php">Riepilogo</a>
    <hr>
    <a href="./logout.php">Logout</a>
</body>
</html>