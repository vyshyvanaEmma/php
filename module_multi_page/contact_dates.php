<?php
session_start();

$error = "";

if (isset($_POST['email']) && isset($_POST['tel']) && $_POST['email'] !== '' && $_POST['tel'] !== '') {

    // controllo email
    if (!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
        $error .= "L'email inserita non è valida";
    }

    if (empty($error)) {
        $_SESSION['email'] = $_POST['email'];
        $_SESSION['tel'] = $_POST['tel'];

        header("Location: riepilogo.php");
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
    <title>Dati di contatto</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body>
    <div class="min-h-screen bg-gray-50 flex items-center justify-center p-6">
        <div class="bg-white shadow-md rounded-lg p-8 w-full max-w-md">
            <h1 class="text-2xl font-semibold mb-6 text-gray-800">Inserisci i tuoi dati di contatto</h1>

            <?php if (!empty($error) && $_SERVER['REQUEST_METHOD'] === 'POST'): ?>
                <div class="bg-red-100 border border-red-200 text-red-700 px-4 py-3 rounded mb-4">
                    <?php echo htmlspecialchars($error); ?>
                </div>
            <?php endif; ?>

            <form method="POST" class="space-y-4">
                <div>
                    <label for="tel" class="block text-sm font-medium text-gray-700 mb-1">Numero di telefono</label>
                    <input type="tel" id="tel" name="tel" required
                        class="w-full border border-gray-300 rounded-md px-3 py-2 focus:outline-none focus:ring-2 focus:ring-indigo-500"
                        value="<?php echo isset($_SESSION['tel']) ? htmlspecialchars($_SESSION['tel']) : ''; ?>">
                </div>

                <div>
                    <label for="email" class="block text-sm font-medium text-gray-700 mb-1">Email</label>
                    <input type="email" id="email" name="email" required
                        class="w-full border border-gray-300 rounded-md px-3 py-2 focus:outline-none focus:ring-2 focus:ring-indigo-500"
                        value="<?php echo isset($_SESSION['email']) ? htmlspecialchars($_SESSION['email']) : ''; ?>">
                </div>

                <div>
                    <button type="submit"
                        class="w-full bg-indigo-600 text-white py-2 rounded-md hover:bg-indigo-700 transition">Invia</button>
                </div>
            </form>
        </div>
    </div>
</body>

</html>