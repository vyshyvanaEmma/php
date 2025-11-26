<?php
session_start();
$colori = ["bianco", "blu", "giallo", "nero", "rosso", "verde"];
$lung = 4;
$maxTent = 10;

if (!isset($_SESSION['sequenza'])) {
    $_SESSION['sequenza'] = [];
    for ($i = 0; $i < $lung; $i++) {
        $_SESSION['sequenza'][] = $colori[array_rand($colori)];
    }
    $_SESSION['tentativi'] = -1;
    $_SESSION['storico'] = [];
}

$mes = "";

if (isset($_POST['colore'])) {
    $tentativo = $_POST['colore'];

    if (count($tentativo) == $lung) {
        $_SESSION['tentativi']++;

        $sequenzaC = $_SESSION['sequenza'];
        $tentC = $tentativo;
        $neri = 0;
        $white = 0;

        for ($i = 0; $i < $lung; $i++) {
            if ($tentC[$i] == $sequenzaC[$i]) {
                $neri++;
                unset($tentC[$i]);
                unset($sequenzaC[$i]);
            }
        }

        foreach ($tentC as $c) {
            $pos = array_search($c, $sequenzaC);
            if ($pos !== false) {
                $white++;
                unset($sequenzaC[$pos]);
            }
        }

        $_SESSION['storico'][] = [
            "tentativo" => $tentativo,
            "neri" => $neri,
            "bianchi" => $white
        ];

        if ($neri == $lung) {
            $mes = "<h3 class='text-green-600 font-bold text-xl mt-4'>Hai vinto!</h3>";
            session_destroy();
        } else if ($_SESSION['tentativi'] >= $maxTent) {
            $mes = "<h3 class='text-red-600 font-bold text-xl mt-4'>
                        Hai perso, la sequenza era:
                    </h3><div class='flex gap-2 mt-2'>";
            foreach ($_SESSION['sequenza'] as $c) {
                $mes .= "<img src='$c.gif' width='40' class='rounded shadow'>";
            }
            $mes .= "</div>";
            session_destroy();
        }
    }
}
?>

<!DOCTYPE html>
<html lang="it">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mastermind</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gray-100 min-h-screen p-6 flex flex-col items-center">

    <h1 class="text-3xl font-bold mb-6">Mastermind</h1>

    <div class="bg-white shadow p-4 rounded mb-4 w-full max-w-xl text-center">
        <p class="text-lg font-semibold">
            Tentativi effettuati:
            <span class="text-blue-600"><?= $_SESSION['tentativi'] ?></span>
        </p>
        <p class="text-lg">
            Tentativi rimasti:
            <span class="text-red-600"><?= $maxTent - $_SESSION['tentativi'] ?></span>
        </p>
    </div>


    <form method="POST" class="bg-white p-6 rounded-lg shadow w-full max-w-xl">
        <table class="w-full">
            <tr class="flex gap-4 justify-center">
                <?php for ($i = 0; $i < $lung; $i++): ?>
                    <td>
                        <select name="colore[]" required class="border rounded p-2 bg-gray-50 hover:bg-white">
                            <option value="">--</option>
                            <?php foreach ($colori as $c): ?>
                                <option value="<?= $c ?>"><?= $c ?></option>
                            <?php endforeach; ?>
                        </select>
                    </td>
                <?php endfor; ?>
            </tr>
        </table>

        <button type="submit" class="mt-4 w-full bg-blue-600 hover:bg-blue-700 text-white py-2 rounded">
            Invia tentativo
        </button>
    </form>

    <h3 class="text-xl font-semibold mt-6">Storico tentativi</h3>

    <div class="w-full max-w-xl bg-white p-4 rounded shadow mt-2 space-y-3">
        <?php foreach ($_SESSION['storico'] as $t): ?>
            <div class="flex items-center gap-3">
                <div class="flex gap-2">
                    <?php foreach ($t["tentativo"] as $c): ?>
                        <img src="<?= $c ?>.gif" width="40" class="rounded shadow">
                    <?php endforeach; ?>
                </div>

                <div class="ml-auto">
                    <span class="text-black font-bold"><?= $t["neri"] ?> neri</span>,
                    <span class="text-gray-600"><?= $t["bianchi"] ?> bianchi</span>
                </div>
            </div>
        <?php endforeach; ?>
    </div>

    <div class="mt-4"><?= $mes ?></div>

    <script>
        const sequenza = <?= json_encode($_SESSION['sequenza']); ?>;
        console.log("Sequenza segreta:", sequenza);
    </script>

</body>

</html>