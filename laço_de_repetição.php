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

    //Array 

    $idade = array("Bruno"=>"28","Dani"=>"30","Brendon"=>"24");

    //a linha de comando abaixo é usada como se fossa um dicionario
    //echo $idade["Bruno"];     >>>> vai aparecer 28
    //são mutaveis

    foreach ($idade as $nome => $valor){                  //foreach serve para matriz
        echo "O nome é $nome e a idade é $valor <br>"; 
    }

    $carros = ["fusca","gol","uno","celta","brasilia"];
    sort($carros);                            //organizando a matriz em ordem alfabetica ou numerica - crescente ksort
    foreach($carros as $carro){               //rsort coloca na ordem decrescente no caso de matriz é asort 
        echo $carro."<br>";                   //rsort  ksort  asort  krsort
    }



?>