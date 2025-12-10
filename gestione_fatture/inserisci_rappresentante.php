<?php include "config.php"; ?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <script src="https://cdn.tailwindcss.com"></script>
    <title>Inserisci Rappresentante</title>
</head>

<body class="bg-gray-100 p-10">

    <div class="max-w-xl mx-auto bg-white p-6 shadow rounded">

        <h2 class="text-2xl font-bold mb-4">Inserisci Rappresentante</h2>

        <form method="POST" class="space-y-4">

            <input type="text" name="nome" placeholder="Nome" class="w-full p-2 border rounded" required>
            <input type="text" name="cognome" placeholder="Cognome" class="w-full p-2 border rounded" required>

            <select name="id_categoria" class="w-full p-2 border rounded" required>
                <option value="">Seleziona categoria</option>
                <?php
                $res = $conn->query("SELECT * FROM categoria_rappresentante");
                while ($row = $res->fetch_assoc()) {
                    echo "<option value='{$row['id_categoria']}'>{$row['nome_categoria']}</option>";
                }
                ?>
            </select>

            <button class="bg-green-600 text-white px-4 py-2 rounded">Salva</button>
        </form>

    </div>

    <?php
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $nome = $_POST['nome'];
        $cognome = $_POST['cognome'];
        $cat = $_POST['id_categoria'];

        $sql = "INSERT INTO rappresentante (nome, cognome, id_categoria)
            VALUES ('$nome', '$cognome', '$cat')";

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