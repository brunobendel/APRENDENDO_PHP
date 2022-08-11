<?php
  $array = $_REQUEST['data'];

  $dados = json_decode($array, true);

  $pneu = strtoupper($dados['pneu']);
  
  require_once('connect.php');

  $sql = "SELECT
  P.code PRODUTO,
  bill.matfactor/1000 as fator
  FROM
  tblwodetbillmat BILL
  INNER JOIN tblproduct P ON P.idproduct = BILL.idproduct
  LEFT JOIN tblbunit B ON B.idbunit = P.idbunit
  LEFT JOIN tblbunit B ON B.idbunit = P.idbunit
  LEFT JOIN tblproducttype TP ON TP.idproducttype = P.idproducttype
  LEFT JOIN tblproductfamily F ON P.idproductfamily = F.idproductfamily
  INNER JOIN (
  SELECT * FROM (
  SELECT
  WOH.IDWOHD,
  WOH.CODE
  FROM
  TBLWOHD WOH
  WHERE
  WOH.CODE LIKE 'ME-%'
  AND WOH.IDPRODUCT = (SELECT IDPRODUCT FROM TBLPRODUCT P WHERE P.CODE = '$pneu')
  AND WOH.IDWOSITUATION = 3
  ORDER BY WOH.DTISSUE DESC
  ) WHERE ROWNUM = 1
  ) WOHD ON BILL.idwohd = WOHD.idwohd
  WHERE
  BILL.totalqty > 0 AND P.CODE LIKE 'PL%' ORDER BY fator";

  $stmt_temp = connect_pcf($sql);
  
  if(OCIExecute($stmt_temp)){
      $cont = 0;
      
      $response = [];
      $fator = [];
      $inventario = []; //inventario
      $equipamento = [];

      while(OCIFetchInto($stmt_temp, $linha, OCI_ASSOC)){

        $response[] = $linha['PRODUTO'];
        $fator[] = $linha['FATOR'];

     $sql1 = "SELECT 
            SUM(QTD) as QTD,
            COUNT(QTD) as EQP
          FROM
            MSTS
          WHERE
            MATERIAL = '".$linha['PRODUTO']."' AND TO_CHAR(MS_DT,'DD/MM/YY') = TO_CHAR(CURRENT_DATE,'DD/MM/YY')";  

        $stmt_temp1 = connect_inv($sql1);

        if(OCIExecute($stmt_temp1)){ 
          while(OCIFetchInto($stmt_temp1, $linha1, OCI_ASSOC)){
          
              $inventario[$cont] = $linha1['QTD'];
              $equipamento[$cont] = $linha1['EQP'];
            
          }
        }
        $cont++;
      }
  }


  header('Content-Type: Application/json');

  echo json_encode([
    'success' => (bool)$response,
    'lona_1'  => isset($response[0]) ? $response[0] : null,   
    'lona_2'  => isset($response[1]) ? $response[1] : null,
    'prog_1'  => isset($fator[0]) ? $fator[0] : null,   
    'prog_2'  => isset($fator[1]) ? $fator[1] : null,
    'inventario_1'  => isset($inventario[0]) ? $inventario[0] : null,   
    'inventario_2'  => isset($inventario[1]) ? $inventario[1] : null,
    'equipamento_1'  => isset($equipamento[0]) ? $equipamento[0] : null,   
    'equipamento_2'  => isset($equipamento[1]) ? $equipamento[1] : null 
  ]);
 
?>