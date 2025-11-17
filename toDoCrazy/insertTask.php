<?php

session_start();

if (!$_SESSION['loggedIn']) {
    header('Location:login.php');
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>To-Do List</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 min-h-screen flex items-center justify-center font-sans">
    <div class="bg-white shadow-lg rounded-lg p-8 w-full max-w-md">
        <h1 class="text-3xl font-bold mb-6 text-center text-purple-700">Aggiungi un Task</h1>
        <form action="elencoToDo.php" method="GET" class="space-y-4">
            <!-- Titolo -->
            <div>
                <label for="nome" class="block text-gray-700 font-semibold mb-1">Titolo:</label>
                <input type="text" id="nome" name="nome" placeholder="Scrivi il titolo" class="w-full border border-gray-300 rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-purple-500">
            </div>
            
            <!-- Descrizione -->
            <div>
                <label for="desc" class="block text-gray-700 font-semibold mb-1">Descrizione:</label>
                <textarea id="desc" name="desc" placeholder="Scrivi la descrizione" rows="4" class="w-full border border-gray-300 rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-purple-500"></textarea>
            </div>

            <!-- Pulsante -->
            <div class="text-center">
                <button type="submit" class="bg-purple-500 hover:bg-purple-600 text-white font-bold py-2 px-6 rounded transition">Aggiungi Task</button>
            </div>
        </form>
    </div>
</body>
</html>