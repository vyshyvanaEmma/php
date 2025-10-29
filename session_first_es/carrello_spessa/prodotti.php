<?php
$prodotti = [
    1 => ['nome' => 'Maglia', 'prezzo' => 19.99],
    2 => ['nome' => 'Jeans', 'prezzo' => 39.99],
    3 => ['nome' => 'Felpa', 'prezzo' => 29.99],
    4 => ['nome' => 'Scarpe', 'prezzo' => 59.99],
];
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Prodotti</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body>
    <form action="carrello.php" method="POST">
        <h1 class="text-3xl font-bold mb-6">Prodotti</h1>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            <?php foreach ($prodotti as $id => $prodotto): ?>
                <div class="bg-white p-6 rounded shadow">
                    <h2 class="text-xl font-semibold"><?= htmlspecialchars($prodotto['nome']) ?></h2>
                    <p class="text-gray-700 mb-4">Prezzo: €<?= number_format($prodotto['prezzo'], 2) ?></p>
                    <form action="carrello.php" method="POST">
                        <input type="hidden" name="id_prodotto" value="<?= $id ?>">
                        <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700 transition">
                            Aggiungi al carrello
                        </button>
                    </form>
                </div>
            <?php endforeach; ?>
        </div>
    </form>
</body>

</html>