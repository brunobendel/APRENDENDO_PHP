<?php
  error_reporting(E_ALL & ~E_NOTICE & ~E_WARNING);  
  
  require_once('connect.php');
  
  $meses = [
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
    '12'=>'Dezembro'
];
  
  $sextoSQL = date("d/m/Y",strtotime(date("Y-m-d")."-6 month"));  
  $zeroSQL = date("d/m/Y",strtotime(date("Y-m-d")));
  $sexto = date("m",strtotime(date("Y-m-d")."-6 month"));
  $quinto = date("m",strtotime(date("Y-m-d")."-5 month"));
  $quarto = date("m",strtotime(date("Y-m-d")."-4 month"));
  $terceiro = date("m",strtotime(date("Y-m-d")."-3 month"));
  $segundo = date("m",strtotime(date("Y-m-d")."-2 month"));
  $primeiro = date("m",strtotime(date("Y-m-d")."-1 month"));
  $zero = date("m",strtotime(date("Y-m-d")));

/*  $sql = "SELECT 
    * 
    FROM (
    SELECT 
    TO_CHAR(PRD_DTTIME,'MM') MES,
    PRD_SPEC_NAME as CT, 
    SUM(PRD_CNT) As QTD 
    FROM 
    FAM_PRODUCTION_LOG 
    WHERE 
    PRD_SPEC_NAME LIKE 'CT%' 
    AND PRD_DTTIME >= TO_DATE('{$sextoSQL}','DD/MM/YYYY') 
    AND PRD_DTTIME <= TO_DATE('{$zeroSQL}','DD/MM/YYYY') 
    Group BY 
    TO_CHAR(PRD_DTTIME,'MM'), 
    PRD_SPEC_NAME, PRD_CNT ) 
    PIVOT ( 
    SUM (QTD) for MES in ('{$sexto}','{$quinto}','{$quarto}','{$terceiro}','{$segundo}','{$primeiro}','{$zero}')
      )";
*/
/*
    $sql = "SELECT 
    *
    FROM (
SELECT 
  * 
  FROM ( 
    SELECT 
      TO_CHAR(PRD_DTTIME,'MM') MES, 
      PRD_SPEC_NAME as CT, 
      SUM(PRD_CNT) As QTD 
    FROM 
      FAM_PRODUCTION_LOG 
    WHERE 
      PRD_SPEC_NAME LIKE 'CT%' 
      AND PRD_DTTIME >= TO_DATE('{$sextoSQL}','DD/MM/YYYY') 
      AND PRD_DTTIME <= TO_DATE('{$zeroSQL}','DD/MM/YYYY') 
    Group BY TO_CHAR(PRD_DTTIME,'MM'), 
    PRD_SPEC_NAME, PRD_CNT ) 
    PIVOT ( SUM (QTD) for MES in ('{$sexto}','{$quinto}','{$quarto}','{$terceiro}','{$segundo}','{$primeiro}','{$zero}') ) ) A 
    RIGHT JOIN (
    SELECT 
    TO_CHAR(MAX(PRD_DTTIME) + 180,'dd/mm/yyyy') AS ULTIMAPROD,
    PRD_SPEC_NAME AS CT
FROM    
    FAM_PRODUCTION_LOG
WHERE
    PRD_SPEC_NAME LIKE 'CT%'
GROUP BY
    PRD_SPEC_NAME
 ) B
ON A.CT = B.CT
";
*/


/* ---------- VERSAO FINAL
$sql = "
select * 
from (
        select 
            prd_spec_name,
            TO_CHAR(MAX(PRD_DTTIME) + 180,'dd/mm/yyyy') AS ULTIMAPROD  
        from fam_production_log
        where
            prd_spec_name IN ( select bom_ctcode from sap_zlacmpp_019 )
        group by
            prd_spec_name
    ) a left join (
        SELECT * FROM (
            SELECT
                TO_CHAR(PRD_DTTIME,'MM') MES,
                PRD_SPEC_NAME as CT,
                SUM(PRD_CNT) As QTD
            FROM
                FAM_PRODUCTION_LOG
            WHERE
                PRD_SPEC_NAME LIKE 'CT%'
                AND PRD_DTTIME >= TO_DATE('{$sextoSQL}','DD/MM/YYYY') 
                AND PRD_DTTIME <= TO_DATE('{$zeroSQL}','DD/MM/YYYY') 
            Group BY TO_CHAR(PRD_DTTIME,'MM'), PRD_SPEC_NAME, PRD_CNT 
        )
        PIVOT ( SUM (QTD) for MES in ('{$sexto}','{$quinto}','{$quarto}','{$terceiro}','{$segundo}','{$primeiro}','{$zero}') )    
    ) b on a.prd_spec_name = b.CT
";
*/


/*  $sql = "
  SELECT * FROM(
    SELECT * FROM(SELECT 
        TO_CHAR(PV.dtprod, 'MM') MES, 
        P.code as CT, 
        SUM(PV.qty) As QTD
    FROM 
        ctblprodlineev@BR02SP01D_MWS PV, ctblprodline@BR02SP01D_MWS PL
        INNER JOIN tblwohd@BR02SP01D_MWS W ON W.idwohd = PL.idwohd
        INNER JOIN tblproduct@BR02SP01D_MWS P ON W.idproduct = P.idproduct
        INNER JOIN tblresource@BR02SP01D_MWS RE ON RE.idresource = PL.idresource
    WHERE 
        PV.dtdelete IS NULL 
        AND PV.idlot IS NULL 
        AND PL.seqprodline = PV.seqprodline 
        AND PL.version = PV.version 
        AND PL.idresource = PV.idresource  
        AND PL.dtprod = PV.dtprod 
        AND PL.shift = PV.shift 
        AND P.Code IN( select distinct bom_ctcode from sap_zlacmpp_019 ) 
    GROUP BY 
        TO_CHAR(PV.dtprod, 'MM'),
        p.code
    )
    PIVOT (SUM (QTD) for MES in ('{$sexto}','{$quinto}','{$quarto}','{$terceiro}','{$segundo}','{$primeiro}','{$zero}'))
        ) A RIGHT JOIN (
    SELECT
        cts.bom_ctcode as CT,
        TO_CHAR(MAX(PV.dtprod) + 180, 'DD/MM/YYYY') as ULTIMAPROD
    FROM
        ctblprodlineev@BR02SP01D_MWS PV, ctblprodline@BR02SP01D_MWS PL
        INNER JOIN tblwohd@BR02SP01D_MWS W ON W.idwohd = PL.idwohd
        INNER JOIN tblproduct@BR02SP01D_MWS P ON W.idproduct = P.idproduct
        INNER JOIN tblresource@BR02SP01D_MWS RE ON RE.idresource = PL.idresource
        LEFT JOIN sap_zlacmpp_019 CTS ON CTS.bom_ctcode = p.code
    WHERE
        PV.dtdelete IS NULL
        AND PV.dtprod >= TO_DATE ('{$sextoSQL}','DD/MM/YYYY')
        AND PV.dtprod <= TO_DATE ('{$zeroSQL}','DD/MM/YYYY')
        AND PL.seqprodline = PV.seqprodline AND PL.version = PV.version
        AND PL.idresource = PV.idresource  AND PL.dtprod = PV.dtprod
    GROUP BY
        cts.bom_ctcode) B
        ON A.CT = B.CT    
  ";
*/
  
  $sql = "SELECT * FROM RELEASEC";

  $stmt_temp = connect_brfam($sql);

  /*$n_mes = new DateTime();
  $sex = $n_mes->sub(new dateInterval('P6M'));

  $i = 6;
  for($i<= ,$i++){
    $sex - 1;
  }*/

  $sex = new DateTime();
  $sex->sub(new dateInterval('P6M')); 

  $qui = new DateTime();
  $qui->sub(new dateInterval('P5M')); 

  $qua = new DateTime();
  $qua->sub(new dateInterval('P4M')); 

  $ter = new DateTime();
  $ter->sub(new dateInterval('P3M')); 

  $seg = new DateTime();
  $seg->sub(new dateInterval('P2M')); 

  $pri = new DateTime();
  $pri->sub(new dateInterval('P1M')); 

  $atu = new DateTime();
  
  ?>
    <div class="row">
        <div class="col-sm-6 table-toolbar-left">
        <button class="btn btn-default" onclick="exceller()"><i class="demo-pli-printer"></i></button>
        </div>
    </div>
    <table id="demo-dt-selection" class="table table-striped table-bordered" cellspacing="0" width="100%">
        <thead>
            <tr>
                <th></th>
                <th>Validade</th> 
                <th>CT</th>
                <th><?php echo $meses[$sex->format('m')]; ?></th>
                <th><?php echo $meses[$qui->format('m')]; ?></th>
                <th><?php echo $meses[$qua->format('m')]; ?></th>
                <th><?php echo $meses[$ter->format('m')]; ?></th>
                <th><?php echo $meses[$seg->format('m')]; ?></th>
                <th><?php echo $meses[$pri->format('m')]; ?></th>
                <th><?php echo $meses[$atu->format('m')]; ?></th>
            </tr>
        </thead>
        <tbody>
  <?php
  if(OCIExecute($stmt_temp)){
      $cont = 0;
      while(OCIFetchInto($stmt_temp, $linha, OCI_ASSOC)){
        $cont++;
        $validade = DateTime::createFromFormat('d/m/Y', $linha['DATA']);
        
        $mes = new DateTime();
        $mes->add(new dateInterval('P1M'));
        $hoje = new DateTime();
        ?>
             <tr>
                <?php if ($validade >= $hoje) { 
                        if ($validade >= $hoje && $validade <= $mes) {
                          ?>
                            <td><span class="label label-table label-warning">Atenção</span></td>
                          <?
                        } else {
                          ?>
                            <td><span class="label label-table label-success">Válido</span></td>
                          <?php
                        }
                } else {
                  ?>
                     <td><span class="label label-table label-danger">Vencido</span></td>
                  <?
                }
                ?>
                <td><?php echo $linha['DATA']; ?></td>
                <td><?php echo $linha['CT']; ?></td>
                <td><?php echo $linha["'$sexto'"]; ?></td>
                <td><?php echo $linha["'$quinto'"]; ?></td>
                <td><?php echo $linha["'$quarto'"]; ?></td>
                <td><?php echo $linha["'$terceiro'"]; ?></td>
                <td><?php echo $linha["'$segundo'"]; ?></td>
                <td><?php echo $linha["'$primeiro'"]; ?></td>
                <td><?php echo $linha["'$zero'"]; ?></td>
            </tr>        
        <?php
      }
  }
?>
</tbody>
</table>