<?php
    //VARIÁVEIS nunca começa com numeros
    
    $x = 10;
    $y = 5;


    function teste() {
        global $x, $y, $z; //variavel global pode ser usada dentro e fora do cod
        $z = $x +$y;
    }
    teste ();
    echo "O valor de z fora: $z";
?>