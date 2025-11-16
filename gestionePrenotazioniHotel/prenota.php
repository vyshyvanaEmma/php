<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Prenotazione</title>
</head>

<body>
    <h1>Prenotazione</h1>
    <form action="gestisci_prenot.php" method="POST">
        <div>
            <label for="nome">Nome:</label>
            <input type="text" id="nome" name="nome" required oninput="validateForm()">
        </div>
        <div>
            <label for="cognome">Cognome:</label>
            <input type="text" id="cognome" name="cognome" required oninput="validateForm()">
        </div>
        <div>
            <label for="email">Email:</label>
            <input type="email" id="email" name="email" required oninput="validateForm()">
        </div>
        <div>
            <label for="tables">Numero di persone:</label>  
            <select name="tables" id="tables" required onchange="validateForm()">
                <option value="1">1</option>
                <option value="2">2</option>
                <option value="3">3</option>
                <option value="4">4</option>
                <option value="5">5</option>
                <option value="6">6</option>
            </select>
        </div>
        <div>
            <label for="data_checkin">Data Check-in:</label>
            <input type="date" id="data_checkin" name="data_checkin" required onchange="validateForm()">
        </div>
        <div>
            <label for="data_checkout">Data Check-out:</label>
            <input type="date" id="data_checkout" name="data_checkout" required onchange="validateForm()">
        </div>
        <div>
            <label for="tipo_camera">Tipo di Camera:</label>
            <select id="tipo_camera" name="tipo_camera" required onchange="validateForm()">
                <option value="singola">Singola</option>
                <option value="doppia">Doppia</option>
                <option value="suite">Suite</option>
            </select>
        </div>
        <div class="servizi-extra">
            <p>Servizi Extra</p>

            <div class="servizio-option">
                <label>
                    <input type="checkbox" name="servizi[]" value="colazione" onchange="validateForm()">
                    Colazione in camera - €15 per persona/giorno
                </label>
            </div>

            <div class="servizio-option">
                <label>
                    <input type="checkbox" name="servizi[]" value="spa" onchange="validateForm()">
                    Accesso SPA - €25 per persona/giorno
                </label>
            </div>

            <div class="servizio-option">
                <label>
                    <input type="checkbox" name="servizi[]" value="garage" onchange="validateForm()">
                    Parcheggio garage - €10 per giorno
                </label>
            </div>

            <div class="servizio-option">
                <label>
                    <input type="checkbox" name="servizi[]" value="wifi" onchange="validateForm()">
                    WiFi Premium - €5 per giorno
                </label>
            </div>

            <div class="servizio-option">
                <label>
                    <input type="checkbox" name="servizi[]" value="cena" onchange="validateForm()">
                    Cena a lume di candela - €40 per coppia
                </label>
            </div>
        </div>
        <div>
            <input
                id="submitButton"
                type="submit"
                value="Invia"
                disabled>
        </div>
    </form>
    <script>
        function validateForm() {
            const nome = document.getElementById('nome').value.trim();
            const cognome = document.getElementById('cognome').value.trim();
            const email = document.getElementById('email').value;
            const tables = document.getElementById('tables').value;
            const dataCheckin = document.getElementById('data_checkin').value;
            const dataCheckout = document.getElementById('data_checkout').value;
            const tipoCamera = document.getElementById('tipo_camera').value;
            const submitButton = document.getElementById('submitButton');

            if (nome && email && cognome && tables && dataCheckin && dataCheckout && tipoCamera) {
                submitButton.disabled = false;
            } else {
                submitButton.disabled = true;
            }
        }
        document.addEventListener('DOMContentLoaded', validateForm);
    </script>
</body>

</html>