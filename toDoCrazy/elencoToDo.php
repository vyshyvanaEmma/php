<?php
session_start();

if (!$_SESSION['loggedIn']) {
    header('Location:login.php');
}

if(!isset($_SESSION["tasks"])){
    $_SESSION["tasks"] = [];
}
if(empty($_GET["nome"]) && empty($_GET["desc"])){
    header('Location:insertTask.php');
}
if (isset($_GET["nome"]) && isset($_GET["desc"])) {
    $nome = $_GET["nome"];
    $desc = $_GET["desc"];

    $task = [
        "nome" => $nome,
        "desc" => $desc,
        "id" => uniqid()
    ];

    $_SESSION["tasks"][] = $task;
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Elenco Crazy</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 min-h-screen font-sans">
    <div class="container mx-auto py-10">
        <h1 class="text-4xl font-bold text-center mb-10 text-purple-700">Elenco dei Task</h1>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            <?php foreach($_SESSION["tasks"] as $task): ?>
                <form action="./removeTask.php" method="POST" class="bg-white shadow-md rounded-lg p-6 flex flex-col justify-between">
                    <input type="hidden" name="id" value="<?= htmlspecialchars($task['id']) ?>">
                    <div>
                        <h2 class="text-2xl font-semibold mb-2 text-gray-800"><?= htmlspecialchars($task["nome"]) ?></h2>
                        <p class="text-gray-600"><?= htmlspecialchars($task["desc"]) ?></p>
                    </div>
                    <button type="submit" class="mt-4 bg-red-500 hover:bg-red-600 text-white font-bold py-2 px-4 rounded transition">Cancella Task</button>
                </form>
            <?php endforeach; ?>
        </div>

        <div class="mt-10 text-center">
            <a href="./svuotaCrazy.php" class="bg-blue-500 hover:bg-blue-600 text-white font-bold py-2 px-6 rounded transition">Svuota Lista</a>
        </div>
    </div>
</body>
</html>