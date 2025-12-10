<?php include "config.php"; ?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <script src="https://cdn.tailwindcss.com"></script>
    <title>Inserisci Cliente</title>
</head>

<body class="bg-gray-100 p-10">

    <div class="max-w-xl mx-auto bg-white p-6 shadow rounded">

        <h2 class="text-2xl font-bold mb-4">Inserisci Cliente</h2>

        <form method="POST" class="space-y-4">

            <input type="text" name="nome" placeholder="Nome" class="w-full p-2 border rounded" required>
            <input type="text" name="cognome" placeholder="Cognome" class="w-full p-2 border rounded" required>

            <select name="id_rappresentante" class="w-full p-2 border rounded" required>
                <option value="">Seleziona rappresentante</option>
                <?php
                $res = $conn->query("SELECT * FROM rappresentante");
                while ($row = $res->fetch_assoc()) {
                    echo "<option value='{$row['id_rappresentante']}'>{$row['nome']} {$row['cognome']}</option>";
                }
                ?>
            </select>

            <button class="bg-yellow-600 text-white px-4 py-2 rounded">Salva</button>
        </form>

    </div>

    <?php
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $nome = $_POST['nome'];
        $cognome = $_POST['cognome'];
        $id_rep = $_POST['id_rappresentante'];

        $sql = "INSERT INTO cliente (nome, cognome, id_rappresentante)
            VALUES ('$nome', '$cognome', '$id_rep')";

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