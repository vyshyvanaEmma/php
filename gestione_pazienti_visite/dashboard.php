<?php 
session_start();
if(!$_SESSION['loggedIn']){
    header('Location: login.php');
    exit;
}
if(!isset($_SESSION['pazienti'])){
    $_SESSION['pazienti'] = array();
}

if(isset($_POST['action'])){
    switch($_POST['action']){
        case 'add_paziente':
            if(!empty($_POST['nome'])){
                $new_id = uniqid();
                $_SESSION["pazienti"][$new_id] = array(
                    'nome' => $_POST['nome'],
                    'visite' => array()
                );
            }
            break;
        case 'remove_paz':
            if(isset($_POST['id'])){
                unset($_SESSION['pazienti'][$_POST['id']]);
            }
            break;
        case 'add_v':
            if(isset($_POST['id']) && !empty($_POST['tipo'])){
                $visita = array(
                    'tipo' => $_POST['tipo'],
                    'note' => $_POST['note'] ?? ''
                );
                $_SESSION['pazienti'][$_POST['id']]['visite'][] = $visita;
            }
            break;
        case 'remove_v':
            if(isset($_POST['p_id']) && isset($_POST['i'])){
                unset($_SESSION['pazienti'][$_POST['p_id']]['visite'][$_POST['i']]);
            }
            break;
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
</head>
<body>
    <h1>L'infermiere <?php echo $_SESSION['infermiere'] ?></h1>

    <h2>Pazienti in gestione: </h2>
    <ul>
        <?php foreach($_SESSION['pazienti'] as $id => $paziente): ?>
            <li>
                <strong>
                    <?php 
                    
                    if(isset($paziente['nome'])) {
                        echo $paziente['nome'];
                    } else {
                        echo "Nome non disponibile";
                    }
                    ?>
                </strong>
                <form method="POST" style="display:inline">
                    <input type="hidden" name="action" value="remove_paz">
                    <input type="hidden" name="id" value="<?php echo $id ?>">
                    <button type="submit">Rimuovi paziente</button>
                </form>

                <ul>
                    <?php 
                    if(isset($paziente['visite']) && is_array($paziente['visite'])):
                        foreach($paziente['visite'] as $i => $visita): 
                    ?>
                        <li>
                            <?php 
                            echo htmlspecialchars($visita['tipo'] ?? 'Tipo non specificato'); 
                            echo " - "; 
                            echo htmlspecialchars($visita['note'] ?? 'Nessuna nota');
                            ?>

                            <form method="POST" style="display:inline">
                                <input type="hidden" name="action" value="remove_v">
                                <input type="hidden" name="p_id" value="<?php echo $id ?>">
                                <input type="hidden" name="i" value="<?php echo $i; ?>">
                                <button type="submit">X</button>
                            </form>
                        </li>
                    <?php 
                        endforeach;
                    endif; 
                    ?>
                </ul>

                <form method="POST">
                    <input type="hidden" name="action" value="add_v">
                    <input type="hidden" name="id" value="<?php echo $id; ?>">
                    <input type="text" name="tipo" placeholder="Tipo visita" required>
                    <input type="text" name="note" placeholder="Note">
                    <button type="submit">Aggiungi visita</button>
                </form>
            </li>
        <?php endforeach; ?>
    </ul>

    <hr>

    <h2>Aggiungi paziente</h2>
    <form method="POST">
        <input type="hidden" name="action" value="add_paziente">
        <input type="text" name="nome" placeholder="Nome paziente" required>
        <button type="submit">Aggiungi</button>
    </form>

    <form action="logout.php" method="POST">
        <button type="submit">Logout</button>
    </form>

</body>
</html>