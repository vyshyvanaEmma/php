<?php
session_start();

$_SESSION['username'] = 'admin';
$_SESSION['password'] = 'admin1234';
if (isset($_POST['username']) && isset($_POST['password'])) {
    if (isset($_POST['username']) && isset($_POST['password'])) {
        if ($_POST['username'] === $_SESSION['username'] && $_POST['password'] === $_SESSION['password']) {
            echo "Login successo";
            header("Location: home.php");
        } else {
            echo "Credenziali non valide";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="it">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gradient-to-br from-blue-100 to-blue-300 flex items-center justify-center min-h-screen">
    <div class="bg-white shadow-xl rounded-lg p-8 w-full max-w-md">
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
    </div>
</body>

</html>