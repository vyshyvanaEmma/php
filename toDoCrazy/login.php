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
            header("Location: insertTask.php");
        } else {
            $error = "Password non valida";
        }
    } else {
        $error = "Nessun utente registrato con questo username";
    }
}


?>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gray-100 min-h-screen flex items-center justify-center font-sans">
    <div class="bg-white shadow-lg rounded-lg p-8 w-full max-w-md">
        <h1 class="text-3xl font-bold mb-6 text-center text-purple-700">Login</h1>
        <form method="POST" class="space-y-4">
            <!-- Username -->
            <div>
                <label for="username" class="block text-gray-700 font-semibold mb-1">Nome utente</label>
                <input type="text" id="username" name="username" required
                    class="w-full border border-gray-300 rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-purple-500">
            </div>

            <!-- Password -->
            <div>
                <label for="password" class="block text-gray-700 font-semibold mb-1">Password</label>
                <input type="password" id="password" name="password" required
                    class="w-full border border-gray-300 rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-purple-500">
            </div>

            <!-- Pulsante -->
            <div class="text-center">
                <button type="submit"
                    class="bg-purple-500 hover:bg-purple-600 text-white font-bold py-2 px-6 rounded transition">Accedi</button>
            </div>
        </form>
    </div>
</body>

</html>