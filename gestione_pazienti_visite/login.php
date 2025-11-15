<?php
    session_start();

    $_SESSION['infermiere'] = "";
    $_SESSION['loggedIn'] = false;

    $usernameMaria = "Maria Rossi";
    $passwordMaria = "pass1234";
    $usernameDaria = "Daria Fabbri";
    $passwordDaria = "pass1234";
    $usernameEmma = "Emma Rossi";
    $passwordEmma = "pass1234";

if(isset($_POST['username']) && isset($_POST['password'])){
    if (($_POST['username'] == $usernameMaria && $_POST['password'] == $passwordMaria) || 
        ($_POST['username'] == $usernameDaria && $_POST['password'] == $passwordDaria) || 
        ($_POST['username'] == $usernameEmma && $_POST['password'] == $passwordEmma)) {
            $_SESSION['loggedIn'] = true;
            $_SESSION['infermiere'] = $_POST['username'];

            $_SESSION["pazienti"] = [];

            header('Location:dashboard.php');
        } else{
            $_SESSION['loggedIn'] = false;
            $error = 'Credenziali non valide';
        }
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login page</title>
</head>
<body>
    <form method="POST">
        <div>
            <label for="username">Nome utente</label>
            <input type="text" id="username" name="username" required>
        </div>
        <div>
            <label for="password">Password</label>
            <input type="password" id="password" name="password" required>
        </div>
        <button type="submit">
            Accedi
        </button>
    </form>
    <?php 
    if(!empty($error)){
        echo "<div style='color:red'> $error</div>";
    }
    ?>
</body>
</html>