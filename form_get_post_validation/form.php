<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Form client</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gray-100 flex items-center justify-center min-h-screen">
    <?php

    //the same for post
    function sanitize_input($data) {
        $data = trim($data);                // Rimuove spazi bianchi iniziali e finali
        $data = stripslashes($data);        // Rimuove backslash
        $data = htmlspecialchars($data);    // Converte caratteri speciali (anti-XSS)
        return $data;
    }

    $name = isset($_GET['name']) ? sanitize_input($_GET['name']) : '';
    $email = isset($_GET['email']) ? sanitize_input($_GET['email']) : '';
    $message = isset($_GET['message']) ? sanitize_input($_GET['message']) : '';

    $errors = [];

    if ($_SERVER["REQUEST_METHOD"] === "GET" && !empty($_GET)) {
        if (empty($name)) {
            $errors[] = "Il nome e' obbligatorio.";
        } elseif (!preg_match("/^[a-zA-Z\s]+$/", $name)) {
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
    }
    ?>
    <!-- result with get: http://localhost/php/form_get_post_validation/getForm.php?name=FDDFs&email=girasoleerika%40gmail.com&message=fdsfds-->
    <!-- result with post: http://localhost/php/form_get_post_validation/getForm.php -->
    <form action="<?= htmlspecialchars($_SERVER["PHP_SELF"]); ?>"  method="GET" class="bg-white p-8 rounded-lg shadow-lg w-full max-w-lg space-y-6" oninput="validateForm()">
        <div class="space-y-4">
            <div>
                <label class="block text-gray-700 font-semibold">Nome: </label>
                <input type="text" inputmode="text" pattern="^[a-zA-Z\s]+$" mode id="name" name="name" required class="mt-1 w-full px-3 py-2 border rounded focus:outline-none focus:ring-2 focus:ring-blue-400">
            </div>
            <div>
                <label class="block text-gray-700 font-semibold">Email: </label>
                <input type="text" id="email" name="email" required class="mt-1 w-full px-3 py-2 border rounded focus:outline-none focus:ring-2 focus:ring-blue-400">
            </div>
            <div>
                <label class="block text-gray-700 font-semibold">Messaggio: </label>
                <input type="text" id="message" name="message" maxlength="300" class="mt-1 w-full px-3 py-2 border rounded focus:outline-none focus:ring-2 focus:ring-blue-400">
            </div>
        </div>

        <div>
            <input
                id="submitButton"
                type="submit"
                value="Invia"
                class="w-full bg-blue-500 text-white font-bold py-2 px-4 rounded hover:bg-blue-600 transition disabled:bg-blue-300 disabled:cursor-not-allowed"
                disabled>
        </div>
    </form>

    <script>
        function validateForm() {
            const name = document.getElementById('name').value.trim();
            const email = document.getElementById('email').value;
            const message = document.getElementById('message').value;
            const submitButton = document.getElementById('submitButton');

            if (name && email) {
                submitButton.disabled = false;
            } else {
                submitButton.disabled = true;
            }
        }
    </script>
</body>

</html>