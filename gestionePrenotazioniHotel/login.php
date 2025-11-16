<?php
session_start();

if (!isset($_SESSION["utenti"])) {
    $_SESSION["utenti"] = [];
}

$error = "";
$_SESSION['loggedIn'] = false;
$_SESSION['utente'] = "";

if (isset($_POST["username"]) && isset($_POST["password"])) {
    $username = $_POST["username"];
    $password = $_POST["password"];
    
    if (isset($_SESSION["utenti"][$username])) {
        if (password_verify($password, $_SESSION["utenti"][$username])) {
            $_SESSION["utenti_logato"] = $username;
            $_SESSION['utente'] = $_POST['username'];
            $_SESSION["loggedIn"] = true;   
            header("Location: home.php");
        } else {
            $error = "Password non valida";
        }
    } else {
        $error = "Nessun utente registrato con questo username";
    }
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
    <form method="POST">
        <div>
            <label for="username" id="username" name="username">Inserisci nome utente</label>
             <input type="text" id="username" name="username" required>
        </div>
        <div>
            <label for="password" id="password" name="password">Inserisci password</label>
            <input type="password" id="password" name="password" required>
        </div>
        <div>
            <button type="submit">Accedi</button>
        </div>
    </form>
    <?php if (!empty($error) && $error == "Nessun utente registrato con questo username"): ?>
        <p><?php echo $error; ?></p>
        <a href="./registrazione.php">Registrati</a>
    <?php endif; ?>
    <?php if (!empty($error) && !($error == "Nessun utente registrato con questo username")): ?>
        <p><?php echo $error; ?></p>
    <?php endif; ?>
</body>

</html>