<?php
$waiters = [
    'Francesco Perrotta',
    'Gioele Piemontese',
    'Mateo Casini',
    'Cristiano Nesti',
    'Francesco Pantani'
];

$waiter = $waiters[array_rand($waiters)];

$name = $_POST['name'];
$surname = $_POST['surname'];
$numTable = $_POST['tables'];
$time = $_POST['time'];
$note = $_POST['note'];
$food = isset($_POST['food']) ? $_POST['food'] : [];
$parking = $_POST['parking'];

// error only antipasto
$errorAntipasto = '';
if (
    in_array("Antipasto", $food) &&
    !in_array("Primo", $food) &&
    !in_array("Secondo", $food)
) {
    $errorAntipasto = "Non puoi ordinare solo antipasto.";
}

$antipasto = 5;
$primo = 6;
$secondo = 7;

$scontoPS = 10;
$scontoT = 15;

$parkSecure = 5;
$parkNotSecure = 3;

$prezzo = 0;

//price
if (in_array("Antipasto", $food)) {
    $prezzo += $antipasto;
}
if (in_array("Primo", $food)) {
    $prezzo += $primo;
}
if (in_array("Secondo", $food)) {
    $prezzo += $secondo;
}
// discounts
if (in_array("Antipasto", $food) && in_array("Primo", $food) && in_array("Secondo", $food)) {
    $prezzo = $prezzo - ($prezzo * $scontoT / 100);
} elseif (in_array("Primo", $food) && in_array("Secondo", $food)) {
    $prezzo = $prezzo - ($prezzo * $scontoPS / 100);
}

// add parking to price
if ($parking == "parkS") {
    $prezzo += $parkSecure;
} elseif ($parking == "park") {
    $prezzo += $parkNotSecure;
}

$timePrenotation = date("d-m-Y H:i:s");
?>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Prenotation</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 flex items-center justify-center min-h-screen">
    <div class="w-full max-w-4xl mx-auto mt-8">
        <table class="min-w-full bg-white rounded-lg shadow overflow-hidden">
            <thead class="bg-blue-500 text-white">
                <tr>
                    <th class="py-3 px-4 text-left">Nome</th>
                    <th class="py-3 px-4 text-left">Cognome</th>
                    <th class="py-3 px-4 text-left">Numero del tavolo</th>
                    <th class="py-3 px-4 text-left">Orario</th>
                    <th class="py-3 px-4 text-left">Note</th>
                    <th class="py-3 px-4 text-left">Cibo scelto</th>
                    <th class="py-3 px-4 text-left">Parcheggio</th>
                    <th class="py-3 px-4 text-left">Cameriere assegnato</th>
                    <th class="py-3 px-4 text-left">Prezzo</th>
                    <th class="py-3 px-4 text-left">Data</th>
                </tr>
            </thead>
            <tbody>
                <tr class="border-t">
                    <td class="py-2 px-4"><?php echo htmlspecialchars($name); ?></td>
                    <td class="py-2 px-4"><?php echo htmlspecialchars($surname); ?></td>
                    <td class="py-2 px-4"><?php echo htmlspecialchars($numTable); ?></td>
                    <td class="py-2 px-4"><?php echo htmlspecialchars($time); ?></td>
                    <td class="py-2 px-4"><?php echo htmlspecialchars($note); ?></td>
                    <td class="py-2 px-4"><?php echo htmlspecialchars(implode(", ", $food)); ?></td>
                    <td class="py-2 px-4"><?php echo htmlspecialchars($parking); ?></td>
                    <td class="py-2 px-4"><?php echo htmlspecialchars($waiter); ?></td>
                    <td class="py-2 px-4 font-bold text-blue-600"><?php echo number_format($prezzo, 2); ?> €</td>
                    <td class="py-2 px-4"><?php echo $timePrenotation; ?></td>
                </tr>
            </tbody>
        </table>
        
        <!--show error antipasto-->
        <?php if ($errorAntipasto): ?>
            <div class="mt-6 text-red-500 font-semibold text-lg text-center">
                <?php echo $errorAntipasto; ?>
            </div>
        <?php endif; ?>
    </div>
</body>
</html>