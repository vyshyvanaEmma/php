<?php
session_start();

if (!isset($_SESSION['loggedIn']) || !$_SESSION['loggedIn']) {
    header('Location: login.php');
    exit();
}

$cameriere = $_SESSION['cameriere'];
$piattiDisponibili = ["Pizza","Pasta","Patatine","Gnocchi","Bistecca","Insalata","Branzino","Tiramisu","Gelato","Acqua","Vino","Birra"];

if (isset($_POST['modifica_tavolo'])) {
    $numTavolo = $_POST['modifica_tavolo'];

    if (isset($_POST['piatti'])) {
        $piatti = $_POST['piatti'];
    } else {
        $piatti = array();
    }

    if (isset($_POST['quantita'])) {
        $quantita = $_POST['quantita'];
    } else {
        $quantita = array();
    }

    if (!isset($_SESSION['ordini'])) {
        $_SESSION['ordini'] = array();
    }
    if (!isset($_SESSION['ordini'][$cameriere])) {
        $_SESSION['ordini'][$cameriere] = array();
    }

    $_SESSION['ordini'][$cameriere][$numTavolo] = array(
        'piatti' => $piatti,
        'quantita' => $quantita
    );
}

if (isset($_SESSION['ordini'][$cameriere])) {
    $tavoli = $_SESSION['ordini'][$cameriere];
} else {
    $tavoli = array();
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tavoli del cameriere</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gray-100 font-sans antialiased text-gray-900 p-6">
    <h1 class="text-3xl font-bold text-blue-600 mb-6">Tavoli di <?php echo htmlspecialchars($cameriere); ?></h1>

    <?php
    if (empty($tavoli)) {
        echo "<p class='text-gray-700'>Non ci sono ordini al momento.</p>";
    } else {
        for ($i = 1; $i <= 15; $i++) {
            if (isset($tavoli[$i])) {
                $ordine = $tavoli[$i];
                echo "<div class='bg-white p-4 rounded-lg shadow-md mb-4'>";
                echo "<h2 class='text-xl font-semibold text-gray-800 mb-2'>Tavolo $i</h2>";
                
                echo "<form method='POST'>";
                foreach ($piattiDisponibili as $piatto) {
                    $checked = in_array($piatto, $ordine['piatti']) ? "checked" : "";
                    $qty = isset($ordine['quantita'][$piatto]) ? intval($ordine['quantita'][$piatto]) : 0;
                    echo "<div class='flex items-center space-x-2 mb-1'>";
                    echo "<input type='checkbox' name='piatti[]' value='$piatto' $checked>";
                    echo "<span>$piatto</span>";
                    echo "<input type='number' name='quantita[$piatto]' min='0' value='$qty' class='w-16 text-center border rounded'>";
                    echo "</div>";
                }

                echo "<input type='hidden' name='modifica_tavolo' value='$i'>";
                echo "<button type='submit' class='mt-2 px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700'>Aggiorna Ordine</button>";
                echo "</form>";
                echo "</div>";
            }
        }
    }
    ?>

</body>
</html>