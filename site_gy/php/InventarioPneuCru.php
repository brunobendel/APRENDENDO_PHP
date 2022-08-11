<?php   
        require_once('connect.php');
        
        $data = date('d/m/Y');

        $sql = "SELECT  SUM(I.qtd) PNEU_CRU FROM
            TB_INV_PNEU I 
            LEFT JOIN TB_PNEU P ON P.CODGT = I.CODGT 
            LEFT JOIN TB_FAMILIA F ON F.IDFAMILIA = P.IDFAMILIA 
            WHERE 
            I.idinvhistorico = (select max(IDINVHISTORICO) from tb_inv_historico where DATA_INVENTARIO = to_date('$data','dd/mm/yyyy') and IDDIVISAO=1) 
            AND DESCRICAO NOT LIKE 'Unisteel' 
            AND (I.qtd > 0 OR I.qtd_retido > 0 OR I.qtd_moldes > 0) ORDER BY F.DESCRICAO, I.codgt";
                         
            $stmt_temp = connect_inv($sql);

            if(OCIExecute($stmt_temp)){
                $cont = 0;
                while(OCIFetchInto($stmt_temp, $linha, OCI_ASSOC)){
                    $cont++;
                    ?>
                    <tr>
                        <?php 

                        $aceitavel = $linha['PNEU_CRU'] - ($linha['PNEU_CRU'] * 0.15);
                        if ($linha['PNEU_CRU'] >= 8000) {
                            ?>
                            <td><button class="btn btn-success btn-icon btn-circle"><i class="icon"></i></button></td>
                            <?php
                        } elseif ($linha['PNEU_CRU'] >= $aceitavel && $linha['PNEU_CRU'] <= 8000) {
                            ?>
                            <td><button class="btn btn-warning btn-icon btn-circle"><i class="icon"></i></button></td>
                            <?php
                        } elseif ($linha['PNEU_CRU'] <= $aceitavel) {
                            ?>
                            <td><button class="btn btn-danger btn-icon btn-circle"><i class="icon"></i></button></td>
                            <?php
                        }
                        ?>
                        <td><?php echo $data; ?></td>
                        <td><?php echo "GT"; ?></td>
                        <td><?php echo "PENU CRU"; ?></td>
                        <td><?php echo "8.000"; ?></td>
                        <td><?php echo number_format($linha['PNEU_CRU'],0,",","."); ?></td>
                        <td><?php echo "Unidades"; ?></td>
                        <?php
                            if ($linha['PNEU_CRU'] >= 8000) {
                                ?>
                                <td><?php echo "Ideal"; ?></td>
                                <?php
                            } elseif ($linha['PNEU_CRU'] >= $aceitavel && $linha['PNEU_CRU'] <= 8000) {
                                ?>
                                <td><?php echo "Suficiente"; ?></td>
                                <?php
                            } else {
                                ?>
                                <td><?php echo "Inventário Baixo"; ?></td>
                                <?php
                            }
                        ?>
                    </tr>     
                    <?php
                }
            } else {
                echo "Aconteceu um erro no resultado da consulta!";
            }
