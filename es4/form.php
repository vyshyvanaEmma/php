<!DOCTYPE html>
<html>

<head>
    <title>Dati cliente</title>
</head>

<body>
    <?php
        session_start();
        if(!isset($_SESSION["inc"])){
            $_SESSION["inc"] = 0;
        }
        if(!isset($_SESSION["gTot"])){
            $_SESSION["gTot"] = 0;
        }
    ?>
    <form action="rispostaPrezzo.php" method="post">
        <label for="nome">Nome:</label>
        <input type="text" id="nome" name="nome" required><br><br>

        <label for="cognome">Età:</label>
        <input type="number" id="eta" name="eta" min="0" max="100" required><br><br>

        <p>Dati cliente:</p>
        <input type="radio" id="mensile" name="pagamento" value="Mensile" required>
        <label for="informatica">Mensile</label><br>
        <input type="radio" id="bimestrale" name="pagamento" value="Bimestrale">
        <label for="sistemi">Bimestrale</label><br>
        <input type="radio" id="trimestrale" name="pagamento" value="Trimestrale">
        <label for="tpsit">Trimestrale</label><br>
        <input type="radio" id="annuale" name="pagamento" value="Annuale">
        <label for="tpsit">Annuale</label><br><br>

        <input type="submit" value="Invia">


    </form>
    <hr>
    <p>Totale utenti: <?php echo $_SESSION["inc"]; ?></p>
    <p>Guadagno totale: <?php echo $_SESSION["gTot"]; ?> €</p>
</body>

</html>