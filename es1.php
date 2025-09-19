<!DOCTYPE html>
<html>
<head>
    <title>Numeri divisibili per 3 tra 0 e 100</title>
    <style>
        table { border-collapse: collapse; width: 300px; }
        th, td { border: 1px solid #333; padding: 8px; text-align: center; }
    </style>
</head>
<body>
    <table>
        <tr>
            <th>Numero</th>
        </tr>
        <?php
        $divisibili = [];
        for ($i = 0; $i <= 100; $i++) {
            if ($i % 3 == 0) {
                $divisibili[] = $i;
                echo "<tr><td>$i</td></tr>";
            }
        }
        $count = count($divisibili);
        $media = $count > 0 ? array_sum($divisibili) / $count : 0;
        ?>
        <tr>
            <th>Totale</th>
            <td><?php echo $count; ?></td>
        </tr>
        <tr>
            <th>Media</th>
            <td><?php echo number_format($media, 2); ?></td>
        </tr>
    </table>
</body>
</html>