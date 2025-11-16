<?php
session_start();

if (!isset($_SESSION["utenti_logato"])) {
    header("Location: login.php");
    exit;
}

if (!isset($_SESSION["prenotazioni"]) || empty($_SESSION["prenotazioni"])) {
    header("Location: prenota.php");
    exit;
}

$ultima_prenotazione = end($_SESSION["prenotazioni"]);
?>
<!DOCTYPE html>
<html lang="it">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Riepilogo Prenotazione</title>
</head>
<body>
    <h1>✅ Prenotazione Confermata!</h1>
    <p>La tua prenotazione è stata registrata con successo</p>
    
    <hr>
    
    <h2>Dati Personali</h2>
    <table>
        <tr>
            <td><strong>Nome:</strong></td>
            <td><?php echo $ultima_prenotazione['nome']; ?></td>
        </tr>
        <tr>
            <td><strong>Cognome:</strong></td>
            <td><?php echo $ultima_prenotazione['cognome']; ?></td>
        </tr>
        <tr>
            <td><strong>Email:</strong></td>
            <td><?php echo $ultima_prenotazione['email']; ?></td>
        </tr>
        <tr>
            <td><strong>Numero Persone:</strong></td>
            <td><?php echo $ultima_prenotazione['persone']; ?></td>
        </tr>
    </table>
    
    <br>
    
    <h2>Dati Prenotazione</h2>
    <table>
        <tr>
            <td><strong>Tipo Camera:</strong></td>
            <td><?php echo ucfirst($ultima_prenotazione['camera']); ?></td>
        </tr>
        <tr>
            <td><strong>Check-in:</strong></td>
            <td><?php echo date('d/m/Y', strtotime($ultima_prenotazione['checkin'])); ?></td>
        </tr>
        <tr>
            <td><strong>Check-out:</strong></td>
            <td><?php echo date('d/m/Y', strtotime($ultima_prenotazione['checkout'])); ?></td>
        </tr>
        <tr>
            <td><strong>Notti:</strong></td>
            <td><?php echo $ultima_prenotazione['notti']; ?> notti</td>
        </tr>
    </table>
    
    <br>
    
    <h2>Servizi Extra</h2>
    <?php if (!empty($ultima_prenotazione['servizi_extra'])): ?>
        <table>
            <?php
            $nomi_servizi = [
                'colazione' => 'Colazione in Camera',
                'spa' => 'Accesso SPA',
                'garage' => 'Parcheggio Garage',
                'wifi' => 'WiFi Premium',
                'cena' => 'Cena a Lume di Candela'
            ];
            
            foreach ($ultima_prenotazione['servizi_extra'] as $servizio): ?>
                <tr>
                    <td><?php echo $nomi_servizi[$servizio]; ?></td>
                    <td><strong>INCLUSO</strong></td>
                </tr>
            <?php endforeach; ?>
        </table>
    <?php else: ?>
        <p><em>Nessun servizio extra selezionato</em></p>
    <?php endif; ?>
    
    <br>
    
    <h2>Riepilogo Prezzi</h2>
    <table>
        <tr>
            <td>Camera (<?php echo $ultima_prenotazione['notti']; ?> notti):</td>
            <td>€ <?php echo number_format($ultima_prenotazione['prezzo_camera'], 2); ?></td>
        </tr>
        <?php if ($ultima_prenotazione['prezzo_servizi'] > 0): ?>
        <tr>
            <td>Servizi Extra:</td>
            <td>€ <?php echo number_format($ultima_prenotazione['prezzo_servizi'], 2); ?></td>
        </tr>
        <?php endif; ?>
        <tr>
            <td>TOTALE:</td>
            <td>€ <?php echo number_format($ultima_prenotazione['prezzo_totale'], 2); ?></td>
        </tr>
    </table>
    
    <br>
    <hr>
    
    <h3>Azioni</h3>
    <p>
        <a href="prenota.php">Nuova Prenotazione</a> | 
        <hr>
        <a href="logout.php">Logout</a>
    </p>
</body>
</html>