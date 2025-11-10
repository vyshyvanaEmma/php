<?php
session_start();

$_SESSION['tavolo'] = $_POST['tables'];

if (isset($_POST['piatti'])) {
    $_SESSION['piatti'] = $_POST['piatti'];
}

if (isset($_POST['quantita'])) {
    $_SESSION['quantita'] = $_POST['quantita'];
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ordine Effetuato</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gray-100 h-screen flex flex-col justify-center items-center">
    <div class="bg-white p-8 rounded-lg shadow-lg max-w-lg w-full text-center">
        <h1 class="text-3xl font-semibold text-blue-600 mb-6">Il tuo ordine è stato effettuato</h1>

        <p class="text-lg text-gray-600 mb-4">Grazie per aver ordinato con noi! Clicca il bottone qui sotto per
            visualizzare i tuoi ordini.</p>

        <form action="tavoliCameriere.php" method="get">
            <button type="submit"
                class="px-6 py-3 bg-blue-600 text-white rounded-lg font-semibold hover:bg-blue-700 transition duration-300">
                Visualizza Ordini
            </button>
        </form>
    </div>
</body>

</html>