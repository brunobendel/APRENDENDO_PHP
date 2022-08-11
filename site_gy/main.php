<?php

	error_reporting(E_ALL & ~E_NOTICE & ~E_WARNING);	
	
	include("connect.php");

	
		
	if(isset($_POST['data'])){$data = $_POST['data'];}else{$data = $_GET['data'];}
	if(isset($_POST['iddivisao'])){$iddivisao = $_POST['iddivisao'];}else{$iddivisao = $_GET['iddivisao'];}
	
	
	$qtd_total_pneu = 0;
	$qtd_total_moldes = 0;
	$qtd_total_pneus_requeridos = 0;
	$qtd_total_capac_turno = 0;
	$qtd_tipos_vulc = 0;
	$qtd_total_pneus_retidos = 0;
	$qtd_total_capac_24h = 0;
	$qtd_total_cclamp = 0;
	$soma_openclose_padrao = 0;
	$openclose_medio_padrao = 0;
	$soma_openclose_medio = 0;
	$openclose_medio = 0;
	$soma_tp_vulca = 0;
	$ciclo_medio_sem_openclose = 0;
	$qtd_tipo_pneu = 0;
	$qtd_TBM = 0;
	$qtd_tipo_TBM = 0;
	$qtd_total_capac_turno_TBM = 0;
	$qtd_total_pneu_TBM = 0;
	$qtd_total_capac_24h_TBM = 0;
	$qtd_total_cclamp_TBM = 0;
	
	$pneus_retidos_gt = Array();
	
	$familias[] = 'HP';
	$familias[] = 'NHP';
	$familias[] = 'TAW';
	$familias[] = 'Wrangler';
	$familias[] = 'Unisteel';
	//$familias[] = 'Sem Familia';
	
	for($x=0;$x<sizeof($familias);$x++){
		$total_pneu[$familias[$x]] = 0;
		$total_moldes[$familias[$x]] = 0;
		$total_capacidade_turno[$familias[$x]] = 0;
		$total_capacidade_24h[$familias[$x]] = 0;
		$total_c_clamp[$familias[$x]] = 0;
		$total_retido[$familias[$x]] = 0;
		$total_molde_adicional[$familias[$x]] = 0;
	}
	
	
	if($data=='atual'){
		
		//BUSCA O INVENTARIO MAIS ATUAL DA DIVISAO
		$sql = "
		
			SELECT
				*
			FROM

			(
				SELECT
					TO_CHAR(H.data_inventario,'DD/MM/YYYY') DATA_INVENTARIO,
					H.turno TURNO
				FROM   
					TB_INV_HISTORICO H
				WHERE
					H.iddivisao = '".$iddivisao."'
				ORDER BY
					H.data_lancamento DESC, H.turno DESC
			)
			WHERE
				ROWNUM = 1
		
		";

        
		$stmt_temp = connect($sql);
																			
		while (oci_fetch($stmt_temp)) {
			$data = oci_result($stmt_temp, "DATA_INVENTARIO");
			$turno = oci_result($stmt_temp, "TURNO");
		}
		
	}else{
	
		if(isset($_POST['turno'])){$turno = $_POST['turno'];}else{$turno = $_GET['turno'];}
	
	}
	
	//BUSCA O INVENTARIO
	$sql = "
	
		SELECT
			H.idinvhistorico IDINVHISTORICO,
			TO_CHAR(H.data_lancamento,'DD/MM/YYYY HH24:MI:SS') DATA_LANCAMENTO,
			H.equipe EQUIPE
		FROM   
			TB_INV_HISTORICO H
		WHERE
			H.data_inventario = TO_DATE('".$data."','DD/MM/YYYY')
			AND H.iddivisao = '".$iddivisao."'
			AND H.turno = '".$turno."'
	
	";
	
	$stmt_temp = connect($sql);
	
	$achou = FALSE;
	
	while (oci_fetch($stmt_temp)) {
		$IDINVHISTORICO = oci_result($stmt_temp, "IDINVHISTORICO");
		$DATA_LANCAMENTO = oci_result($stmt_temp, "DATA_LANCAMENTO");
		$EQUIPE = oci_result($stmt_temp, "EQUIPE");
		
		$achou = TRUE;
	}
	
	//VERIFICA SE ENCONTROU
	if($achou == FALSE){
		echo 'Nenhum inventï¿½rio foi encontrado na busca.';
		exit;
	}
	
	//QTD DE MINUTOS POR TURNO
	if($turno == 1){$minutos_turno = 510;$horas_turno = 8.5;}
	if($turno == 2){$minutos_turno = 495;$horas_turno = 8.25;}
	if($turno == 3){$minutos_turno = 435;$horas_turno = 7.25;}
	
	//HORA INICIO DA TURMA
	if($turno == 1){$hora_inicio_turma = '06:45:00';$inicio_turma = 6.75;}
	if($turno == 2){$hora_inicio_turma = '15:15:00';$inicio_turma = 15.25;}
	if($turno == 3){$hora_inicio_turma = '23:30:00';$inicio_turma = 23.50;}
	
	
	//BUSCA OS PNEUS
	$sql = " 

		SELECT
			I.codgt CODGT,
			F.DESCRICAO FAMILIA,
			I.qtd QTD_PNEUS,
			I.qtd_moldes QTD_MOLDES,
			I.media_openclose OPENCLOSE,
			I.qtd_retido QTD_RETIDO,
			I.motivo_retido MOTIVO_RETIDO, 
			P.TIPO TIPOP 
		FROM
			TB_INV_PNEU I
			LEFT JOIN TB_PNEU P
			ON P.CODGT = I.CODGT
			LEFT JOIN TB_FAMILIA F
			ON F.IDFAMILIA = P.IDFAMILIA
		WHERE
			I.idinvhistorico = '".$IDINVHISTORICO."'
			AND (I.qtd > 0 OR I.qtd_retido > 0 OR I.qtd_moldes > 0)
		ORDER BY
			F.DESCRICAO, 
			I.codgt 
	";
    
    echo $sql;
	$stmt_temp = connect($sql);
																			
	while (oci_fetch($stmt_temp)) {
	
		$familia = oci_result($stmt_temp, "FAMILIA");
		if($familia == Null){$familia = 'Sem Familia';}
		if($familia == "Passageiro"){$familia = oci_result($stmt_temp, "TIPOP");}
		if($familia == Null){$familia = '-';}
		
		$CODGT[$familia][] = oci_result($stmt_temp, "CODGT");
		$QTD_PNEUS[$familia][] = oci_result($stmt_temp, "QTD_PNEUS");
		$QTD_MOLDES[$familia][] = oci_result($stmt_temp, "QTD_MOLDES");
		$OPENCLOSE[$familia][] = oci_result($stmt_temp, "OPENCLOSE");
		$QTD_RETIDO[$familia][] = oci_result($stmt_temp, "QTD_RETIDO");
		$MOTIVO_RETIDO[$familia][] = oci_result($stmt_temp, "MOTIVO_RETIDO");
		
		$total_pneu[$familia] += oci_result($stmt_temp, "QTD_PNEUS");
		$total_moldes[$familia] += oci_result($stmt_temp, "QTD_MOLDES");
		$total_retido[$familia] += oci_result($stmt_temp, "QTD_RETIDO");
		
		$qtd_total_pneus_retidos += oci_result($stmt_temp, "QTD_RETIDO");
		
		$qtd_total_moldes += oci_result($stmt_temp, "QTD_MOLDES");
		
		$soma_openclose_padrao += oci_result($stmt_temp, "QTD_MOLDES") * 71.4;
		
		$soma_openclose_medio += (oci_result($stmt_temp, "OPENCLOSE") * oci_result($stmt_temp, "QTD_MOLDES")) * 60;
		
		$qtd_tipo_pneu++;
		
		$pneu_IDPNEU[oci_result($stmt_temp, "CODGT")] = Null;
		$pneu_MEDIDA[oci_result($stmt_temp, "CODGT")] = Null;
		$pneu_ARO[oci_result($stmt_temp, "CODGT")] = Null;
		$pneu_MOLDE[oci_result($stmt_temp, "CODGT")] = Null;
		$pneu_MERCADO[oci_result($stmt_temp, "CODGT")] = Null;
		$pneu_TEMPO_VULCA[oci_result($stmt_temp, "CODGT")] = Null;
		$pneu_TEMPO_VULCA_MINUTOS[oci_result($stmt_temp, "CODGT")] = Null;
		$pneu_TEMPO_VULCA_MIN[oci_result($stmt_temp, "CODGT")] = Null;
		$pneu_CAP_TURNO[oci_result($stmt_temp, "CODGT")] = Null;
		$pneu_CAPAC_TURNO[oci_result($stmt_temp, "CODGT")] = Null;
		$pneu_MULTIPLO_MENOR[oci_result($stmt_temp, "CODGT")] = Null;
		$pneu_QTD_H_CAV_CHEIAS[oci_result($stmt_temp, "CODGT")] = Null;
		$pneu_HORARIO_REQ_PNEUS[oci_result($stmt_temp, "CODGT")] = Null;
		$pneu_QTD_CARGA[oci_result($stmt_temp, "CODGT")] = Null;
		$pneu_ARRED_CARGA[oci_result($stmt_temp, "CODGT")] = Null;
		$pneu_HORAS_COB_VULC[oci_result($stmt_temp, "CODGT")] = Null;
		$pneu_BAL[oci_result($stmt_temp, "CODGT")] = Null;
		$pneu_QTD_PNEU_REQ[oci_result($stmt_temp, "CODGT")] = Null;
		$pneu_BLADDER[oci_result($stmt_temp, "CODGT")] = Null;
		$pneu_VIDA_BLADDER[oci_result($stmt_temp, "CODGT")] = Null;
		$pneu_HORAS_INVENTARIO[oci_result($stmt_temp, "CODGT")] = Null;
		$pneu_MOLDE_ADICIONAL[oci_result($stmt_temp, "CODGT")] = Null;
		
		$pneu_CAPACIDADE_TURNO[oci_result($stmt_temp, "CODGT")] = Null;
		$pneu_CAP_24H[oci_result($stmt_temp, "CODGT")] = Null;
		$pneu_C_CLAMP[oci_result($stmt_temp, "CODGT")] = Null;		
		$pneu_PARADA_VULCA[oci_result($stmt_temp, "CODGT")] = Null;
		$pneu_PNEU_REQUERIDO[oci_result($stmt_temp, "CODGT")] = Null;
		$pneu_TBM[oci_result($stmt_temp, "CODGT")] = FALSE;
		
		//PNEUS RETIDOS
		if(oci_result($stmt_temp, "QTD_RETIDO") > 0){
			$pneus_retidos_gt[] = oci_result($stmt_temp, "CODGT");
			$pneus_retidos_qtd[] = oci_result($stmt_temp, "QTD_RETIDO");
			$pneus_retidos_motivo[] = oci_result($stmt_temp, "MOTIVO_RETIDO");
		}
		
		if(oci_result($stmt_temp, "QTD_MOLDES") > 0){$qtd_tipos_vulc++;}
		

		//BUSCA AS INFORMACOES DO PNEU
		$sql2 = "
		
			SELECT
				P.idpneu IDPNEU,
				P.codgt CODGT,
				P.medida MEDIDA,
				P.aro ARO,
				P.molde MOLDE,
				P.mercado MERCADO,
				REPLACE(TO_CHAR(P.tp_vulc_hora,'00') || ':' || TO_CHAR(P.tp_vulc_min,'00') || ':' || TO_CHAR(P.tp_vulc_seg,'00'),' ','') TEMPO_VULCA,
				((P.tp_vulc_hora * 60) + (P.tp_vulc_min) + (P.tp_vulc_seg/60)) TEMPO_VULCA_MINUTOS,
				P.TIPO TIPO 
			FROM
				TB_PNEU P
			WHERE
				P.codgt = '".oci_result($stmt_temp, "CODGT")."'
		
		";
		
		$stmt_temp2 = connect($sql2);
																			
		while (oci_fetch($stmt_temp2)) {
			$pneu_IDPNEU[oci_result($stmt_temp, "CODGT")] = oci_result($stmt_temp2, "IDPNEU");
			$pneu_MEDIDA[oci_result($stmt_temp, "CODGT")] = oci_result($stmt_temp2, "MEDIDA");
			$pneu_ARO[oci_result($stmt_temp, "CODGT")] = oci_result($stmt_temp2, "ARO");
			$pneu_MOLDE[oci_result($stmt_temp, "CODGT")] = substr(oci_result($stmt_temp2, "MOLDE"),0,20);
			$pneu_MERCADO[oci_result($stmt_temp, "CODGT")] = oci_result($stmt_temp2, "MERCADO");
			$pneu_TEMPO_VULCA[oci_result($stmt_temp, "CODGT")] = oci_result($stmt_temp2, "TEMPO_VULCA");
			$pneu_TIPO[oci_result($stmt_temp, "CODGT")] = oci_result($stmt_temp2, "TIPO");
			$pneu_TEMPO_VULCA_MINUTOS[oci_result($stmt_temp, "CODGT")] = str_replace(",",".",oci_result($stmt_temp2, "TEMPO_VULCA_MINUTOS"));
			$pneu_TEMPO_VULCA_MIN[oci_result($stmt_temp, "CODGT")] = str_replace(",",".",oci_result($stmt_temp2, "TEMPO_VULCA_MINUTOS"));
			
			$soma_tp_vulca += $minutos_turno / $pneu_TEMPO_VULCA_MIN[oci_result($stmt_temp, "CODGT")] * oci_result($stmt_temp, "QTD_MOLDES");
			
			//ACRESCENTA O TEMPO DE OPENCLOSE NO TEMPO DE VULCA
			if(oci_result($stmt_temp, "QTD_MOLDES") > 0){
				$sql3 = "
					SELECT
						*
					FROM
					(
					SELECT 
						TO_CHAR((TO_DATE('00:00:00','HH24:MI:SS') + ".((($pneu_TEMPO_VULCA_MINUTOS[oci_result($stmt_temp, "CODGT")]+ oci_result($stmt_temp, "OPENCLOSE"))/1440) )."),'HH24:MI:SS') TEMPO_VULCA  					
					FROM TB_AREA
					)
					WHERE
						ROWNUM = 1
				
				";
				$stmt_temp3 = connect($sql3);
				//echo $sql3.' - '.oci_result($stmt_temp, "OPENCLOSE").'<br>';
				while (oci_fetch($stmt_temp3)) {
					$pneu_TEMPO_VULCA[oci_result($stmt_temp, "CODGT")] = oci_result($stmt_temp3, "TEMPO_VULCA");
				}
				$pneu_TEMPO_VULCA_MINUTOS[oci_result($stmt_temp, "CODGT")] += oci_result($stmt_temp, "OPENCLOSE");
			}
			
			$pneu_CAPACIDADE_TURNO[oci_result($stmt_temp, "CODGT")] = floor(((1440/$pneu_TEMPO_VULCA_MINUTOS[oci_result($stmt_temp, "CODGT")])) * (oci_result($stmt_temp, "QTD_MOLDES")/24) * $horas_turno);
			
			$total_capacidade_turno[$familia] += $pneu_CAPACIDADE_TURNO[oci_result($stmt_temp, "CODGT")];
			
			$qtd_total_capac_turno += $pneu_CAPACIDADE_TURNO[oci_result($stmt_temp, "CODGT")];
			
			$pneu_CAP_24H[oci_result($stmt_temp, "CODGT")] = floor((1440/$pneu_TEMPO_VULCA_MINUTOS[oci_result($stmt_temp, "CODGT")])*oci_result($stmt_temp, "QTD_MOLDES"));
			
			$total_capacidade_24h[$familia] += $pneu_CAP_24H[oci_result($stmt_temp, "CODGT")];
			$qtd_total_capac_24h += $pneu_CAP_24H[oci_result($stmt_temp, "CODGT")];
			$vs_auxtipo = oci_result($stmt_temp2, "TIPO");
			if ($familia == "Passageiro" && $vs_auxtipo != "HP"){
				$vs_auxtipo = "NHP";
			}
			
			if ($vs_auxtipo == 'DURATRAC') {
				$qtd_total_capac_24h_tipo[$vs_auxtipo] += $pneu_CAP_24H[oci_result($stmt_temp, "CODGT")];
			} else {
				$qtd_total_capac_24h_tipo[$familia] += $pneu_CAP_24H[oci_result($stmt_temp, "CODGT")];
			}
			
			$vs_aux = trim($pneu_MOLDE[oci_result($stmt_temp, "CODGT")]);
			$vs_aux = strtoupper($vs_aux);
			$pneu_C_CLAMP[oci_result($stmt_temp, "CODGT")] = ceil($pneu_CAPACIDADE_TURNO[oci_result($stmt_temp, "CODGT")] * 0.004);
			
			$total_c_clamp[$familia] += $pneu_C_CLAMP[oci_result($stmt_temp, "CODGT")];
			$qtd_total_cclamp += $pneu_C_CLAMP[oci_result($stmt_temp, "CODGT")];
			
		}
		
		//CAPACIDADE DO TURNO
		if($pneu_TEMPO_VULCA_MINUTOS[oci_result($stmt_temp, "CODGT")] > 0){
			$pneu_CAP_TURNO[oci_result($stmt_temp, "CODGT")] = $minutos_turno / $pneu_TEMPO_VULCA_MINUTOS[oci_result($stmt_temp, "CODGT")];
			$pneu_CAPAC_TURNO[oci_result($stmt_temp, "CODGT")] = $pneu_CAP_TURNO[oci_result($stmt_temp, "CODGT")] * oci_result($stmt_temp, "QTD_MOLDES");
			
			//$qtd_total_capac_turno += $pneu_CAP_TURNO[oci_result($stmt_temp, "CODGT")] * oci_result($stmt_temp, "QTD_MOLDES");
			
		}
		
		
		if(oci_result($stmt_temp, "QTD_MOLDES") > 0){
			
			//MULTIPLO MENOR
			$multiplo_menor = 0;			
			for($x=0;(oci_result($stmt_temp, "QTD_MOLDES") * $x)<=oci_result($stmt_temp, "QTD_PNEUS");$x++){
				$multiplo_menor = oci_result($stmt_temp, "QTD_MOLDES") * $x;
			}			
			$pneu_MULTIPLO_MENOR[oci_result($stmt_temp, "CODGT")] = $multiplo_menor;
		
			
			//QTD. CARGA
			$pneu_QTD_CARGA[oci_result($stmt_temp, "CODGT")] = (oci_result($stmt_temp, "QTD_PNEUS") / oci_result($stmt_temp, "QTD_MOLDES"));
			
			//ARRED. CARGA
			$pneu_ARRED_CARGA[oci_result($stmt_temp, "CODGT")] = ceil((oci_result($stmt_temp, "QTD_PNEUS") / oci_result($stmt_temp, "QTD_MOLDES")));
			
			
			//QTD HORAS CAVIDADE CHEIA, HORARIO_REQ_PNEUS
			$sql3 = "
			
				SELECT 
					TO_CHAR((TO_DATE('00:00:00','HH24:MI:SS') + ".(($pneu_MULTIPLO_MENOR[oci_result($stmt_temp, "CODGT")]/oci_result($stmt_temp, "QTD_MOLDES"))*($pneu_TEMPO_VULCA_MINUTOS[oci_result($stmt_temp, "CODGT")]/1440))."),'HH24:MI') QTD_HORAS_CAV_CHEIAS,
					TO_CHAR((TO_DATE('00:00:00','HH24:MI:SS') + ".(($pneu_TEMPO_VULCA_MINUTOS[oci_result($stmt_temp, "CODGT")]/1440)*$pneu_ARRED_CARGA[oci_result($stmt_temp, "CODGT")])."),'HH24:MI') HORAS_COB_VULC,
					TO_CHAR((TO_DATE('".$hora_inicio_turma."','HH24:MI:SS') + ".(($pneu_MULTIPLO_MENOR[oci_result($stmt_temp, "CODGT")]/oci_result($stmt_temp, "QTD_MOLDES"))*($pneu_TEMPO_VULCA_MINUTOS[oci_result($stmt_temp, "CODGT")]/1440))."),'HH24:MI') HORARIO_REQ_PNEUS,
					TO_CHAR((TO_DATE('".$hora_inicio_turma."','HH24:MI:SS') + ".(($pneu_TEMPO_VULCA_MINUTOS[oci_result($stmt_temp, "CODGT")]/1440)*$pneu_ARRED_CARGA[oci_result($stmt_temp, "CODGT")])."),'HH24:MI')  BAL_PNEUS  					
				FROM TB_AREA
			
			";
			$stmt_temp3 = connect($sql3);	
			//echo $sql3.'<br>';
			while (oci_fetch($stmt_temp3)) {
				$pneu_QTD_H_CAV_CHEIAS[oci_result($stmt_temp, "CODGT")] = oci_result($stmt_temp3, "QTD_HORAS_CAV_CHEIAS");
				$pneu_HORARIO_REQ_PNEUS[oci_result($stmt_temp, "CODGT")] = oci_result($stmt_temp3, "HORARIO_REQ_PNEUS");
				$pneu_HORAS_COB_VULC[oci_result($stmt_temp, "CODGT")] = oci_result($stmt_temp3, "HORAS_COB_VULC");
				$pneu_BAL[oci_result($stmt_temp, "CODGT")] = oci_result($stmt_temp3, "BAL_PNEUS");
			}
			
			
			$pneu_HORAS_INVENTARIO2[oci_result($stmt_temp, "CODGT")] = oci_result($stmt_temp, "QTD_PNEUS") / $pneu_CAPACIDADE_TURNO[oci_result($stmt_temp, "CODGT")] * $horas_turno;
			
			
			$pneu_HORAS_INVENTARIO[oci_result($stmt_temp, "CODGT")] = round((($pneu_HORAS_INVENTARIO2[oci_result($stmt_temp, "CODGT")] - floor($pneu_HORAS_INVENTARIO2[oci_result($stmt_temp, "CODGT")])) * 0.599) + floor($pneu_HORAS_INVENTARIO2[oci_result($stmt_temp, "CODGT")]),2);
			
			$pneu_PARADA_VULCA[oci_result($stmt_temp, "CODGT")] = ((($inicio_turma + ($pneu_HORAS_INVENTARIO2[oci_result($stmt_temp, "CODGT")] - 0.5)) - floor(($inicio_turma + ($pneu_HORAS_INVENTARIO2[oci_result($stmt_temp, "CODGT")] - 0.5)))) * 0.599) + floor(($inicio_turma + ($pneu_HORAS_INVENTARIO2[oci_result($stmt_temp, "CODGT")] - 0.5))) ;
			
			if($pneu_PARADA_VULCA[oci_result($stmt_temp, "CODGT")] > 24){
				$pneu_PARADA_VULCA[oci_result($stmt_temp, "CODGT")] = $pneu_PARADA_VULCA[oci_result($stmt_temp, "CODGT")] - 24;
			}
			
			//PNEU REQUERIDO (B1)
			if(oci_result($stmt_temp, "QTD_PNEUS") > $pneu_CAPACIDADE_TURNO[oci_result($stmt_temp, "CODGT")]){
				$pneu_PNEU_REQUERIDO[oci_result($stmt_temp, "CODGT")] = $pneu_CAPACIDADE_TURNO[oci_result($stmt_temp, "CODGT")] - oci_result($stmt_temp, "QTD_PNEUS");
			}else{
				$pneu_PNEU_REQUERIDO[oci_result($stmt_temp, "CODGT")] = $pneu_CAPACIDADE_TURNO[oci_result($stmt_temp, "CODGT")] - oci_result($stmt_temp, "QTD_PNEUS");
			}
			
			
		}
		
		//QTD PNEUS REQUERIDOS
		if($pneu_CAPAC_TURNO[oci_result($stmt_temp, "CODGT")] > oci_result($stmt_temp, "QTD_PNEUS")){
			$pneu_QTD_PNEU_REQ[oci_result($stmt_temp, "CODGT")] = $pneu_CAPAC_TURNO[oci_result($stmt_temp, "CODGT")] - oci_result($stmt_temp, "QTD_PNEUS");
			
			$qtd_total_pneus_requeridos += $pneu_CAPAC_TURNO[oci_result($stmt_temp, "CODGT")] - oci_result($stmt_temp, "QTD_PNEUS");
			
		}
		
		
		
		
		//BUSCA O BLADDER E A VIDA DO BLADDER
		$sql5 = "
		
			SELECT
				P.BLADDER BLADDER,
				P.pv VIDA
			FROM
			";
		
		if($iddivisao == '1'){$sql5 .= "tbl_pneus_b1 P";}elseif($iddivisao == '2'){$sql5 .= "tbl_pneus P";}

		$sql5 .=	"
			WHERE
				P.CODGT = '".oci_result($stmt_temp, "CODGT")."'
		
		";
		
		//echo $sql5.'<br>';
		
		$stmt_temp5 = connect_bladderlife($sql5);
																			
		while (oci_fetch($stmt_temp5)) {	
			$pneu_BLADDER[oci_result($stmt_temp, "CODGT")] = oci_result($stmt_temp5, "BLADDER");
			$pneu_VIDA_BLADDER[oci_result($stmt_temp, "CODGT")] = oci_result($stmt_temp5, "VIDA");
		}
		
		
		//Verifica se o pneu esta no layout do mes para ver se Ã© da TBM ou nÃ£o
		$auxData = explode("/", $data);
		$vsSqlTbm =	"
			SELECT 
				LAY_MAQUINA
			FROM
				PPP_LAYOUT
			WHERE
				LAY_GT = '".oci_result($stmt_temp, "CODGT")."'
				AND LAY_MES = '{$auxData[1]}'
				AND LAY_ANO = '{$auxData[2]}'
		";
		$stmtTbmCheck = connect_brfam($vsSqlTbm);
		$viResult = 0;																
		while (oci_fetch($stmtTbmCheck)) {	
			$auxMaquina = oci_result($stmtTbmCheck, "LAY_MAQUINA");
			if ($auxMaquina == "TBM"):
				$pneu_TBM[oci_result($stmt_temp, "CODGT")] = TRUE;
			endif;
			$viResult = 1;
		}
		if ($viResult == 0){
			//VERIFICA NO XML DO PROGRAMA SE O GT ESTA FAZENDO NA TBM
			$caminho_xml = 'http://10.104.129.20/appl_folder/b1/programa.xml';
			if ($myxml = simplexml_load_file ($caminho_xml)) {
			   foreach ($myxml as $estrutura) {
			   
				  if($estrutura->Pneu == oci_result($stmt_temp, "CODGT")){
						if(substr($estrutura->NT,0,3) == "TBM"){
							$pneu_TBM[oci_result($stmt_temp, "CODGT")] = TRUE;						
							//echo $estrutura->Pneu.'<br>';
						}
				  }
			   
			   }
			}
		}
		
		$qtd_total_pneu += oci_result($stmt_temp, "QTD_PNEUS");
        
		if($pneu_TBM[oci_result($stmt_temp, "CODGT")]){
			$qtd_TBM += oci_result($stmt_temp, "QTD_MOLDES");
			$qtd_tipo_TBM++;
			$qtd_total_capac_turno_TBM += $pneu_CAPACIDADE_TURNO[oci_result($stmt_temp, "CODGT")];
			$qtd_total_pneu_TBM += oci_result($stmt_temp, "QTD_PNEUS");
			$qtd_total_capac_24h_TBM += $pneu_CAP_24H[oci_result($stmt_temp, "CODGT")];
			$qtd_total_cclamp_TBM += $pneu_C_CLAMP[oci_result($stmt_temp, "CODGT")];
		}
	}
	
	//BUSCA QTD DE MOLDES ADICIONAL (SEMPRE A ÃšLTIMA ATUALIZAÃ‡ÃƒO)
	$sql6 = "SELECT 
				M.*, F.DESCRICAO FAMILIA, P.TIPO
			FROM 
				TB_MOLDE_ADICIONAL M LEFT JOIN TB_PNEU P
				ON M.CODGT = P.CODGT LEFT JOIN TB_FAMILIA F
				ON P.IDFAMILIA = F.IDFAMILIA 
			WHERE
				M.DATA = ( SELECT MAX(DATA) FROM TB_MOLDE_ADICIONAL ) AND
				M.TURNO = ( SELECT MAX(TURNO) FROM TB_MOLDE_ADICIONAL ) AND 
				M.IDDIVISAO = ". $iddivisao ."
			ORDER BY	
				M.CODGT
		   ";
	
	$stmt_temp6 = connect($sql6);
	
	while (oci_fetch($stmt_temp6)) {
		$pneu_MOLDE_ADICIONAL[oci_result($stmt_temp6, "CODGT")] = oci_result($stmt_temp6, "QTD");
		
		if ( oci_result($stmt_temp6, "FAMILIA") == 'Passageiro' ) {
			$total_molde_adicional[oci_result($stmt_temp6, "TIPO")] += oci_result($stmt_temp6, "QTD");
		} else {		
			$total_molde_adicional[oci_result($stmt_temp6, "FAMILIA")] += oci_result($stmt_temp6, "QTD");
		}
	}
	

	//FAZ A MEDIA PONDERADA DO TEMPO DE VULCANIZACAO	
	$soma_media_pond = 0;	
	for($y=0;$y<sizeof($familias);$y++){
		for($x=0;$x<sizeof($CODGT[$familias[$y]]);$x++){
			$soma_media_pond += $pneu_TEMPO_VULCA_MIN[$CODGT[$familias[$y]][$x]] * $QTD_MOLDES[$familias[$y]][$x];
		}
	}		
	$soma_media_pond = round($soma_media_pond / $qtd_total_moldes,2);
	
	//OPEN CLOSE MEDIO PADRAO
	$openclose_medio_padrao = round($soma_openclose_padrao / $qtd_total_moldes,2);
	
	//OPEN CLOSE MEDIO
	$openclose_medio = ($soma_openclose_medio / $qtd_total_moldes);

	//CICLO MEDIO SEM OPENCLOSE
	$a = $qtd_total_moldes * $minutos_turno;
	$ciclo_medio_sem_openclose = $a / $soma_tp_vulca;
	
	$ciclo_medio_com_openclose = round($ciclo_medio_sem_openclose + ($openclose_medio / 60),2);
	
	
?>

<html>
	<head>
	
	
	
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<meta name="description" content="">
		<meta name="author" content="">
		
	   <style type="text/css" >
			body {
				font-family: Calibri, DejaVu Sans, Arial;
				margin: 0;
				padding: 0;
				border: none;
			}

			.break { page-break-before: always; }

			table.bordasimples {border-collapse: collapse;line-height: 14px}

			table.bordasimples tr td {border:2px solid #000000;}
			
			table.bordasimples tr:nth-child(odd) {
			background-color:#ffffff;
			}
			table.bordasimples tr:nth-child(even) {
			background-color:#e8e8e8;
			}

			.style1 {
				font-size: 15px;
				font-weight: bold;
			}

			.style3 {
				font-size: 13px;
			}

			.style4 {
				font-size: 12px;
			}

			.style5 {
				font-size: 13px;
				font-weight: bold;
			}

			.style6 {
				font-size: 18px;
				font-weight: bold;
			}

			.style7 {
				font-size: 18px
			}

			.style51 {
				font-size: 16px;
				font-weight: bold;
			}
		@media print{
			body {
				font-family: Calibri, DejaVu Sans, Arial;
				margin: 0;
				padding: 0;
				border: none;
			}

			.break { page-break-before: always; }

			table.bordasimples {border-collapse: collapse;line-height: 14px}

			table.bordasimples tr td {border:2px solid #000000;}

			.style1 {
				font-size: 15px;
				font-weight: bold;
			}

			.style3 {
				font-size: 13px;
			}

			.style4 {
				font-size: 12px;
			}

			.style5 {
				font-size: 13px;
				font-weight: bold;
			}

			.style6 {
				font-size: 18px;
				font-weight: bold;
			}

			.style7 {
				font-size: 18px
			}

			.style51 {
				font-size: 16px;
				font-weight: bold;
			}
		}
       </style>
	   

	
	
	<title>Inventario</title>
	
	</head>
	<body>
	
		<table width="1050" border="1" class="bordasimples">
		
			
			<tr>
				<td colspan="9"><div align="center" class="style6">INVENTARIO PNEU CRU - DIV. B<?php echo $iddivisao; ?></div></td>
				<td colspan="2"><div align="center" class="style5">Data: <?php echo $data; ?></div></td>
				<td colspan="2"><div align="center" class="style5">Turno: <?php echo $turno; ?></div></td>
				<td colspan="3"><div align="center" class="style5">Equipe: <?php echo $EQUIPE; ?></div></td>
			</tr>
			
			<tr>
				<td colspan="16"><div align="right" class="style4">InventÃ¡rio lanÃ§ado em <?php echo $DATA_LANCAMENTO; ?></div></td>
			</tr>
		
			<tr>
				<td width="30"><div align="center" class="style1">Aro</div></td>
				<td width="80"><div align="center" class="style1">Cod. Pneu</div></td>
				<td width="48"><div align="center" class="style1">Qtd moldes</div></td>
				<td width="52"><div align="center" class="style1">Capac.<br>Turno</div></td>
				<td width="62"><div align="center" class="style1">Qtd<br>Pneus</div></td>
				<td width="70"><div align="center" class="style1">Horas<br>de Inv.</div></td>
				<td width="89"><div align="center" class="style1">Capacidade<br>24h</div></td>
				<td width="67"><div align="center" class="style1">C-Clamp</div></td>
				<td width="67"><div align="center" class="style1">Parada da vulca.</div></td>
				<td width="80"><div align="center" class="style1">Pneu<br>Requerido</div></td>
				<td width="35"><div align="center"><span class="style1">TBM</span></div></td>
				<td colspan="2"><div align="center" class="style1">Desc.</div></td>
				<td width="22"><div align="center" class="style1">Tipo</div></td>
				<td width="150"><div align="center" class="style1">Desenho</div></td>
				<td width="48"><div align="center" class="style1">Molde Adic.</div></td>
			</tr>
			
			<?php
			
				for($y=0;$y<sizeof($familias);$y++){
				
					for($x=0;$x<sizeof($CODGT[$familias[$y]]);$x++){
			?>
			<tr>
				<td><div align="center" class="style5"><?php echo $pneu_ARO[$CODGT[$familias[$y]][$x]]; ?></div></td>
				<td><div align="center" class="style5"><?php echo $CODGT[$familias[$y]][$x]; ?></div></td>
				<td><div align="center" class="style3"><?php if($QTD_MOLDES[$familias[$y]][$x] == 0){echo '';}else{echo $QTD_MOLDES[$familias[$y]][$x];} ?></div></td>
				<td><div align="center" class="style4"><?php echo $pneu_CAPACIDADE_TURNO[$CODGT[$familias[$y]][$x]]; ?></div></td>
				<td><div align="center" class="style5"><?php echo $QTD_PNEUS[$familias[$y]][$x]; ?></div></td>
				<td><div align="center" class="style3"><?php echo $pneu_HORAS_INVENTARIO[$CODGT[$familias[$y]][$x]]; ?></div></td>
				<td><div align="center" class="style3"><?php echo $pneu_CAP_24H[$CODGT[$familias[$y]][$x]]; ?></div></td>
				<td><div align="center" class="style3"><?php echo $pneu_C_CLAMP[$CODGT[$familias[$y]][$x]]; ?></div></td>
				<td><div align="center" class="style3"><?php echo round($pneu_PARADA_VULCA[$CODGT[$familias[$y]][$x]],2); ?></div></td>
				<td><div align="center" class="style3"><?php echo $pneu_PNEU_REQUERIDO[$CODGT[$familias[$y]][$x]]; ?></div></td>
				<td><div align="center" class="style3"><?php if($pneu_TBM[$CODGT[$familias[$y]][$x]]){echo 'TBM';} ?>&nbsp;</div></td>
				<td colspan="2"><div align="center" class="style3"><?php if($pneu_MEDIDA[$CODGT[$familias[$y]][$x]] == Null && $pneu_ARO[$CODGT[$familias[$y]][$x]] == Null){echo '';}else{echo $pneu_MEDIDA[$CODGT[$familias[$y]][$x]].'R'.$pneu_ARO[$CODGT[$familias[$y]][$x]];} ?></div></td>
				<td><div align="center" class="style3"><?php echo $pneu_TIPO[$CODGT[$familias[$y]][$x]]; ?></div></td>
				<td><div align="center" class="style3"><?php echo $pneu_MOLDE[$CODGT[$familias[$y]][$x]]; ?></div></td>
				
				<td><div align="center" class="style3"><?php echo $pneu_MOLDE_ADICIONAL[$CODGT[$familias[$y]][$x]]; ?></div></td>
				
			</tr>
			<?php
					}
					
					if($total_capacidade_turno[$familias[$y]] > 0){
						$total_parada_vulca = round(($total_pneu[$familias[$y]] / $total_capacidade_turno[$familias[$y]]) * $horas_turno,2);
						$total_horas_inv = round((($total_parada_vulca - floor($total_parada_vulca))*0.599) + floor($total_parada_vulca),2);
					}else{
						$total_parada_vulca = 0;
						$total_horas_inv = 0;
					}
			?>
			
			
			
			<tr>
				<td bgcolor="#B0C4DE"><div align="center" class="style51"><?php echo sizeof($CODGT[$familias[$y]]); ?></div></td>
				<td bgcolor="#B0C4DE"><div align="center" class="style51">TOTAL <?php 
					if($familias[$y] == 'Passageiro'){echo 'Q';}
					if($familias[$y] == 'HP'){echo 'HP';}
					if($familias[$y] == 'NHP'){echo 'NHP';}
					if($familias[$y] == 'TAW'){echo 'W';}
					if($familias[$y] == 'Wrangler'){echo 'L';}
					if($familias[$y] == 'Unisteel'){echo 'B2';}
				?></div></td>
				<td bgcolor="#B0C4DE"><div align="center" class="style51"><?php echo $total_moldes[$familias[$y]]; ?></div></td>
				<td bgcolor="#B0C4DE"><div align="center" class="style51"><?php echo $total_capacidade_turno[$familias[$y]]; ?></div></td>
				<td bgcolor="#B0C4DE"><div align="center" class="style51"><?php echo $total_pneu[$familias[$y]]; ?></div></td>
				<td bgcolor="#B0C4DE"><div align="center" class="style51"><?php echo $total_horas_inv; ?></div></td>
				<td bgcolor="#B0C4DE"><div align="center" class="style51"><?php echo $total_capacidade_24h[$familias[$y]]; ?></div></td>
				<td bgcolor="#B0C4DE"><div align="center" class="style51"><?php echo $total_c_clamp[$familias[$y]]; ?></div></td>
				<td bgcolor="#B0C4DE"><div align="center" class="style51"><?php echo $total_parada_vulca; ?></div></td>
				<td bgcolor="#B0C4DE"><div align="center" class="style51"></div></td>
				<td bgcolor="#B0C4DE">&nbsp;</td>
				<td bgcolor="#B0C4DE" colspan="2"><div align="center" class="style51"></div></td>
				<td bgcolor="#B0C4DE"><div align="center" class="style51"></div></td>
				<td bgcolor="#B0C4DE"><div align="center" class="style51"></div></td>

				<td bgcolor="#B0C4DE"><div align="center" class="style51"><?php echo $total_molde_adicional[$familias[$y]]; ?></div></td>
				
			</tr>
				
			<?php
					if($familias[$y] == 'NHP'){
						$total_parada_vulca = round((($total_pneu["HP"] + $total_pneu["NHP"]) / ($total_capacidade_turno["HP"] + $total_capacidade_turno["NHP"])) * $horas_turno,2);
						$total_horas_inv = round((($total_parada_vulca - floor($total_parada_vulca))*0.599) + floor($total_parada_vulca),2);
			?>
						<tr>
							<td bgcolor="#B0C4DE"><div align="center" class="style51"><?php echo sizeof($CODGT["HP"]) + sizeof($CODGT["NHP"]); ?></div></td>
							<td bgcolor="#B0C4DE"><div align="center" class="style51">TOTAL Q</div></td>
							<td bgcolor="#B0C4DE"><div align="center" class="style51"><?php echo $total_moldes["HP"] + $total_moldes["NHP"]; ?></div></td>
							<td bgcolor="#B0C4DE"><div align="center" class="style51"><?php echo $total_capacidade_turno["HP"] + $total_capacidade_turno["NHP"]; ?></div></td>
							<td bgcolor="#B0C4DE"><div align="center" class="style51"><?php echo $total_pneu["HP"] + $total_pneu["NHP"]; ?></div></td>
							<td bgcolor="#B0C4DE"><div align="center" class="style51"><?php echo $total_horas_inv; ?></div></td>
							<td bgcolor="#B0C4DE"><div align="center" class="style51"><?php echo $total_capacidade_24h["HP"] + $total_capacidade_24h["NHP"]; ?></div></td>
							<td bgcolor="#B0C4DE"><div align="center" class="style51"><?php echo $total_c_clamp["HP"] + $total_c_clamp["NHP"]; ?></div></td>
							<td bgcolor="#B0C4DE"><div align="center" class="style51"><?php echo $total_parada_vulca; ?></div></td>
							<td bgcolor="#B0C4DE"><div align="center" class="style51"></div></td>
							<td bgcolor="#B0C4DE">&nbsp;</td>
							<td bgcolor="#B0C4DE" colspan="2"><div align="center" class="style51"></div></td>
							<td bgcolor="#B0C4DE"><div align="center" class="style51"></div></td>
							<td bgcolor="#B0C4DE"><div align="center" class="style51"></div></td>
							
							<td bgcolor="#B0C4DE"><div align="center" class="style51"><?php echo $total_molde_adicional['HP'] + $total_molde_adicional['NHP']; ?></div></td>
							
						</tr>
				
			<?php
					}
				}
			?>
            
			
			
			<?php
					
					if($qtd_total_capac_turno > 0){
						$total_parada_vulca = round(($qtd_total_pneu / $qtd_total_capac_turno) * $horas_turno,2);
						$total_horas_inv = round((($total_parada_vulca - floor($total_parada_vulca))*0.599) + floor($total_parada_vulca),2);
					}else{
						$total_parada_vulca = 0;
						$total_horas_inv = 0;
					}
					
					if($qtd_total_capac_turno_TBM > 0){
						$total_parada_vulca_TBM = round(($qtd_total_pneu_TBM / $qtd_total_capac_turno_TBM) * $horas_turno,2);
						$total_horas_inv_TBM = round((($total_parada_vulca_TBM - floor($total_parada_vulca_TBM))*0.599) + floor($total_parada_vulca_TBM),2);
					}else{
						$total_parada_vulca_TBM = 0;
						$total_horas_inv_TBM = 0;
					}
					
					if($qtd_total_capac_turno > 0){
						$total_parada_vulca_NT = round((($qtd_total_pneu - $qtd_total_pneu_TBM) / ($qtd_total_capac_turno - $qtd_total_capac_turno_TBM)) * $horas_turno,2);
						$total_horas_inv_NT = round((($total_parada_vulca_NT - floor($total_parada_vulca_NT))*0.599) + floor($total_parada_vulca_NT),2);
					}else{
						$total_parada_vulca_NT = 0;
						$total_horas_inv_NT = 0;
					}
			?>
			<tr>
				<td colspan="14">&nbsp</td>
			</tr>
			
			<tr>
				<td bgcolor="#B0C4DE"><div align="center" class="style51"><?php echo $qtd_tipo_TBM; ?></div></td>
				<td bgcolor="#B0C4DE"><div align="center" class="style51">TBM</div></td>
				<td bgcolor="#B0C4DE"><div align="center" class="style51"><?php echo $qtd_TBM; ?></div></td>
				<td bgcolor="#B0C4DE"><div align="center" class="style51"><?= $qtd_total_capac_turno_TBM;?></div></td>
				<td bgcolor="#B0C4DE"><div align="center" class="style51"><?= $qtd_total_pneu_TBM;?></div></td>
				<td bgcolor="#B0C4DE"><div align="center" class="style51"><?= $total_horas_inv_TBM;?></div></td>
				<td bgcolor="#B0C4DE"><div align="center" class="style51"><?php echo $qtd_total_capac_24h_TBM; ?></div></td>
				<td bgcolor="#B0C4DE"><div align="center" class="style51"><?= $qtd_total_cclamp_TBM;?></div></td>
				<td bgcolor="#B0C4DE"><div align="center" class="style51"><?= $total_parada_vulca_TBM;?></div></td>
				<td bgcolor="#B0C4DE"><div align="center" class="style51"></div></td>
				<td colspan="4" bgcolor="#B0C4DE"><div align="center" class="style5 style7"></div></td>
				<td bgcolor="#B0C4DE"><div align="center" class="style6"></div></td>
				
				<td bgcolor="#B0C4DE"><div align="center" class="style51"></div></td>
				
			</tr>
			
			<tr>
				<td bgcolor="#B0C4DE"><div align="center" class="style51"><?php echo ($qtd_tipo_pneu - $qtd_tipo_TBM); ?></div></td>
				<td bgcolor="#B0C4DE"><div align="center" class="style51">Tradicional</div></td>
				<td bgcolor="#B0C4DE"><div align="center" class="style51"><?php echo ($qtd_total_moldes - $qtd_TBM); ?></div></td>
				<td bgcolor="#B0C4DE"><div align="center" class="style51"><?= ($qtd_total_capac_turno - $qtd_total_capac_turno_TBM);?></div></td>
				<td bgcolor="#B0C4DE"><div align="center" class="style51"><?= ($qtd_total_pneu - $total_pneu['Unisteel'] - $qtd_total_pneu_TBM)?></div></td>
				<td bgcolor="#B0C4DE"><div align="center" class="style51"><?= $total_horas_inv_NT;?></div></td>
				<td bgcolor="#B0C4DE"><div align="center" class="style51"><?php echo ($qtd_total_capac_24h - $qtd_total_capac_24h_TBM)?></div></td>
				<td bgcolor="#B0C4DE"><div align="center" class="style51"><?= ($qtd_total_cclamp - $qtd_total_cclamp_TBM)?></div></td>
				<td bgcolor="#B0C4DE"><div align="center" class="style51"><?= $total_parada_vulca_NT;?></div></td>
				<td bgcolor="#B0C4DE"><div align="center" class="style51"></div></td>
				<td colspan="4" bgcolor="#B0C4DE"><div align="center" class="style5 style7"></div></td>
				<td bgcolor="#B0C4DE"><div align="center" class="style6"></div></td>

				<td bgcolor="#B0C4DE"><div align="center" class="style51"></div></td>
				
			</tr>
			
			
			<tr>
				<td bgcolor="#B0C4DE"><div align="center" class="style51"><?php echo $qtd_tipo_pneu; ?></div></td>
				<td bgcolor="#B0C4DE"><div align="center" class="style51">GERAL</div></td>
				<td bgcolor="#B0C4DE"><div align="center" class="style51"><?php echo $qtd_total_moldes; ?></div></td>
				<td bgcolor="#B0C4DE"><div align="center" class="style51"><?php echo $qtd_total_capac_turno; ?></div></td>
				<td bgcolor="#B0C4DE"><div align="center" class="style51"><?php echo ($qtd_total_pneu - $total_pneu['Unisteel']); ?></div></td>
				<td bgcolor="#B0C4DE"><div align="center" class="style51"><?php echo $total_horas_inv; ?></div></td>
				<td bgcolor="#B0C4DE"><div align="center" class="style51"><?php echo $qtd_total_capac_24h; ?></div></td>
				<td bgcolor="#B0C4DE"><div align="center" class="style51"><?php echo $qtd_total_cclamp; ?></div></td>
				<td bgcolor="#B0C4DE"><div align="center" class="style51"><?php echo $total_parada_vulca; ?></div></td>
				<td bgcolor="#B0C4DE"><div align="center" class="style51"></div></td>
				<td colspan="4" bgcolor="#B0C4DE"><div align="center" class="style5 style7">TOTAL GERAL</div></td>
				<td bgcolor="#B0C4DE"><div align="center" class="style6"><?php echo ($qtd_total_pneu - $total_pneu['Unisteel']); ?></div></td>
				
				<td bgcolor="#B0C4DE"><div align="center" class="style51"></div></td>
	
			</tr>
			
			
			<tr>
			  <td colspan="2" bgcolor="#B0C4DE"><div align="center" class="style5">CAV. ESTRUTUTAL</div></td>
			  <td bgcolor="#B0C4DE"><div align="center"><span class="style5"><?php echo (300 - $qtd_total_moldes); ?></span></div></td>
			  <td>&nbsp;</td>
			  <td colspan="2">&nbsp;</td>
			  <td>&nbsp;</td>
			  <td>&nbsp;</td>
			  <td bgcolor="#B0C4DE"><div align="center"><span class="style5">MOLDES</span></div></td>
			  <td bgcolor="#B0C4DE"><div align="center"><span class="style5">TIPOS</span></div></td>
			  <td colspan="4"><div align="center"><span class="style51">TOTAL Q</span></div></td>
			  <td class="style51"><div align="center"><?php echo $total_pneu['HP'] + $total_pneu['NHP']; ?></div></td>
			  
			  <td class="style51"><div align="center"></div></td>
			  
		  </tr>
			<tr>
				<td colspan="3" rowspan="2" bgcolor="#B0C4DE"><div align="center" class="style5">OPEN/CLOSE ESPERADO</div></td>
				<td rowspan="2" bgcolor="#B0C4DE"><div align="center" class="style5"><?php echo $openclose_medio_padrao; ?></div></td>
				<td colspan="2" rowspan="2" bgcolor="#B0C4DE"><div align="center" class="style5">CICLO MEDIO ESPERADO</div></td>
				<td rowspan="2" bgcolor="#B0C4DE"><div align="center" class="style5"><?php echo $ciclo_medio_com_openclose; ?></div></td>
				<td bgcolor="#B0C4DE"><div align="center"><span class="style5">NT</span></div></td>
				<td><div align="center"><span class="style5"><?php echo ($qtd_total_moldes - $qtd_TBM); ?></span></div></td>
				<td><div align="center"><span class="style5"><?php echo ($qtd_tipo_pneu - $qtd_tipo_TBM); ?></span></div></td>
				<td colspan="4"><div align="center" class="style51">TOTAL W</div></td>
				<td class="style51"><div align="center" class="style51"><div align="center"><?php echo $total_pneu['TAW']; ?></div></div></td>
				
				<td class="style51"><div align="center" class="style51"></div></td>
				
			</tr>
			<tr>
			  <td bgcolor="#B0C4DE"><div align="center"><span class="style5">TBM</span></div></td>
			  <td><div align="center"><span class="style5"><?php echo $qtd_TBM; ?></span></div></td>
			  <td><div align="center"><span class="style5"><?php echo $qtd_tipo_TBM; ?></span></div></td>
			  <td colspan="4"><div align="center"><span class="style51">TOTAL L</span></div></td>
			  <td class="style51"><div align="center"><?php echo $total_pneu['Wrangler']; ?></div></td>
			  
			  <td class="style51"><div align="center"></div></td>
			  
		  </tr>
			<tr align="center">
				<td colspan="9">&nbsp </td>
				<td bgcolor="#B0C4DE" class="style5">Linha</td>
				<td colspan="4" bgcolor="#B0C4DE" class="style5">Capacidade 100%</td>
				<td bgcolor="#B0C4DE" class="style5">Capacidade 97%</td>
				
				<td bgcolor="#B0C4DE" class="style5"></td>
				
			</tr>
			<tr align="center">
				<td colspan="9">&nbsp </td>
				<td bgcolor="#B0C4DE" class="style5">HP</td>
				<td colspan="4" class="style5"><?php echo $qtd_total_capac_24h_tipo['HP'];?></td>
				<td class="style5"><?php echo round($qtd_total_capac_24h_tipo['HP'] * 0.97);?></td>
				
				<td class="style5"></td>
				
			</tr>
			<tr align="center">
				<td colspan="9">&nbsp </td>
				<td bgcolor="#B0C4DE" class="style5">NHP</td>
				<td colspan="4" class="style5"><?php echo $qtd_total_capac_24h_tipo['NHP']; ?></td>
				<td class="style5"><?php echo round($qtd_total_capac_24h_tipo['NHP'] * 0.97);?></td>
				
				<td class="style5"></td>
				
			</tr>
			<?php /*
			<tr align="center">
				<td colspan="9">&nbsp </td>
				<td bgcolor="#B0C4DE" class="style5">WBR</td>
				<td colspan="4" class="style5"><?php echo $total_capacidade_24h['Passageiro']; ?></td>
				<td class="style5"><?php echo round($total_capacidade_24h['Passageiro'] * 0.97); ?></td>
			</tr>*/
			?>
			<!--<tr align="center">
				<td colspan="9">&nbsp </td>
				<td bgcolor="#B0C4DE" class="style5">DURATRAC</td>
				<td colspan="4" class="style5"><?php /*echo $qtd_total_capac_24h_tipo['DURATRAC']; */?></td>
				<td class="style5"><?php /*echo round($qtd_total_capac_24h_tipo['DURATRAC'] * 0.97); */?></td>
				
				<td class="style5"></td>
				
			</tr>-->
			<tr align="center">
				<td colspan="9">&nbsp </td>
				<td bgcolor="#B0C4DE" class="style5">WRANGLER</td>
				<td colspan="4" class="style5"><?php echo $total_capacidade_24h['Wrangler']; ?></td>
				<td class="style5"><?php echo round($total_capacidade_24h['Wrangler'] * 0.97); ?></td>
				
				<td class="style5"></td>
				
			</tr>
			<tr align="center">
				<td colspan="9">&nbsp </td>
				<td bgcolor="#B0C4DE" class="style5">TAW</td>
				<td colspan="4" class="style5"><?php echo $total_capacidade_24h['TAW']; ?></td>
				<td class="style5"><?php echo round($total_capacidade_24h['TAW'] * 0.97); ?></td>
				
				<td class="style5"></td>
				
			</tr>
			<tr align="center">
				<td colspan="9">&nbsp </td>
				<td bgcolor="#B0C4DE" class="style5">Total</td>
				<td bgcolor="#B0C4DE" colspan="4" class="style5">
                    <?php
                    $qtd_total_capac_24hh = $qtd_total_capac_24h_tipo['HP'] + $qtd_total_capac_24h_tipo['NHP'] + $total_capacidade_24h['Wrangler'] + $total_capacidade_24h['TAW'];
                    //$qtd_total_capac_24h = $qtd_total_capac_24h - $qtd_total_capac_24h_tipo['DURATRAC'];
                    echo $qtd_total_capac_24hh;
                    ?>
                </td>
				<td bgcolor="#B0C4DE" class="style5"><?php echo round($qtd_total_capac_24hh * 0.97); ?></td>
				
				<td bgcolor="#B0C4DE" class="style5"></td>
			</tr>
			
			<tr>
			  <td bgcolor="#B0C4DE" colspan="16"><div align="center"><span class="style5">Pneus Retidos</span></div></td>
		  </tr>
		  
            <?php
				for($x=0;$x<sizeof($pneus_retidos_gt);$x++){
			?>
            
            <tr>
				<td><div align="center" class="style5"><?php if($pneu_TBM[$pneus_retidos_gt[$x]]){echo 'TBM';} ?></div></td>
				<td colspan="3"><div align="center" class="style5"><?php echo $pneus_retidos_gt[$x]; ?></div>				  <div align="center" class="style3"></div>				  <div align="center" class="style4"></div></td>
				<td><div align="center" class="style5"><?php echo $pneus_retidos_qtd[$x]; ?></div></td>
				<td colspan="3"><div align="center" class="style3"><?php echo utf8_encode($pneus_retidos_motivo[$x]); ?></div></td>
				<td><div align="center" class="style3"></div></td>
				<td><div align="center" class="style3"></div></td>
				<td><div align="center" class="style3"></div></td>
				<td colspan="3"><div align="center" class="style3"></div></td>
				<td colspan="2"><div align="center" class="style3"></div></td>
			</tr>
			
            <?php
				}
			?>
            
            <tr>
			  <td bgcolor="#B0C4DE"><div align="center" class="style5"></div></td>
				<td colspan="3" bgcolor="#B0C4DE"><div align="center" class="style5">TOTAL RETIDO</div>				  <div align="center" class="style3"></div>				  <div align="center" class="style4"></div></td>
				<td bgcolor="#B0C4DE"><div align="center" class="style5"><?php echo $qtd_total_pneus_retidos; ?></div></td>
				<td colspan="3" bgcolor="#B0C4DE"><div align="center" class="style3"></div></td>
				<td bgcolor="#B0C4DE"><div align="center" class="style3"></div></td>
				<td bgcolor="#B0C4DE"><div align="center" class="style3"></div></td>
				<td bgcolor="#B0C4DE"><div align="center" class="style3"></div></td>
				<td colspan="3" bgcolor="#B0C4DE"><div align="center" class="style3"></div></td>
				<td colspan="2" bgcolor="#B0C4DE"><div align="center" class="style3"></div></td>
			</tr>
		</table>
		
	
</body>
</html>