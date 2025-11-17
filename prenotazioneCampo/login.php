<?php

session_start();


$_SESSION["utenti"] = [
    "Paolo" => "paolo123",
    "Luca" => "luca456",
    "Emma" => "emma789",
];


$_SESSION["loggedIn"] = false;
$error = "";

if (isset($_POST["username"]) && isset($_POST["password"])) {
    $username = $_POST["username"];
    $password = $_POST["password"];

    foreach ($_SESSION["utenti"] as $usern => $pwd) {
        if ($username == $usern && $password == $pwd) {
            $_SESSION["loggedIn"] = true;
            $_SESSION["user"] = $usern;
            header("Location: gestionecampo.php");
            exit();
        }
    }
    $error = "Username o password non validi";
} else {
    $error = "Inserisci username e password";
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
</head>

<body>
    <h1>Gestione delle Prenotazioni di un Campo Sportivo</h1>
    <h2>Login</h2>
    <form method="POST">
        <label for="username">Inserisci il nome dell'utente</label>
        <input type="text" id="username" name="username" required>
        <label for="password">Inserisci la password dell'utente</label>
        <input type="password" id="password" name="password" required>
        <button type="submit">Accedi</button>
    </form>
    <?php if (!empty($error)) {
        echo $error;
    } ?>
</body>

</html>