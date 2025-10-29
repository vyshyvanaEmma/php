<?php
session_start();

// Se non ci sono prodotti nel carrello, reindirizza a prodotti.php
if (!isset($_SESSION['carrello']) || empty($_SESSION['carrello'])) {
    header("Location: prodotti.php");
    exit();
}

// Calcolo totale
$totale = 0;
foreach ($_SESSION['carrello'] as $item) {
    $totale += $item['prezzo'] * $item['quantita'];
}

// Se l'utente conferma l'ordine
$ordine_confermato = false;
if (isset($_POST['conferma'])) {
    $ordine_confermato = true;
    unset($_SESSION['carrello']); // svuota il carrello
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Checkout</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 p-8">

<h1 class="text-3xl font-bold mb-6">Checkout</h1>

<?php if ($ordine_confermato): ?>
    <div class="bg-white p-6 rounded shadow">
        <h2 class="text-2xl font-semibold mb-4">Grazie per il tuo ordine!</h2>
        <p class="text-gray-700">Il tuo ordine è stato confermato con successo.</p>
        <form action="prodotti.php" method="GET" class="mt-6">
            <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700 transition">
                Torna ai prodotti
            </button>
        </form>
    </div>
<?php else: ?>
    <div class="bg-white p-6 rounded shadow mb-6">
        <h2 class="text-2xl font-semibold mb-4">Riepilogo ordine</h2>
        <table class="w-full text-left border-collapse">
            <thead>
                <tr>
                    <th class="border-b py-2">Prodotto</th>
                    <th class="border-b py-2">Prezzo</th>
                    <th class="border-b py-2">Quantità</th>
                    <th class="border-b py-2">Totale</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($_SESSION['carrello'] as $item): ?>
                    <tr>
                        <td class="py-2"><?= htmlspecialchars($item['nome']) ?></td>
                        <td class="py-2">€<?= number_format($item['prezzo'], 2) ?></td>
                        <td class="py-2"><?= $item['quantita'] ?></td>
                        <td class="py-2">€<?= number_format($item['prezzo'] * $item['quantita'], 2) ?></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>

        <div class="mt-4 text-right font-bold text-lg">
            Totale ordine: €<?= number_format($totale, 2) ?>
        </div>

        <form method="POST" class="mt-6">
            <button type="submit" name="conferma" class="bg-green-600 text-white px-4 py-2 rounded hover:bg-green-700 transition">
                Conferma ordine
            </button>
        </form>

        <form action="carrello.php" method="GET" class="mt-4">
            <button type="submit" class="bg-yellow-500 text-white px-4 py-2 rounded hover:bg-yellow-600 transition">
                Torna al carrello
            </button>
        </form>
    </div>
<?php endif; ?>

</body>
</html>
