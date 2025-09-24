<!DOCTYPE html>
<html>
<head>
    <title>Esercizio numeri</title>
</head>
<body>
    <?php
        $numeri = [];
        echo "Array: <br>";
        for ($i = 1; $i <= 10; $i++) {
            $n = rand() %1000;
            $numeri[] = $n;
            echo $n . "<br>";
        }

        $max = max($numeri);
        echo "Massimo dell'array $max <br>";
        $min = min($numeri);
        echo "Minimo dell'array $min <br>";

        $count = count($numeri);
        $media = $count > 0 ? array_sum($numeri) / $count : 0;
        echo "Media dell'array $media <br>";

        $reversed_num = array_reverse($numeri);
        echo "Array inverso: <br>";
        foreach ($reversed_num as $num) {
            echo $num . "<br>";
        }

        echo "Array pari: <br>";
        $pari = [];
        for($i = 0; $i < $count; $i++) {
            if($numeri[$i] % 2 == 0){
                $pari [] = $numeri[$i];
                echo $numeri[$i] . "<br>";
            }
        }
    ?>
</body>
</html>