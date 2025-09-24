<!DOCTYPE html>
<html>
<head>
    <title>Risposta Materia</title>
</head>
<body>
    <?php
        if (isset($_POST['nome']) && isset($_POST['cognome']) && isset($_POST['materia'])) {
            $nome = htmlspecialchars($_POST['nome']);
            $cognome = htmlspecialchars($_POST['cognome']);
            $materia = htmlspecialchars($_POST['materia']);
            echo "la materia preferita di $nome $cognome è $materia";
        } else {
            echo "dati mancanti";
        }
    ?>
</body>
</html>