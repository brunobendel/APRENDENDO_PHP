<?php
  
    //STRING 
    $exemplo1 = "<h1> Hello world </h1>";

    //INTEGER
    $exemplo2 = 345;

    var_dump($exemplo1); // mostra qual tipo do dado e quantidade de caractere

    //FLOAT
    $exemplo3 = 3.5;

    //BOOLEAN
    $exemplo4 = true;

    //ARRAY (MATRIZES)
    $carros = array("fusca","celta","monza");

    //OBJECT 

    class carro {
        public $cor;
        public $modelo;
        public function __construct($cor,$modelo){
            $this->cor = $cor;
            $this->modelo = $modelo;
        }
        public function mensagem(){
            return "<br>O carro é $this->cor e o modelo é $this->modelo";
        }
    }
    $carro1 = new carro("branco","fusca");
    $carro2 = new carro("vermelho","ferrari");

    echo $carro1->mensagem();
    echo $carro2->mensagem();

    //NULL

    $x = null;
    var_dump ($x);
    



