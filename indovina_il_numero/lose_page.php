<?php
session_start();

if (!isset($_SESSION['finishGame']) || !$_SESSION['perso']) {
    header("Location: play.php");
    exit();
}

if (isset($_POST['newPlay'])) {
    session_destroy();
    header("Location: play.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="it">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Perso</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-red-100 flex items-center justify-center min-h-screen">

    <div class="bg-white p-8 rounded-lg shadow-lg w-full max-w-md text-center">
        <h1 class="text-3xl font-bold text-red-600 mb-6">Spiacente, hai superato il numero massimo di tentativi!</h1>

        <form method="POST">
            <button type="submit" name="newPlay" value="1"
                class="bg-blue-600 text-white py-2 px-4 rounded-lg hover:bg-blue-700 transition duration-300">
                Gioca di nuovo
            </button>
        </form>
    </div>

</body>

</html>