<!DOCTYPE html>
<html>

<head>
    <title>Form Prezzo</title>
    <style>
    table,
    th,
    td {
        border: 1px solid black;
        border-collapse: collapse;
        padding: 8px;
    }
    </style>
</head>

<body>
    <?php
session_start();
$output = "";
$prezzo = 0;

if (isset($_POST['nome']) && isset($_POST['eta']) && isset($_POST['pagamento'])) {
    $nome = htmlspecialchars($_POST['nome']);
    $eta = (int)$_POST['eta'];
    $pagamento = htmlspecialchars($_POST['pagamento']);
    if ($eta < 18 || $eta > 64) {
        $prezzo = 35;
    }
    else if ($eta >= 18 && $eta <= 64) {
        $prezzo = 45;
    }
    else {
        $output = "Età non valida";
    }

    if ($output === "") {
        switch ($pagamento) {
            case "Mensile":
                break;
            case "Bimestrale":
                $prezzo = $prezzo * 2 * 0.90; // 10% di sconto
                break;
            case "Trimestrale":
                $prezzo = $prezzo * 3 * 0.85; // 15% di sconto
                break;
            case "Annuale":
                $prezzo = $prezzo * 12 * 0.80; // 20% di sconto
                break;
            default:
                $output = "Opzione di pagamento non valida";
        }
    }

    if ($output === "") {
        $output = "Il prezzo {$pagamento} è di " . number_format($prezzo, 2) . "€";
        $_SESSION["inc"]++;
        $_SESSION["gTot"] += $prezzo;
    }
}
else {
    $output = "Dati mancanti";
    $nome = $pagamento = $eta = "";
}
?>

    <table>
        <tr>
            <th>Nome</th>
            <th>Età</th>
            <th>Pagamento</th>
            <th>Risultato</th>
        </tr>
        <tr>
            <td><?php echo $nome; ?></td>
            <td><?php echo $eta; ?></td>
            <td><?php echo $pagamento; ?></td>
            <td><?php echo $output; ?></td>
        </tr>
    </table>
    <form action="form.php" method="post">
        <input type="submit" value="Torna al form">
    </form>
</body>

</html>