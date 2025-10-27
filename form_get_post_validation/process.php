<?php
// Funzione per sanificare l'input
function sanitize_input($data) {
    $data = trim($data);                // Rimuove spazi bianchi iniziali e finali
    $data = stripslashes($data);        // Rimuove backslash
    $data = htmlspecialchars($data, ENT_QUOTES, 'UTF-8');    // Converte caratteri speciali (anti-XSS)
    return $data;
}

$name = isset($_POST['name']) ? sanitize_input($_POST['name']) : '';
$email = isset($_POST['email']) ? sanitize_input($_POST['email']) : '';
$message = isset($_POST['message']) ? sanitize_input($_POST['message']) : '';

$errors = [];

if ($_SERVER["REQUEST_METHOD"] === "POST" && !empty($_POST)) {
    if (empty($name)) {
        $errors[] = "Il nome e' obbligatorio.";
    } elseif (!preg_match("/^[a-zA-ZÀ-ÿ\s]+$/u", $name)) {
        $errors[] = "Il nome puo' contenere solo lettere e spazi.";
    }

    if (empty($email)) {
        $errors[] = "L'email e' obbligatoria.";
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors[] = "Formato email non valido.";
    }

    if (strlen($message) > 300) {
        $errors[] = "Il messaggio non può superare 300 caratteri.";
    }

    echo '<!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Risultato</title>
        <script src="https://cdn.tailwindcss.com"></script>
    </head>
    <body class="bg-gray-100 flex items-center justify-center min-h-screen flex-col space-y-6">
    ';

    if (empty($errors)) {
        echo "
        <div class='bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-4' role='alert'>
            <strong class='font-bold'>Successo!</strong>
            <span class='block'>Dati ricevuti correttamente.</span>
        </div>

        <div class='bg-white shadow-md rounded p-6'>
            <h2 class='text-lg font-semibold text-gray-800 mb-4'>Dettagli inviati:</h2>
            <ul class='list-disc list-inside text-gray-700 space-y-1'>
                <li><span class='font-medium text-gray-900'>Nome:</span> $name</li>
                <li><span class='font-medium text-gray-900'>Email:</span> $email</li>
                <li><span class='font-medium text-gray-900'>Messaggio:</span> $message</li>
            </ul>
        </div>
        ";
        header("Location: thankyou.php");
    } else {
        echo "
        <div class='bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mb-4' role='alert'>
            <strong class='font-bold'>Errore!</strong>
            <span class='block mb-2'>Si sono verificati alcuni problemi:</span>
            <ul class='list-disc list-inside text-red-700'>";

                foreach ($errors as $error) {
                    echo "<li>$error</li>";
                }

        echo "</ul>
        </div>
        ";
    }

    echo "
    <a href='form.php' class='bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600 transition'>Torna al form</a>
    </body>
    </html>";


}
?>
