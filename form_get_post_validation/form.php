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
            echo "<div style='color: green; font-weight: bold;'>Dati ricevuti correttamente</div>";
            echo "<ul>";
            echo "<li>Nome: $name</li>";
            echo "<li>Email: $email</li>";
            echo "<li>Messaggio: $message</li>";
            echo "</ul>";
        } else {
            echo "<div style='color: red; font-weight: bold;'>Errore:</div>";
            echo "<ul>";
            foreach ($errors as $error) {
                echo "<li>$error</li>";
            }
            echo "</ul>";
        }
    }
    ?>
    <!-- result with get: http://localhost/php/form_get_post_validation/getForm.php?name=FDDFs&email=girasoleerika%40gmail.com&message=fdsfds-->
    <!-- result with post: http://localhost/php/form_get_post_validation/getForm.php -->
    <form action="getForm.php" method="POST" class="bg-white p-8 rounded-lg shadow-lg w-full max-w-lg space-y-6" oninput="validateForm()">
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