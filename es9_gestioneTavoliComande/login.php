<?php
session_start();

$_SESSION['loggedIn'] = false;
$_SESSION['cameriere'] = "";

$passwordMinutilo = "forzaNapoli1234";
$usernameA = "antonio";
$passwordGiani = "dioPerdonaGianiNo";
$usernameGianni = "paolo";
$passwordGiuse = "ioSonoUnaMacchina";
$usernameGiuse = "giuseppina";

if (isset($_POST['username']) && isset($_POST['password'])) {
    if (($_POST['username'] == $usernameA && $_POST['password'] == $passwordMinutilo) || ($_POST['username'] == $usernameGianni && $_POST['password'] == $passwordGiani) || ($_POST['username'] == $usernameGiuse && $_POST['password'] == $passwordGiuse)) {
        $_SESSION['cameriere'] = $_POST['username'];
        $_SESSION['loggedIn'] = true;
        header('Location:managment.php');
    } else {
        $_SESSION['loggedIn'] = false;
        $error = 'Credenziali non validi';
    }
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class=" flex flex-col justify-center items-center h-screen bg-white shadow-lg rounded-lg w-full">
    <h1 class="text-3xl font-bold text-center text-blue-600 mb-6">Login</h1>
    <form method="POST" class="space-y-5">
        <div>
            <label for="username" class="block text-gray-700 font-medium mb-1">Username</label>
            <input type="text" id="username" name="username" required
                class="w-full px-3 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-400" />
        </div>

        <div>
            <label for="password" class="block text-gray-700 font-medium mb-1">Password</label>
            <input type="password" id="password" name="password" required
                class="w-full px-3 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-400" />
        </div>

        <button type="submit"
            class="w-full bg-blue-600 text-white py-2 rounded-lg font-semibold hover:bg-blue-700 transition duration-200">
            Accedi
        </button>
    </form>

    <?php if (!empty($error)): ?>
    <div id="alert" class="mb-4 flex items-start gap-3 bg-red-50 border border-red-200 text-red-700 rounded-lg p-3">
        <svg class="w-6 h-6 flex-shrink-0 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"
            xmlns="http://www.w3.org/2000/svg">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                d="M12 8v4m0 4h.01M21 12A9 9 0 1112 3a9 9 0 019 9z"></path>
        </svg>

        <div class="flex-1">
            <p class="font-semibold">Errore</p>
            <p class="text-sm"><?php echo htmlspecialchars($error, ENT_QUOTES); ?></p>
        </div>

        <button id="closeAlert" class="text-red-500 hover:text-red-700" aria-label="Chiudi">
            &times;
        </button>
    </div>
    <?php endif; ?>

</body>

</html>