<?php

    function escrever_mensagem(string $nome){
        echo "Hello $nome, How are you?" ."<br>";
    }
    escrever_mensagem("Bruno");

    function fazerCafe($tipo = "cappuccino"){
        return "Fazendo um xicara de: $tipo <br>";
    }
    echo fazerCafe("Expresso");
    echo fazerCafe();

?>  