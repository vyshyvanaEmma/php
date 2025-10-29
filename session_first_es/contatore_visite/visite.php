<?php
session_start();

// contatore
if (!isset($_SESSION['contatore'])) {
    $_SESSION['contatore'] = 1;
} else {
    $_SESSION['contatore'] += 1;
}

// reset
if (isset($_POST['azzera'])) {
    session_unset();
    header("Location: visite.php");
}
?>

<!DOCTYPE html>
<html lang="it">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contatore visite</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gray-100 flex items-center justify-center min-h-screen">
    <div class="bg-white p-8 rounded shadow-lg text-center w-80">
        <h2 class="text-2xl font-bold mb-4 text-gray-800">Contatore di visite</h2>
        <p class="text-gray-700 mb-6">
            Hai visitato questa pagina <span
                class="font-semibold text-blue-600"><?php echo $_SESSION['contatore']; ?></span> volte durante questa
            sessione.
        </p>
        <form method="post">
            <button type="submit" name="azzera"
                class="bg-red-500 hover:bg-red-600 text-white font-bold py-2 px-4 rounded transition-colors duration-200">
                Azzera
            </button>
        </form>
    </div>
</body>

</html>