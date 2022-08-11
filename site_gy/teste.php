<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
<?php
    $link = "http://10.104.129.20/appl_folder/visual_ra.xml";
    
    $xml = simplexml_load_file($link);
    
    foreach($xml as $item){

        echo utf8_decode($item->invent)."<br/>";        
        $inventario = $inventario + (float)utf8_decode($item->invent);
    } 
    echo $inventario;
    //echo array_sum($item->invent);
?>
</body>
</html>