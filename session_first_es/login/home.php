<?php
session_start();

if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true) {
    header("Location: login.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="it">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gradient-to-br from-green-100 to-green-300 flex flex-col items-center justify-center min-h-screen">
    <div class="bg-white shadow-xl rounded-lg p-8 text-center">
        <h1 class="text-3xl font-bold text-green-700 mb-4">
            Benvenuto, <?= htmlspecialchars($_SESSION['username']) ?> 👋
        </h1>
        <form method="POST" action="logout.php">
            <button type="submit"
                class="bg-red-500 text-white px-4 py-2 rounded-lg hover:bg-red-600 transition duration-200">
                Logout
            </button>
        </form>
    </div>
</body>

</html>