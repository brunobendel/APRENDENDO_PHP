<?php
    if ($data == date('d/m/Y')) {

        //include_once ('InventarioPneuCru.php');
        
        $link = "http://10.104.129.20/appl_folder/visual_ra.xml";
    
        $xml = simplexml_load_file($link);
        
        foreach($xml as $item){
            $inventario = $inventario + (float)utf8_decode($item->invent);
        } 
    ?>
                    <tr>
                        <?php 
                        $objetivo = 7000;
                        $aceitavel = $objetivo - ($objetivo * 0.15);
                        if ($inventario >= $objetivo) {
                            ?>
                            <td><button class="btn btn-success btn-icon btn-circle"><i class="icon"></i></button></td>
                            <?php
                        } elseif ($inventario >= $aceitavel && $aceitavel <= $objetivo) {
                            ?>
                            <td><button class="btn btn-warning btn-icon btn-circle"><i class="icon"></i></button></td>
                            <?php
                        } elseif ($inventario <= $aceitavel) {
                            ?>
                            <td><button class="btn btn-danger btn-icon btn-circle"><i class="icon"></i></button></td>
                            <?php
                        }
                        ?>
                        <td><?php echo $data; ?></td>
                        <td><?php echo "RA"; ?></td>
                        <td><?php echo "MONO COMPONENTE"; ?></td>
                        <td><?php echo "7.000"; ?></td>
                        <td><?php echo number_format($inventario,0,",","."); ?></td>
                        <td><?php echo "Metros"; ?></td>
                        <?php
                            if ($inventario >= $objetivo) {
                                ?>
                                <td><?php echo "Ideal"; ?></td>
                                <?php
                            } elseif ($inventario >= $aceitavel && $inventario <= $objetivo) {
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
    else {
     
    }    
?>