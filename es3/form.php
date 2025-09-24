<!DOCTYPE html>
<html>
<head>
    <title>Materia Preferita</title>
</head>
<body>
    <form action="risposta.php" method="post">
        <label for="nome">Nome:</label>
        <input type="text" id="nome" name="nome" required><br><br>

        <label for="cognome">Cognome:</label>
        <input type="text" id="cognome" name="cognome" required><br><br>

        <p>Materia preferita:</p>
        <input type="radio" id="informatica" name="materia" value="Informatica" required>
        <label for="informatica">Informatica</label><br>
        <input type="radio" id="sistemi" name="materia" value="Sistemi e Reti">
        <label for="sistemi">Sistemi e Reti</label><br>
        <input type="radio" id="tpsit" name="materia" value="TPSIT">
        <label for="tpsit">TPSIT</label><br><br>

        <input type="submit" value="Invia">
    </form>
</body>
</html>