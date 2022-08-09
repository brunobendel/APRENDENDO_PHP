<?php

    //Manipulação de String

    $palavra = "beleza";
    echo strlen($paravra); //conta as letras
    
    echo str_word_count($palavra); //conta as palavras
    
    echo strrev('Bruno'); //escreve a palavra invertida
    
    echo strpos("Oi tudo bemm com você?","tudo"); // o exemplo retornaria 3 pois ele mostra a posição da palavra procurada
    
    $palavra2 = "Ola mundo";
    echo str_replace("mundo","world",$palavra2); //troca de palavras

    $data = "22-09-1993";
    $data_formatada = str_replace("-","/",$data); //str_replace
    echo "Data antiga: $data <br> Data formatada: $data_formatada";

    //Manipulação de Numeros

    $valor = 4 * 2.5;
    var_dump($valor); //ira mostrar float 
    echo (int) $valor; //irá converter para inteiro

    $valor1 = 100;
    $valor2 = 5.5;
    $valor3 = "teste";

    var_dump(is_int($valor1)); //ira mostrar bool(true)
    var_dump(is_float($valor2)); //ira mostrar bool(true)
    var_dump(is_int($valor3)); //ira mostrar bool(false)
    var_dump(is_numeric($valor3)); //ira mostrar bool(false)
?>
