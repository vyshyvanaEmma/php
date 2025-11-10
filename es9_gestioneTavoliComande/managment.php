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
    <title>Ordine</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gray-100 font-sans antialiased text-gray-900">

    <div class="max-w-3xl mx-auto p-6 bg-white shadow-lg rounded-lg mt-10">
        <h1 class="text-3xl font-bold text-center text-blue-600 mb-6">
            Il cameriere del vostro tavolo: <?php echo $_SESSION['cameriere'] ?>
        </h1>

        <form action="ordineEffetuato.php" method="POST">

            <!-- piatti -->
            <div class="mb-6">
                <label for="piatti" class="block text-gray-800 text-lg font-semibold mb-3">I piatti e le
                    bevande:</label>
                <div class="grid grid-cols-2 sm:grid-cols-3 lg:grid-cols-4 gap-4">

                    <div class="flex items-center space-x-2">
                        <input type="checkbox" id="pizza" name="piatti[]" value="Pizza"
                            class="form-checkbox text-blue-600">
                        <span>Pizza</span>
                        <input type="number" name="quantita[Pizza]" min="0" value="0" max="999"
                            class="w-16 text-center border border-gray-300 rounded-md" placeholder="Qty">
                    </div>

                    <div class="flex items-center space-x-2">
                        <input type="checkbox" id="pasta" name="piatti[]" value="Pasta"
                            class="form-checkbox text-blue-600">
                        <span>Pasta</span>
                        <input type="number" name="quantita[Pasta]" min="0" value="0" max="999"
                            class="w-16 text-center border border-gray-300 rounded-md" placeholder="Qty">
                    </div>

                    <div class="flex items-center space-x-2">
                        <input type="checkbox" id="patatine" name="piatti[]" value="Patatine"
                            class="form-checkbox text-blue-600">
                        <span>Patatine</span>
                        <input type="number" name="quantita[Patatine]" min="0" value="0" max="999"
                            class="w-16 text-center border border-gray-300 rounded-md" placeholder="Qty">
                    </div>

                    <div class="flex items-center space-x-2">
                        <input type="checkbox" id="gnocchi" name="piatti[]" value="Gnocchi"
                            class="form-checkbox text-blue-600">
                        <span>Gnocchi</span>
                        <input type="number" name="quantita[Gnocchi]" min="0" value="0" max="999"
                            class="w-16 text-center border border-gray-300 rounded-md" placeholder="Qty">
                    </div>

                    <div class="flex items-center space-x-2">
                        <input type="checkbox" id="bistecca" name="piatti[]" value="Bistecca"
                            class="form-checkbox text-blue-600">
                        <span>Bistecca</span>
                        <input type="number" name="quantita[Bistecca]" min="0" value="0" max="999"
                            class="w-16 text-center border border-gray-300 rounded-md" placeholder="Qty">
                    </div>

                    <div class="flex items-center space-x-2">
                        <input type="checkbox" id="insalata" name="piatti[]" value="Insalata"
                            class="form-checkbox text-blue-600">
                        <span>Insalata</span>
                        <input type="number" name="quantita[Insalata]" min="0" value="0" max="999"
                            class="w-16 text-center border border-gray-300 rounded-md" placeholder="Qty">
                    </div>

                    <div class="flex items-center space-x-2">
                        <input type="checkbox" id="branzino" name="piatti[]" value="Branzino"
                            class="form-checkbox text-blue-600">
                        <span>Branzino</span>
                        <input type="number" name="quantita[Branzino]" min="0" value="0" max="999"
                            class="w-16 text-center border border-gray-300 rounded-md" placeholder="Qty">
                    </div>

                    <div class="flex items-center space-x-2">
                        <input type="checkbox" id="tiramisu" name="piatti[]" value="Tiramisu"
                            class="form-checkbox text-blue-600">
                        <span>Tiramisu</span>
                        <input type="number" name="quantita[Tiramisu]" min="0" value="0" max="999"
                            class="w-16 text-center border border-gray-300 rounded-md" placeholder="Qty">
                    </div>

                    <div class="flex items-center space-x-2">
                        <input type="checkbox" id="gelato" name="piatti[]" value="Gelato"
                            class="form-checkbox text-blue-600">
                        <span>Gelato</span>
                        <input type="number" name="quantita[Gelato]" min="0" value="0" max="999"
                            class="w-16 text-center border border-gray-300 rounded-md" placeholder="Qty">
                    </div>

                    <div class="flex items-center space-x-2">
                        <input type="checkbox" id="acqua" name="piatti[]" value="Acqua"
                            class="form-checkbox text-blue-600">
                        <span>Acqua</span>
                        <input type="number" name="quantita[Acqua]" min="0" value="0" max="999"
                            class="w-16 text-center border border-gray-300 rounded-md" placeholder="Qty">
                    </div>

                    <div class="flex items-center space-x-2">
                        <input type="checkbox" id="vino" name="piatti[]" value="Vino"
                            class="form-checkbox text-blue-600">
                        <span>Vino</span>
                        <input type="number" name="quantita[Vino]" min="0" value="0" max="999"
                            class="w-16 text-center border border-gray-300 rounded-md" placeholder="Qty">
                    </div>

                    <div class="flex items-center space-x-2">
                        <input type="checkbox" id="birra" name="piatti[]" value="Birra"
                            class="form-checkbox text-blue-600">
                        <span>Birra</span>
                        <input type="number" name="quantita[Birra]" min="0" value="0" max="999"
                            class="w-16 text-center border border-gray-300 rounded-md" placeholder="Qty">
                    </div>
                </div>
            </div>


            <!-- num tavolo -->
            <div class="mb-6">
                <label for="tables" class="block text-gray-800 text-lg font-semibold mb-3">Numero del tavolo:</label>
                <select name="tables" id="tables" required
                    class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 transition duration-200">
                    <option value="1">Tavolo 1</option>
                    <option value="2">Tavolo 2</option>
                    <option value="3">Tavolo 3</option>
                    <option value="4">Tavolo 4</option>
                    <option value="5">Tavolo 5</option>
                    <option value="6">Tavolo 6</option>
                    <option value="7">Tavolo 7</option>
                    <option value="8">Tavolo 8</option>
                    <option value="9">Tavolo 9</option>
                    <option value="10">Tavolo 10</option>
                    <option value="11">Tavolo 11</option>
                    <option value="12">Tavolo 12</option>
                    <option value="13">Tavolo 13</option>
                    <option value="14">Tavolo 14</option>
                    <option value="15">Tavolo 15</option>
                </select>
            </div>

            <button type="submit"
                class="w-full bg-blue-600 text-white py-3 rounded-lg font-semibold hover:bg-blue-700 transition duration-300">
                Ordina
            </button>
        </form>
    </div>

</body>


</html>