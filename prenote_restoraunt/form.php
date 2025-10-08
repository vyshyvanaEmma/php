<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Form client</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gray-100 flex items-center justify-center min-h-screen">

    <?php
    if (empty($food)) {
        ("Inserisci almeno un piatto");
    }
    ?>
    <form action="managePrenotation.php" method="POST" class="bg-white p-8 rounded-lg shadow-lg w-full max-w-lg space-y-6" onchange="validateForm()">
        <div class="space-y-4">
            <div>
                <label for="name" class="block text-gray-700 font-semibold">Nome:</label>
                <input type="text" id="name" name="name" required class="mt-1 w-full px-3 py-2 border rounded focus:outline-none focus:ring-2 focus:ring-blue-400">
            </div>
            <div>
                <label for="surname" class="block text-gray-700 font-semibold">Cognome:</label>
                <input type="text" id="surname" name="surname" required class="mt-1 w-full px-3 py-2 border rounded focus:outline-none focus:ring-2 focus:ring-blue-400">
            </div>
        </div>

        <div class="space-y-4">
            <div>
                <label for="tables" class="block text-gray-700 font-semibold">Numero del tavolo:</label>
                <select name="tables" id="tables" required class="mt-1 w-full px-3 py-2 border rounded focus:outline-none focus:ring-2 focus:ring-blue-400">
                    <option value="1">1</option>
                    <option value="2">2</option>
                    <option value="3">3</option>
                    <option value="4">4</option>
                    <option value="5">5</option>
                </select>
            </div>
            <div>
                <label for="time" class="block text-gray-700 font-semibold">Orario:</label>
                <input type="time" id="time" name="time" required class="mt-1 w-full px-3 py-2 border rounded focus:outline-none focus:ring-2 focus:ring-blue-400">
            </div>
        </div>

        <div>
            <label for="note" class="block text-gray-700 font-semibold">Note:</label>
            <textarea name="note" id="note" rows="3" class="mt-1 w-full px-3 py-2 border rounded focus:outline-none focus:ring-2 focus:ring-blue-400"></textarea>
        </div>

        <div>
            <span class="block text-gray-700 font-semibold mb-2">Scelta del cibo:</span>
            <div class="flex space-x-4">
                <label class="flex items-center space-x-2">
                    <input type="checkbox" name="food[]" value="Antipasto" class="accent-blue-500">
                    <span>Antipasto</span>
                </label>
                <label class="flex items-center space-x-2">
                    <input type="checkbox" name="food[]" value="Primo" class="accent-blue-500">
                    <span>Primo</span>
                </label>
                <label class="flex items-center space-x-2">
                    <input type="checkbox" name="food[]" value="Secondo" class="accent-blue-500">
                    <span>Secondo</span>
                </label>
            </div>
        </div>

        <div>
            <span class="block text-gray-700 font-semibold mb-2">Parcheggio:</span>
            <div class="space-y-2">
                <label class="flex items-center space-x-2">
                    <input type="radio" id="parkS" name="parking" value="parkS" required class="accent-blue-500">
                    <span>Parcheggio custodito</span>
                </label>
                <label class="flex items-center space-x-2">
                    <input type="radio" id="park" name="parking" value="park" class="accent-blue-500">
                    <span>Parcheggio non custodito</span>
                </label>
                <label class="flex items-center space-x-2">
                    <input type="radio" id="noPark" name="parking" value="noPark" class="accent-blue-500">
                    <span>Non uso il parcheggio</span>
                </label>
            </div>
        </div>

        <div>
            <input
                id="submibutton"
                type="submit"
                value="Invia"
                class="w-full bg-blue-500 text-white font-bold py-2 px-4 rounded hover:bg-blue-600 transition disabled:bg-blue-300 disabled:cursor-not-allowed"
                disabled>
        </div>
    </form>

    <script>
        function validateForm() {
            const name = document.getElementById('name').value.trim();
            const surname = document.getElementById('surname').value.trim();
            const tables = document.getElementById('tables').value;
            const time = document.getElementById('time').value;
            const food = document.querySelectorAll('input[name="food[]"]:checked');
            const parking = document.querySelector('input[name="parking"]:checked');
            const submitButton = document.getElementById('submibutton');

            if (name && surname && tables && time && food.length > 0 && parking) {
                submitButton.disabled = false;
            } else {
                submitButton.disabled = true;
            }
        }
    </script>
</body>

</html>