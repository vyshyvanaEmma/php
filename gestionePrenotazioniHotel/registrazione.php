<?php
session_start();

if (!isset($_SESSION["utenti"])) {
    $_SESSION["utenti"] = [];
}

$username = "";
$message = "";

if (isset($_POST["username"]) && isset($_POST["password"])) {
    $username = trim($_POST["username"]);
    $password = trim($_POST["password"]);
    if (empty($username) || empty($password)) {
        $message = "Inserisci sia username che password";
    } elseif (isset($_SESSION["utenti"][$username])) {
        $message = "Utente già registrato";
    } else {
        $_SESSION["utenti"][$username] = password_hash($password, PASSWORD_BCRYPT);
        $username = "";
        header("Location: login.php");
        exit(); 
    }
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registrazione</title>
</head>
<body>
    <form method="POST" action="">
        <div>
            <label for="username">Inserisci nome utente</label>
            <input type="text" id="username" name="username" value="<?php echo htmlspecialchars($username); ?>" required>
        </div>
        <div>
            <label for="password">Inserisci password</label>
            <input type="password" id="password" name="password" required>
        </div>
        <div>
            <button type="submit">Registrati</button>
        </div>
    </form>
    
    <?php if (!empty($message)): ?>
        <?php echo htmlspecialchars($message); ?>
    <?php endif; ?>
    
    <p>Hai già un account? <a href="login.php">Accedi qui</a></p>
</body>
</html>