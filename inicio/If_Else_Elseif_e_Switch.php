<?php

    //If Else Elseif 
    /*
    if (condição){
        oque acontece de verdadeira
    }elisef{
        oque acontece se a primeira for falso e essa for verdadeira
    }else{
        oque acontece se as duas foram falsas
    }
*/
    //Switch

    $cor = "vermelho";

    switch($cor){
        case "vermelho":
            echo "A cor é vermelho";
            break;
        case "azul":
            echo "A cor é azul";
            break;
        default:
        echo "A cor ".$cor." não é conhecida";
    }

?>