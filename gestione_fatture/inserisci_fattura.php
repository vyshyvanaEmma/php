<?php include "config.php"; ?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <script src="https://cdn.tailwindcss.com"></script>
    <title>Inserisci Fattura</title>
</head>

<body class="bg-gray-100 p-10">

    <div class="max-w-xl mx-auto bg-white p-6 shadow rounded">

        <h2 class="text-2xl font-bold mb-4">Inserisci Fattura</h2>

        <form method="POST" class="space-y-4">

            <select name="id_cliente" class="w-full p-2 border rounded" required>
                <option value="">Seleziona cliente</option>
                <?php
                $res = $conn->query("SELECT * FROM cliente");
                while ($row = $res->fetch_assoc()) {
                    echo "<option value='{$row['id_cliente']}'>{$row['nome']} {$row['cognome']}</option>";
                }
                ?>
            </select>

            <input type="date" name="data_fattura" class="w-full p-2 border rounded" required>
            <input type="number" step="0.01" name="importo_totale" placeholder="Importo" class="w-full p-2 border rounded" required>

            <button class="bg-purple-600 text-white px-4 py-2 rounded">Salva</button>
        </form>

    </div>

    <?php
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $id_cliente = $_POST['id_cliente'];
        $data = $_POST['data_fattura'];
        $importo = $_POST['importo_totale'];

        $sql = "INSERT INTO fattura (id_cliente, data_fattura, importo_totale)
            VALUES ('$id_cliente', '$data', '$importo')";

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