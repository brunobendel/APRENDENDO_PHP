<?php
  
  require_once('php/connect.php');

  $sql = "SELECT * FROM BALANCEAMENTO WHERE TO_CHAR(DATA_LANC,'DD/MM/YYYY') >= TO_CHAR(CURRENT_DATE-5,'DD/MM/YYYY')";

  $stmt_temp = connect_brppp($sql);
  
  if(OCIExecute($stmt_temp)){
      $cont = 0;
      while(OCIFetchInto($stmt_temp, $linha, OCI_ASSOC)){
        $cont++;
        ?>
            <tr>
                <td><?php echo date('d/m/Y',strtotime($linha['DATA_LANC']));?></td>
                <td><?php echo $linha['PNEU'];?></td>
                <td><?php echo $linha['PNEU_PROG'];?></td>
                <td><?php echo $linha['LONA_1'];?></td>
                <td><?php echo $linha['LONA_1_PROG'];?></td>
                <td><?php echo $linha['LONA_1_INVENT'];?></td>
                <td><?php echo $linha['LONA_1_EQP'];?></td>
                <td><?php echo $linha['LONA_2'];?></td>
                <td><?php echo $linha['LONA_2_PROG'];?></td>
                <td><?php echo $linha['LONA_2_INVENT'];?></td>
                <td><?php echo $linha['LONA_2_EQP'];?></td>  
                <td><?php echo $linha['MAQUINA'];?></td>  
                <td><button data-target="#demo-default-modal<?php echo $cont; ?>" data-toggle="modal" class="btn btn-mint btn-sm"><i class="demo-psi-pen-5 icon-lg"></i></button></td>              
            </tr>        
            <div class="modal fade" id="demo-default-modal<?php echo $cont; ?>" role="dialog" tabindex="-1" aria-labelledby="demo-default-modal" aria-hidden="true" style="display: none;">
        <div class="modal-dialog">
            <div class="modal-content">

                <!--Modal header-->
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal"><i class="pci-cross pci-circle"></i></button>
                    <h4 class="modal-title">Balanceamento <?php echo $cont; ?></h4>
                </div>

                <!--Modal body-->
                <div class="modal-body">
                <form class="form-horizontal" id="" method="POST">
					                <div class="panel-body">
					                    <div class="form-group">
					                        <label class="col-sm-2 control-label" for="demo-hor-inputemail">Pneu</label>
					                        <div class="col-sm-3">
					                            <input type="text" class="form-control" value="<?php echo $linha['PNEU'];?>" required>
					                        </div>
                                            <label class="col-sm-2 control-label" for="demo-hor-inputpass">Programado</label>
					                        <div class="col-sm-2">
                                                <input type="number" class="form-control" value="<?php echo $linha['PNEU_PROG'];?>" required>
					                        </div>
					                    </div>
                                        <br>
                                        <br>
					                    <div class="form-group">
                                            <label class="col-sm-2 control-label" for="demo-hor-inputpass">1° Lona</label>
					                        <div class="col-sm-3">
                                                <input type="text" value="<?php echo $linha['LONA_1'];?>" class="form-control">
					                        </div>
                                            <label class="col-sm-2 control-label" for="demo-hor-inputpass">Inventario</label>
					                        <div class="col-sm-2">
                                                <input type="number" value="<?php echo $linha['LONA_1_INVENT'];?>" class="form-control">
					                        </div>
                                            <div class="col-sm-2">
                                                <input type="number" value="<?php echo $linha['LONA_1_EQP'];?>" class="form-control">
					                        </div>
					                    </div>
                                        <br>
                                        <br>
                                        <div class="form-group">
                                            <label class="col-sm-5 control-label text-right" for="demo-hor-inputpass">Programado</label>
					                        <div class="col-sm-2">
                                                <input type="number" value="<?php echo $linha['LONA_1_PROG'];?>" class="form-control">
					                        </div>
					                    </div>
                                        <br>
                                        <br>
                                        <div class="form-group">
                                            <label class="col-sm-2 control-label" for="demo-hor-inputpass">2° Lona</label>
					                        <div class="col-sm-3">
                                                <input type="text" value="<?php echo $linha['LONA_2'];?>" class="form-control">
					                        </div>
                                            <label class="col-sm-2 control-label" for="demo-hor-inputpass">Inventario</label>
					                        <div class="col-sm-2">
                                                <input type="number" value="<?php echo $linha['LONA_2_INVENT'];?>" class="form-control">
					                        </div>
                                            <div class="col-sm-2">
                                                <input type="number" value="<?php echo $linha['LONA_2_EQP'];?>" class="form-control">
					                        </div>
					                    </div>
                                        <br>
                                        <br>
                                        <div class="form-group">
                                            <label class="col-sm-5 control-label text-right" for="demo-hor-inputpass">Programado</label>
					                        <div class="col-sm-2">
                                                <input type="number" value="<?php echo $linha['LONA_2_PROG'];?>" class="form-control">
					                        </div>
					                    </div>
					                </div>
                                    <!--Modal footer-->
                                    <div class="modal-footer">
                                        <button data-dismiss="modal" class="btn btn-default" type="button">Fechar</button>
                                        <button class="btn btn-danger" id="Excluir">Excluir</button>
                                        <button class="btn btn-primary" id="Alterar">Alterar</button>
                                    </div>
			    </form>
                </div>
            </div>
        </div>
        <?php
      }
  }
 
?>
