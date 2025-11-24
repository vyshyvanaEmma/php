<?php
session_start();

if (!isset($_SESSION['tentativoNum']))
    $_SESSION['tentativoNum'] = 1;
if (!isset($_SESSION['vinto']))
    $_SESSION['vinto'] = false;
if (!isset($_SESSION['perso']))
    $_SESSION['perso'] = false;
if (!isset($_SESSION['numero']))
    $_SESSION['numero'] = rand(0, 99);
if (!isset($_SESSION['finishGame']))
    $_SESSION['finishGame'] = false;

$error = "";
$consiglio = "";

if (isset($_POST['num'])) {
    $num = (int) $_POST['num'];

    if ($_SESSION['tentativoNum'] > 4) {
        $_SESSION['perso'] = true;
        $_SESSION['finishGame'] = true;
        header("Location: lose_page.php");
        exit();
    }

    if ($num === $_SESSION['numero']) {
        $_SESSION['vinto'] = true;
        $_SESSION['finishGame'] = true;
        header("Location: win_page.php");
        exit();
    } else {
        if($num > $_SESSION['numero']){
            $consiglio = "Il numero è troppo grande";
        }else{
            $consiglio = "Il numero è troppo piccolo";
        }
        $_SESSION['tentativoNum']++;
    }
} else{
    $error = "Il numero non è stato inserito";
}
?>
<!DOCTYPE html>
<html lang="it">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Indovina il numero</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gray-100 flex items-center justify-center min-h-screen">
    <div class="bg-white p-8 rounded-lg shadow-lg w-full max-w-sm">
        <form method="POST">
            <h1 class="text-3xl font-bold text-center text-blue-600 mb-4">Indovina Numero</h1>
            <h3 class="text-center text-lg text-gray-700 mb-4">Numero dei tentativi massimo: 5</h3>
            <p class="text-center text-gray-600 mb-6">Devi indovinare il numero tra 0 e 99 in 5 tentativi</p>

            <?php if ($error): ?>
                <div class="bg-red-500 text-white text-sm p-2 rounded mb-4">
                    <?= $error ?>
                </div>
            <?php endif; ?>

            <p class="text-center text-gray-700 mb-4">Tentativo: <?= $_SESSION['tentativoNum'] ?></p>

            <?php if ($consiglio): ?>
                <p class="text-center text-yellow-600 mb-4"><?= $consiglio ?></p>
            <?php endif; ?>

            <div class="mb-4">
                <input type="number" id="num" name="num" min="0" max="99" required
                    class="w-full p-2 border-2 border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
            </div>
            <div class="text-center">
                <button type="submit"
                    class="bg-blue-600 text-white py-2 px-4 rounded-lg hover:bg-blue-700 transition duration-300">Tenta</button>
            </div>
        </form>
    </div>

    <script>
        console.log(<?= $_SESSION['numero'] ?>);
    </script>
</body>

</html>