<?php

//data completa
echo date ('d/m/Y');
echo"<br>";

//hora
echo date('H:i:s');
echo "<br>";
//padrão brasileiro de datas
//dia/mes/ano

//padrão americano de datas
//ano/mes/dia

//calcular dias entra datas
$hoje = date('Y-m-d');
$vencimento = '2022-09-22';

$diferanca = strtotime($vencimento)-strtotime($hoje);
$dias = floor($diferanca/(60*60*24));

echo "A diferença é de $dias dias entra as datas<br>";

//conversão para o padrão BR
$data_hoje = explode('-',$hoje);
$hoje_formatado = $data_hoje[2]."/".$data_hoje[1]."/".$data_hoje[0];

echo "$hoje_formatado<br>";
echo "$hoje<br><br>";


//USAR SEMPRE O PADRÃO AMERICANO PARA REALIZAR CALCULOS E SE QUISER PODE MOSTRAR DEPOIS CONVERTIDO


//COMPARAR DUAS DATAS

$data1 = '2022-09-15';
$data2 = '2022-09-20';

if (strtotime($data1) > strtotime($data2)){
    echo "A data 1 é maior que a data 2";
}elseif (strtotime($data1) == strtotime($data2)){
    echo "A data 1 é igual a data 2";
}else{
    echo "A data 1 é menor q a data 2";
}

?>