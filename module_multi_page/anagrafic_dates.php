<?php

session_start();

$error = "";

if (isset($_POST['nome']) && isset($_POST['cognome']) && isset($_POST['data_nascita']) && isset($_POST['cod_fisc']) && isset($_POST['citta'])) {
    $_SESSION['nome'] = $_POST['nome'];
    $_SESSION['cognome'] = $_POST['cognome'];

    // controllo data di nascita
    $oggi = new DateTime();
    $data_nascita_o = new DateTime($_POST['data_nascita']);
    if ($data_nascita_o > $oggi) {
        $error .= "La data di nascita non può essere nel futuro";
    }

    $data_limite = (new DateTime())->modify('-200 years');
    if ($data_nascita_o < $data_limite) {
        $error .= "La data di nascita non può essere più di 200 anni fa";
    }

    $_SESSION['data_nascita'] = $_POST['data_nascita'];

    // controllo codice fiscale
    if (strlen($_POST['cod_fisc']) != 16 || !preg_match('/^[A-Z0-9]{16}$/', $_POST['cod_fisc'])) {
        $error .= "Il codice fiscale deve essere di 16 caratteri alfanumerici";
    }

    $_SESSION['cod_fisc'] = $_POST['cod_fisc'];
    $_SESSION['citta'] = $_POST['citta'];

    if (empty($error)) {
        header("Location: contact_dates.php");
        exit;
    }
} else {
    $error = "Inserisci tutti i dati";
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dati anagrafici</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body>
    <div class="min-h-screen bg-gray-50 flex items-center justify-center p-6">
        <div class="bg-white shadow-md rounded-lg p-8 w-full max-w-md">
            <h1 class="text-2xl font-semibold mb-6 text-gray-800">Inserisci i tuoi dati anagrafici</h1>

            <?php if (!empty($error) && $_SERVER['REQUEST_METHOD'] === 'POST'): ?>
                <div class="bg-red-100 border border-red-200 text-red-700 px-4 py-3 rounded mb-4">
                    <?php echo htmlspecialchars($error); ?>
                </div>
            <?php endif; ?>

            <form method="POST" class="space-y-3">
                <div>
                    <label for="nome" class="block text-sm font-medium text-gray-700 mb-1">Nome</label>
                    <input type="text" id="nome" name="nome" required
                        class="w-full border border-gray-300 rounded-md px-3 py-2 focus:outline-none focus:ring-2 focus:ring-indigo-500"
                        value="<?php echo isset($_POST['nome']) ? htmlspecialchars($_POST['nome']) : ''; ?>">
                </div>

                <div>
                    <label for="cognome" class="block text-sm font-medium text-gray-700 mb-1">Cognome</label>
                    <input type="text" id="cognome" name="cognome" required
                        class="w-full border border-gray-300 rounded-md px-3 py-2 focus:outline-none focus:ring-2 focus:ring-indigo-500"
                        value="<?php echo isset($_POST['cognome']) ? htmlspecialchars($_POST['cognome']) : ''; ?>">
                </div>

                <div>
                    <label for="data_nascita" class="block text-sm font-medium text-gray-700 mb-1">Data di
                        nascita</label>
                    <input type="date" id="data_nascita" name="data_nascita" required
                        class="w-full border border-gray-300 rounded-md px-3 py-2 focus:outline-none focus:ring-2 focus:ring-indigo-500"
                        value="<?php echo isset($_POST['data_nascita']) ? htmlspecialchars($_POST['data_nascita']) : ''; ?>">
                </div>

                <div>
                    <label for="cod_fisc" class="block text-sm font-medium text-gray-700 mb-1">Codice fiscale</label>
                    <input type="text" id="cod_fisc" name="cod_fisc" required
                        class="w-full border border-gray-300 rounded-md px-3 py-2 focus:outline-none focus:ring-2 focus:ring-indigo-500"
                        value="<?php echo isset($_POST['cod_fisc']) ? htmlspecialchars($_POST['cod_fisc']) : ''; ?>">
                </div>

                <div>
                    <label for="citta" class="block text-sm font-medium text-gray-700 mb-1">Città</label>
                    <input type="text" id="citta" name="citta" required
                        class="w-full border border-gray-300 rounded-md px-3 py-2 focus:outline-none focus:ring-2 focus:ring-indigo-500"
                        value="<?php echo isset($_POST['citta']) ? htmlspecialchars($_POST['citta']) : ''; ?>">
                </div>

                <div class="pt-4">
                    <button type="submit"
                        class="w-full bg-indigo-600 text-white py-2 rounded-md hover:bg-indigo-700 transition">Invia</button>
                </div>
            </form>
        </div>
    </div>
</body>

</html>