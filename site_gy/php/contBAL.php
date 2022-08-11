<?php

    session_start();

    require_once 'connect.php';

    if(isset($_GET['acao'])){
        $acao = $_GET['acao'];
    }else{
        $acao = $_POST['acao'];
    }

    switch($acao){

    
        case'grafico_bal':


            $series_total       = [];
            $nome_mes = [
                '01'=>'Janeiro',
                '02'=>'Fevereiro',
                '03'=>'Março',
                '04'=>'Abril',
                '05'=>'Maio',
                '06'=>'Junho',
                '07'=>'Julho',
                '08'=>'Agosto',
                '09'=>'Setembro',
                '10'=>'Outubro',
                '11'=>'Novembro',
                '12'=>'Dezenbro'
            ];

                $sql = "SELECT 

                CASE
                    
                WHEN TO_CHAR(DATA_LANC,'HH24MISS') >= '000000' AND TO_CHAR(DATA_LANC,'HH24MISS') <= '064459' THEN
                
                TO_CHAR(DATA_LANC-1,'MM')
                
                ELSE
                
                TO_CHAR(DATA_LANC,'MM')
                
                END MES,
            
                COUNT(PNEU) QTD
            FROM 
                BALANCEAMENTO 
            WHERE 
                DATA_LANC >= TO_DATE('01/01/2022','DD/MM/YYYY')
            GROUP BY
                CASE
                    
                WHEN TO_CHAR(DATA_LANC,'HH24MISS') >= '000000' AND TO_CHAR(DATA_LANC,'HH24MISS') <= '064459' THEN
                
                TO_CHAR(DATA_LANC-1,'MM')
                
                ELSE
                
                TO_CHAR(DATA_LANC,'MM')
                
                END
            ORDER BY
                MES
            ";

            $stmt_temp = connect_brppp($sql);

            if(OCIExecute($stmt_temp)){
                $cont = 0;
          
                while(OCIFetchInto($stmt_temp, $linha, OCI_ASSOC)){
                    $series_total[] = [
                        'name'  =>$nome_mes[$linha['MES']],
                        'y'     =>(int)$linha['QTD']
                    ];

                }
            }
            
            $response = [
                [
                    'name'=>'Balanceamento',
                    'type'=>'column',
                    'yAxis'=> 1,
                    'data'=>$series_total
                ]
               
            ];

            echo json_encode($response);

        break;


    }


        
?>