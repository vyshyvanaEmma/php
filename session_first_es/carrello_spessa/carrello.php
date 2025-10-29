<?php
session_start();

$prodotti = [
    1 => ['nome' => 'Maglia', 'prezzo' => 19.99],
    2 => ['nome' => 'Jeans', 'prezzo' => 39.99],
    3 => ['nome' => 'Felpa', 'prezzo' => 29.99],
    4 => ['nome' => 'Scarpe', 'prezzo' => 59.99],
];

if (isset($_POST['id_prodotto']) && isset($prodotti[$_POST['id_prodotto']])) {
    $id = $_POST['id_prodotto'];
    if (!isset($_SESSION['carrello']))
        $_SESSION['carrello'] = [];
    if (isset($_SESSION['carrello'][$id])) {
        $_SESSION['carrello'][$id]['quantita']++;
    } else {
        $_SESSION['carrello'][$id] = [
            'nome' => $prodotti[$id]['nome'],
            'prezzo' => $prodotti[$id]['prezzo'],
            'quantita' => 1
        ];
    }
}

// Incrementa o decrementa quantità
if (isset($_POST['azione'], $_POST['id'])) {
    $id = $_POST['id'];
    if (isset($_SESSION['carrello'][$id])) {
        if ($_POST['azione'] === 'incrementa') {
            $_SESSION['carrello'][$id]['quantita']++;
        } elseif ($_POST['azione'] === 'decrementa') {
            $_SESSION['carrello'][$id]['quantita']--;
            if ($_SESSION['carrello'][$id]['quantita'] <= 0) {
                unset($_SESSION['carrello'][$id]);
            }
        }
    }
}

if (isset($_POST['azione']) && $_POST['azione'] === 'svuota') {
    unset($_SESSION['carrello']);
}

$totale = 0;
if (!empty($_SESSION['carrello'])) {
    foreach ($_SESSION['carrello'] as $item) {
        $totale += $item['prezzo'] * $item['quantita'];
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Carrello</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gray-100 p-8">

    <h1 class="text-3xl font-bold mb-6">Carrello</h1>

    <?php if (!empty($_SESSION['carrello'])): ?>
        <div class="bg-white p-6 rounded shadow mb-6">
            <table class="w-full text-left border-collapse">
                <thead>
                    <tr>
                        <th class="border-b py-2">Prodotto</th>
                        <th class="border-b py-2">Prezzo</th>
                        <th class="border-b py-2">Quantità</th>
                        <th class="border-b py-2">Totale</th>
                        <th class="border-b py-2">Azioni</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($_SESSION['carrello'] as $id => $item): ?>
                        <tr>
                            <td class="py-2"><?= htmlspecialchars($item['nome']) ?></td>
                            <td class="py-2">€<?= number_format($item['prezzo'], 2) ?></td>
                            <td class="py-2"><?= $item['quantita'] ?></td>
                            <td class="py-2">€<?= number_format($item['prezzo'] * $item['quantita'], 2) ?></td>
                            <td class="py-2 flex gap-2">
                                <form method="POST" class="inline">
                                    <input type="hidden" name="id" value="<?= $id ?>">
                                    <input type="hidden" name="azione" value="incrementa">
                                    <button type="submit"
                                        class="bg-green-600 text-white px-2 py-1 rounded hover:bg-green-700 transition">
                                        +
                                    </button>
                                </form>
                                <form method="POST" class="inline">
                                    <input type="hidden" name="id" value="<?= $id ?>">
                                    <input type="hidden" name="azione" value="decrementa">
                                    <button type="submit"
                                        class="bg-yellow-500 text-white px-2 py-1 rounded hover:bg-yellow-600 transition">
                                        -
                                    </button>
                                </form>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>

            <div class="mt-4 text-right font-bold text-lg">
                Totale: €<?= number_format($totale, 2) ?>
            </div>

            <form method="POST" class="mt-4">
                <input type="hidden" name="azione" value="svuota">
                <button type="submit" class="bg-red-600 text-white px-4 py-2 rounded hover:bg-red-700 transition">
                    Svuota carrello
                </button>
            </form>

            <form method="GET" action="prodotti.php" class="mt-4 inline-block ml-4">
                <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700 transition">
                    Continua lo shopping
                </button>
            </form>

            <form method="GET" action="checkout.php" class="mt-4 inline-block ml-4">
                <button type="submit" class="bg-purple-600 text-white px-4 py-2 rounded hover:bg-purple-700 transition">
                    Checkout
                </button>
            </form>
        </div>
    <?php else: ?>
        <p class="text-gray-700">Il carrello è vuoto.</p>
    <?php endif; ?>

</body>

</html>