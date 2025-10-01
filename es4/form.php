<!DOCTYPE html>
<html>
<head>
    <title>Dati cliente</title>
</head>
<body>
    <?php
        $totale_utenti = isset($_POST['totale_utenti']) ? (int)$_POST['totale_utenti'] : 0;
        $guadagno_totale = isset($_POST['guadagno_totale']) ? (float)$_POST['guadagno_totale'] : 0;
    ?>
    <form action="rispostaPrezzo.php" method="post">
        <label for="nome">Nome:</label>
        <input type="text" id="nome" name="nome" required><br><br>

        <label for="cognome">Età:</label>
        <input type="text" id="eta" name="eta" required><br><br>

        <p>Dati cliente:</p>
        <input type="radio" id="mensile" name="pagamento" value="Mensile" required>
        <label for="informatica">Mensile</label><br>
        <input type="radio" id="bimestrale" name="pagamento" value="Bimestrale">
        <label for="sistemi">Bimestrale</label><br>
        <input type="radio" id="trimestrale" name="pagamento" value="Trimestrale">
        <label for="tpsit">Trimestrale</label><br>
        <input type="radio" id="annuale" name="pagamento" value="Annuale">
        <label for="tpsit">Annuale</label><br><br>

        <input type="hidden" name="totale_utenti" value="<?php echo $totale_utenti; ?>">
        <input type="hidden" name="guadagno_totale" value="<?php echo $guadagno_totale; ?>">

        <input type="submit" value="Invia">


    </form>
    <hr>
        <h3>Statistiche attuali</h3>
        <p>Totale utenti: <?php echo $totale_utenti; ?></p>
        <p>Guadagno totale: <?php echo number_format($guadagno_totale, 2); ?> €</p>
</body>
</html>