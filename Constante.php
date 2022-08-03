<?php

    define("constant","valor atribuido");
    echo constant; //ira mostrar "valor atribuido"

    //constantes são imultaveis
    
    function teste(){
        echo constant;
    }
    teste(); //ira mostrar "valor atribuido" obs: não precisa ser daclarado como variavel global
    
    define("carros",["fusca","celta","gol"]);
    echo carros[0]; // print "fusca"

?>
