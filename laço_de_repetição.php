<?php
    //Loops (While, Do...While, For e Foreach)

    // while

    $x = 1;
    while ($x <= 5){
        echo "O numero é: $x <br>";
        $x++;
    }

    //Do...While

    $x =1;
    do {
        echo "O numero é: $x";
        $x++;
    }   while($x <= 10);

    //for

    for ($i = 1; $i <=10; $i++){
        echo "$i <br>";
    }


    //foreach for para matriz

    $cores = ["azul","vermelho","amarelo","verde"];
    foreach ($cores as $valor){
        echo "A Cor é $valor <br>";
    }

?>