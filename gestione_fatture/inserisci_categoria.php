<?php include "config.php"; ?>

<!DOCTYPE html>
<html lang="it">

<head>
    <meta charset="UTF-8">
    <script src="https://cdn.tailwindcss.com"></script>
    <title>Inserisci Categoria</title>
</head>

<body class="bg-gray-100 p-10">

    <div class="max-w-xl mx-auto bg-white p-6 shadow rounded">

        <h2 class="text-2xl font-bold mb-4">Inserisci Categoria Rappresentante</h2>

        <form method="POST" class="space-y-4">
            <input type="text" name="nome_categoria" placeholder="Nome categoria" class="w-full p-2 border rounded" required>
            <input type="number" step="0.01" name="costo" placeholder="Costo" class="w-full p-2 border rounded" required>

            <button class="bg-blue-600 text-white px-4 py-2 rounded">Salva</button>
        </form>

    </div>

    <?php
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $nome = $_POST['nome_categoria'];
        $costo = $_POST['costo'];

        $sql = "INSERT INTO categoria_rappresentante (nome_categoria, costo)
            VALUES ('$nome', '$costo')";

        if ($conn->query($sql)) {
            header("Location: index.php");
            exit();
        } else {
            echo "<p class='text-red-600 mt-4 text-center'>Errore: " . $conn->error . "</p>";
        }
    }
    ?>

</body>

</html>