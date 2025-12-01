<?php
session_start();

$error = "";

if (empty($_SESSION['nome']) || empty($_SESSION['cognome']) || empty($_SESSION['data_nascita']) || empty($_SESSION['cod_fisc']) || empty($_SESSION['citta']) || empty($_SESSION['email']) || empty($_SESSION['tel'])) {
    $error = "Non sono stati inseriti tutti i dati";
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Riepilogo dei dati</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body>
    <div class="min-h-screen bg-gray-50 flex items-center justify-center p-6">
        <div class="bg-white shadow-md rounded-lg p-8 w-full max-w-md">
            <h1 class="text-2xl font-semibold mb-6 text-gray-800">Riepilogo Dati</h1>

            <?php if (!empty($error)): ?>
                <div class="bg-red-100 border border-red-200 text-red-700 px-4 py-3 rounded mb-4">
                    <?php echo htmlspecialchars($error); ?>
                </div>
            <?php else: ?>
                <div>
                    <h2 class="text-xl font-semibold text-gray-700 mb-4">Dati anagrafici:</h2>
                    <p><strong>Nome:</strong> <?php echo htmlspecialchars($_SESSION['nome']); ?></p>
                    <p><strong>Cognome:</strong> <?php echo htmlspecialchars($_SESSION['cognome']); ?></p>
                    <p><strong>Data di nascita:</strong> <?php echo htmlspecialchars($_SESSION['data_nascita']); ?></p>
                    <p><strong>Codice Fiscale:</strong> <?php echo htmlspecialchars($_SESSION['cod_fisc']); ?></p>
                    <p><strong>Città:</strong> <?php echo htmlspecialchars($_SESSION['citta']); ?></p>
                </div>

                <div class="mt-4">
                    <h2 class="text-xl font-semibold text-gray-700 mb-4">Dati di contatto:</h2>
                    <p><strong>Email:</strong> <?php echo htmlspecialchars($_SESSION['email']); ?></p>
                    <p><strong>Telefono:</strong> <?php echo htmlspecialchars($_SESSION['tel']); ?></p>
                </div>

                <div class="pt-4">
                    <a href="contact_dates.php" class="w-full bg-indigo-600 text-white py-2 rounded-md hover:bg-indigo-700 transition text-center block">
                        Modifica Dati
                    </a>
                </div>
            <?php endif; ?>
        </div>
    </div>
</body>

</html>
