<?php

if(isset($_GET['nome'])){
    $nome = htmlspecialchars($_GET['nome']);
}else{
    $nome = "Mundo";
}
if(isset($_GET['cor'])){
    $cor = htmlspecialchars($_GET['cor']);
}else{
    $cor = "white";
}
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>learning</title>
    <style>
        body{
            background: <?php echo $cor; ?>;
        }

    </style>
</head>
<body>
    <h1>Olá <?php echo $nome; ?></h1>

    <a href="http://10.104.129.177/fam/bruno/test.php?nome=Bruno&cor=blue">Ir Para site do Bruno </a><br>
    <a href="http://10.104.129.177/fam/bruno/test.php?nome=Brendon&cor=deeppink">Ir Para site do Brendon </a><br>
    
</body>
</html>