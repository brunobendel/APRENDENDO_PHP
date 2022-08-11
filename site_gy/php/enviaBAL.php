<?php

  if ($_REQUEST['id_pneu'] != NULL || $_REQUEST['id_pneu'] = "") {
    $pneu = strtoupper($_REQUEST['id_pneu']);
    $pneu_prog = $_REQUEST['pneu_prog'];
    $lona_1 = $_REQUEST['lona_1'];
    $lona_1_prog = $_REQUEST['prog_1'];
    $lona_1_invent = $_REQUEST['inventario_1'];
    $lona_1_eqp = $_REQUEST['equipamento_1'];
  
    $lona_2 = $_REQUEST['lona_2'];
    $lona_2_prog = $_REQUEST['prog_2'];
    $lona_2_invent = $_REQUEST['inventario_2'];
    $lona_2_eqp = $_REQUEST['equipamento_2'];
    $data_lanc = date('d/m/Y');
    $maquina = $_REQUEST['maquina'];
  
    require_once('connect.php');
  
    $sql = "INSERT INTO 
      BALANCEAMENTO (PNEU, PNEU_PROG, LONA_1, LONA_1_PROG, LONA_1_INVENT, LONA_1_EQP, LONA_2, LONA_2_PROG, LONA_2_INVENT, LONA_2_EQP, DATA_LANC, MAQUINA)
      VALUES 
      ( 
    '{$pneu}', '{$pneu_prog}', '{$lona_1}', '{$lona_1_prog}', '{$lona_1_invent}', '{$lona_1_eqp}', '{$lona_2}', '{$lona_2_prog}', '{$lona_2_invent}', '{$lona_2_eqp}', to_date('{$data_lanc}','DD/MM/YYYY'),'{$maquina}')"; 
      
      $stmt_temp = connect_brppp($sql);
  
      if(oci_num_rows($stmt_temp)){
          $response = array("success" => true);
        echo json_encode($response);
      } else {
          ?>
          <script>
              alert('não foi');
          </script>
          <?php
      }  
  }
  
?>