<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta http-equiv="refresh" content="300">
	
    <title>Dashboard | Inventário</title>

    <!--STYLESHEET-->
    <!--=================================================-->

    <!--Open Sans Font [ OPTIONAL ]-->
    <link href='https://fonts.googleapis.com/css?family=Open+Sans:400,300,600,700' rel='stylesheet' type='text/css'>


    <!--Bootstrap Stylesheet [ REQUIRED ]-->
    <link href="css/bootstrap.min.css" rel="stylesheet">

    <!--Nifty Stylesheet [ REQUIRED ]-->
    <link href="css/nifty.min.css" rel="stylesheet">

    <!--Nifty Premium Icon [ DEMONSTRATION ]-->
    <link href="css/demo/nifty-demo-icons.min.css" rel="stylesheet">
    <link href="plugins/bootstrap-select/bootstrap-select.min.css" rel="stylesheet">
    <link href="plugins/select2/css/select2.min.css" rel="stylesheet">
    <!--=================================================-->

    <!--Pace - Page Load Progress Par [OPTIONAL]-->
    <link href="plugins/pace/pace.min.css" rel="stylesheet">
    <script src="plugins/pace/pace.min.js"></script>

    <!--Demo [ DEMONSTRATION ]-->
    <link href="css/demo/nifty-demo.min.css" rel="stylesheet">
    
    <!--DataTables [ OPTIONAL ]-->
    <link href="plugins/datatables/media/css/dataTables.bootstrap.css" rel="stylesheet">
    <link href="plugins/datatables/extensions/Responsive/css/responsive.dataTables.min.css" rel="stylesheet">

    <link href="css/font-awesome/css/font-awesome.min.css" rel="stylesheet">
</head>

<!--TIPS-->
<!--You may remove all ID or Class names which contain "demo-", they are only used for demonstration. -->
<body>
    <div id="container" class="effect aside-float aside-bright mainnav-lg">
        
        <!--NAVBAR-->
        <!--===================================================-->
        <header id="navbar">
            <div id="navbar-container" class="boxed">

                <!--Brand logo & name-->
                <!--================================-->
                <div class="navbar-header">
                    <a href="index.php" class="navbar-brand">
                        <img src="img/logo.png" alt="Nifty Logo" class="brand-icon">
                        <div class="brand-title">
                            <span class="brand-text">PPP</span>
                        </div>
                    </a>
                </div>
                <!--================================-->
                <!--End brand logo & name-->


                <!--Navbar Dropdown-->
                <!--================================-->
                <div class="navbar-content">
                    <ul class="nav navbar-top-links">

                        <!--Navigation toogle button-->
                        <!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
                        <li class="tgl-menu-btn">
                            <a class="mainnav-toggle" href="#">
                                <i class="demo-pli-list-view"></i>
                            </a>
                        </li>
                        <!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
                        <!--End Navigation toogle button-->

                    </ul>
                    <ul class="nav navbar-top-links"></ul>
                    </ul>
                </div>
                <!--================================-->
                <!--End Navbar Dropdown-->

            </div>
        </header>
        <!--===================================================-->
        <!--END NAVBAR-->

        <div class="boxed">

            <!--CONTENT CONTAINER-->
            <!--===================================================-->
            <div id="content-container">
                <div id="page-head">                
                    
                    <!--Page Title-->
                    <!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
                    <div id="page-title">
                        <h1 class="page-header text-overflow">Dashboard</h1>
                    </div>
                    <!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
                    <!--End page title-->

                    <!--Breadcrumb-->
                    <!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
                    <ol class="breadcrumb">
					<li><a href="#"><i class="demo-pli-home"></i></a></li>
                    <li><a href="#">Inventário</a></li>
                    <li><a href="#">Geral</a></li>
                    </ol>
                    <!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
                    <!--End breadcrumb-->

                </div>
                <!--Page content-->
                <!--===================================================-->
                <div id="page-content">
					    <div class="row">
					            <!--===================================================-->
					            <!--End form-group -->
                        </div>   
                        <div class="panel">
                            <div class="panel-body">
                            <?php
                                error_reporting(E_ALL & ~E_NOTICE & ~E_WARNING);

                                require_once('php/connect.php');
								
                                $data = date('d/m/Y',strtotime($_REQUEST['dt_ini']));        
								$data = date('d/m/Y');		
		
                                $sql = "SELECT
											TO_CHAR(PI_DATA, 'DD/MM/YYYY') DATA,
											PI_MATERIAL MATERIAL,
											PI_OBJETIVO OBJETIVO,
											PI_INVENTARIO INVENTARIO,
											PI_UN UN,
											PI_COMENTARIO COMENTARIO
										FROM
											PPP_INVENTARIO
										WHERE
											PI_MATERIAL LIKE '%' AND TO_CHAR(PI_DATA, 'DD/MM/YYYY') = '$data'";
											
                                $stmt_temp = connect_brfam($sql);

                            ?>
                                <table  class="table table-striped table-bordered" cellspacing="0" width="100%">
                                    <thead>
                                        <tr>
                                            <th class=""></th>
                                            <th class="">Data</th>
                                            <th class="min-desktop">Material</th>
                                            <th>Descrição</th>
                                            <th class="min-tablet">Objetivo</th>
                                            <th class="min-tablet">Inventário</th>
                                            <th class="min-tablet">Tipo</th>                                        
                                            <th class="min-tablet">Comentário</th>                                        
                                        </tr>
                                    </thead>
                                    <tbody>
                                    <?php
                                        if(OCIExecute($stmt_temp)){
                                            $cont = 0;
                                            include_once ('php/InventarioGeral.php');
                                        while(OCIFetchInto($stmt_temp, $linha, OCI_ASSOC)){
                                            $cont++;
                                            $aceitavel = $linha['OBJETIVO'] - ($linha['OBJETIVO'] * 0.15);
                                            ?>
                                            <tr><?php

                                                if ($linha['INVENTARIO'] >= $linha['OBJETIVO']) {
                                                    ?>
                                                    <td><button class="btn btn-success btn-icon btn-circle"><i class="icon"></i></button></td>
                                                    <?php
                                                } elseif ($linha['INVENTARIO'] >= $aceitavel && $linha['INVENTARIO'] <= $linha['OBJETIVO']) {
                                                    ?>
                                                    <td><button class="btn btn-warning btn-icon btn-circle"><i class="icon"></i></button></td>
                                                    <?php
                                                } elseif ($linha['INVENTARIO'] <= $aceitavel) {
                                                    ?>
                                                    <td><button class="btn btn-danger btn-icon btn-circle"><i class="icon"></i></button></td>
                                                    <?php
                                                }
                                                ?>
                                                <td><?php echo $data; ?></td>
                                                <td><?php 
                                                    if ($linha['MATERIAL'] == "RODAGEM B1" || $linha['MATERIAL'] == "RODAGEM B2" || $linha['MATERIAL'] == "RODAGEM B1 Q6" || $linha['MATERIAL'] == "RODAGEM B1 D#1") {
                                                        echo "TR";
                                                    } elseif ($linha['MATERIAL'] == "LONA SPOOL" || $linha['MATERIAL'] == "LONA K7") {
                                                        echo "PL";
                                                    } elseif ($linha['MATERIAL'] == "COMPOSTO") {
                                                        echo "CMPD";
                                                    } elseif ($linha['MATERIAL'] == "APEX B1") {
                                                        echo "PX";
                                                    } elseif ($linha['MATERIAL'] == "TIRA DO MEIO") {
                                                        echo "PA";
                                                    } elseif ($linha['MATERIAL'] == "TIRA DE OMBRO B2") {
                                                        echo "DG";
                                                    } elseif ($linha['MATERIAL'] == "LINNER SPOOL" || $linha['MATERIAL'] == "LINNER K7") {
                                                        echo "LN";
                                                    }
                                                    elseif ($linha['MATERIAL'] == "COSTADO B1") {
                                                        echo "SW";
                                                    }
                                                    elseif ($linha['MATERIAL'] == "COSTADO TBM") {
                                                        echo "SW";
                                                    }
													elseif ($linha['MATERIAL'] == "TALÃO IS05" || $linha['MATERIAL'] == "TALÃO IS07") {
                                                        echo "BE";
                                                    }

                                                ?></td>
                                                <td><?php echo $linha['MATERIAL']; ?></td>
                                                <td>
                                                    <?php 
                                                        if ($linha['OBJETIVO'] >= 100000) {
                                                            echo number_format($linha['OBJETIVO'],0,",",".") / 1;
                                                        } else {
                                                            echo number_format($linha['OBJETIVO'],0,",",".");
                                                        } 
                                                    ?>
                                                    </td>
                                                    <td><?php 
                                                    if ($linha['INVENTARIO'] >= 100000) {
                                                        echo number_format($linha['INVENTARIO'],0,",",".") / 1;
                                                    } else {
                                                        echo number_format($linha['INVENTARIO'],0,",",".");
                                                    }                
                                                    ?>
                                                </td>
                                                <td><?php echo $linha['UN']; ?></td>
                                                <?php
                                                    if ($linha['INVENTARIO'] >= $linha['OBJETIVO']) {
                                                        ?>
                                                        <td><?php echo "Ideal"; ?></td>
                                                        <?php
                                                    } elseif ($linha['INVENTARIO'] >= $aceitavel && $linha['INVENTARIO'] <= $linha['OBJETIVO']) {
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
?>
                                            <?php
            
                                            $sql1 = "SELECT  SUM(I.qtd) PNEU_CRU 
													FROM
														TB_INV_PNEU I LEFT JOIN TB_PNEU P ON P.CODGT = I.CODGT 
														LEFT JOIN TB_FAMILIA F ON F.IDFAMILIA = P.IDFAMILIA 
													WHERE 
														I.idinvhistorico = (select max(IDINVHISTORICO) from tb_inv_historico where DATA_INVENTARIO = to_date('$data','dd/mm/yyyy') and IDDIVISAO=1) 
														AND DESCRICAO NOT LIKE 'Unisteel' 
														AND (I.qtd > 0 OR I.qtd_retido > 0 OR I.qtd_moldes > 0) ORDER BY F.DESCRICAO, I.codgt";
                                                        
                                            $stmt_temp1 = connect_inv($sql1);

                                            if(OCIExecute($stmt_temp1)){
                                                $cont = 0;
                                                while(OCIFetchInto($stmt_temp1, $linha, OCI_ASSOC)){
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
                                                        <td><?php echo "PNEU CRU B1"; ?></td>
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
                                            ?>

                                    <?php
                                                
                                                $sql2 = "SELECT  SUM(I.qtd) PNEU_CRU FROM
                                                TB_INV_PNEU I 
                                                LEFT JOIN TB_PNEU P ON P.CODGT = I.CODGT 
                                                LEFT JOIN TB_FAMILIA F ON F.IDFAMILIA = P.IDFAMILIA 
                                                WHERE 
                                                I.idinvhistorico = (select max(IDINVHISTORICO) from tb_inv_historico where DATA_INVENTARIO = to_date('$data','dd/mm/yyyy') and IDDIVISAO=2) 
                                                AND (I.qtd > 0 OR I.qtd_retido > 0 OR I.qtd_moldes > 0) ORDER BY F.DESCRICAO, I.codgt";
                                                            
                                                $stmt_temp2 = connect_inv($sql2);

                                                if(OCIExecute($stmt_temp2)){
                                                    $cont = 0;
                                                    while(OCIFetchInto($stmt_temp2, $linha, OCI_ASSOC)){
                                                        $cont++;
                                                        ?>
                                                        <tr>
                                                            <?php 

                                                            $aceitavel = $linha['PNEU_CRU'] - ($linha['PNEU_CRU'] * 0.15);
                                                            if ($linha['PNEU_CRU'] >= 1500) {
                                                                ?>
                                                                <td><button class="btn btn-success btn-icon btn-circle"><i class="icon"></i></button></td>
                                                                <?php
                                                            } elseif ($linha['PNEU_CRU'] >= $aceitavel && $linha['PNEU_CRU'] <= 1500) {
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
                                                            <td><?php echo "PNEU CRU B2"; ?></td>
                                                            <td><?php echo "1.500"; ?></td>
                                                            <td><?php echo number_format($linha['PNEU_CRU'],0,",","."); ?></td>
                                                            <td><?php echo "Unidades"; ?></td>
                                                            <?php
                                                                if ($linha['PNEU_CRU'] >= 1500) {
                                                                    ?>
                                                                    <td><?php echo "Ideal"; ?></td>
                                                                    <?php
                                                                } elseif ($linha['PNEU_CRU'] >= $aceitavel && $linha['PNEU_CRU'] <= 1500) {
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

                                            } else{
                                                echo "Aconteceu um erro no resultado da consulta!";
                                            }

                                            ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
			        </div>
				</div>	
            </div>
            <!--===================================================-->
            <!--END CONTENT CONTAINER-->
            
                        <!--MAIN NAVIGATION-->
            <!--===================================================-->
            <nav id="mainnav-container">
                <div id="mainnav">

                    <!--Menu-->
                    <!--================================-->
                    <div id="mainnav-menu-wrap">
                        <div class="nano">
                            <div class="nano-content">

                                <!--Shortcut buttons-->
                                <!--================================-->
                                <div id="mainnav-shortcut" class="hidden">
                                    <ul class="list-unstyled shortcut-wrap">
                                        <li class="col-xs-3" data-content="My Profile">
                                            <a class="shortcut-grid" href="#">
                                                <div class="icon-wrap icon-wrap-sm icon-circle bg-mint">
                                                <i class="demo-pli-male"></i>
                                                </div>
                                            </a>
                                        </li>
                                        <li class="col-xs-3" data-content="Messages">
                                            <a class="shortcut-grid" href="#">
                                                <div class="icon-wrap icon-wrap-sm icon-circle bg-warning">
                                                <i class="demo-pli-speech-bubble-3"></i>
                                                </div>
                                            </a>
                                        </li>
                                        <li class="col-xs-3" data-content="Activity">
                                            <a class="shortcut-grid" href="#">
                                                <div class="icon-wrap icon-wrap-sm icon-circle bg-success">
                                                <i class="demo-pli-thunder"></i>
                                                </div>
                                            </a>
                                        </li>
                                        <li class="col-xs-3" data-content="Lock Screen">
                                            <a class="shortcut-grid" href="#">
                                                <div class="icon-wrap icon-wrap-sm icon-circle bg-purple">
                                                <i class="demo-pli-lock-2"></i>
                                                </div>
                                            </a>
                                        </li>
                                    </ul>
                                </div>
                                <!--================================-->
                                <!--End shortcut buttons-->


                                <ul id="mainnav-menu" class="list-group">
						
						            <!--Category name-->
						            <li class="list-header">Início</li>
						
						            <!--Menu list item-->
						            <li>
						                <a href="index.php">
						                    <i class="demo-pli-home"></i>
						                    <span class="menu-title">Dashboard</span>
						                </a>
						            </li>
						
						            <li class="list-divider"></li>
						
						            <!--Category name-->
						            <li class="list-header">Informações</li>
						
						            <!--Menu list item-->
						            <li>
						                <a href="#">
						                    <i class="demo-pli-pen-5"></i>
						                    <span class="menu-title">Programação</span>
											<i class="arrow"></i>
						                </a>
						
						                <!--Submenu-->
						                <ul class="collapse">
						                    <li><a href="progconstrucao.php?datainit=<?php echo date('d-m-Y'); ?>&divisao=B1&turno=">Construção</a></li>
						                </ul>
                                        <ul class="collapse">
						                    <li><a href="progdivisao.php">Divisão A</a></li>
						                </ul>
						            </li>
                                    
                                    <!--Menu list item-->
                                    <li>
						                <a href="prodmateriais.php">
						                    <i class="demo-pli-computer-secure"></i>
						                    <span class="menu-title">Produção dos Materiais</span>		
						                </a>
                                    </li>
                                    
									<!--Menu list item-->
						            <li class="">
						                <a href="#">
						                    <i class="demo-pli-medal-2"></i>
						                    <span class="menu-title">Ticket</span>
											<i class="arrow"></i>
						                </a>
						
						            <!--Submenu-->
                                        <ul class="collapse">
						                    <li><a href="progprodb1.php?data_init=<?php echo date('d-m-Y'); ?>&data_final=<?php echo date('d-m-Y'); ?>&turno=1&material=GT">Programado x Produzido B1</a></li>
											<li><a href="progprodb2.php">Programado x Produzido B2</a></li>
						                </ul>
						            </li>
						
						            <!--Menu list item-->
						            <li class="active-sub">
						                <a href="#">
						                    <i class="demo-pli-receipt-4"></i>
						                    <span class="menu-title">Inventário</span>
											<i class="arrow"></i>
						                </a>
						
						                <!--Submenu-->
						                <ul class="collapse in">
						                    <li class="active-link"><a href="inventgeral.php?dt_ini=<?php echo date('d-m-Y'); ?>">Geral</a></li>
											<li><a href="#">Lista dos Materias</a></li>
	
						                </ul>
						            </li>
						            <li class="list-divider"></li>
						
						            <!--Category name-->
						            <li class="list-header">Extras</li>
						
						            <!--Menu list item-->
						            <li>
						                <a href="#">
						                    <i class="demo-pli-computer-secure"></i>
						                    <span class="menu-title">Especificação do Pneu</span>
											
						                </a>
						            </li>
									<li class="list-divider"></li>
								</ul>
	
                                <!--Widget-->
                                <!--================================-->
                                <div class="mainnav-widget">
																	
                                    <!-- Show the button on collapsed navigation -->
                                    <div class="show-small">
                                        <a href="#" data-toggle="menu-widget" data-target="#demo-wg-server">
                                            <i class="demo-pli-monitor-2"></i>
                                        </a>
                                    </div>

                                    <!-- Hide the content on collapsed navigation -->
                                    <div id="demo-wg-server" class="hide-small mainnav-widget-content">
                                        <ul class="list-group">
                                            <li class="list-header pad-no mar-ver">Status dos Materias </li>
                                            <li class="mar-btm">
                                                <span class="label label-primary pull-right">30%</span>
                                                <p>Inventário Geral</p>
                                                <div class="progress progress-sm">
                                                    <div class="progress-bar progress-bar-primary" style="width: 30%;">
                                                        <span class="sr-only">30%</span>
                                                    </div>
                                                </div>
                                            </li>
                                            <li class="pad-ver"><a href="#" class="btn btn-success btn-bock">Detalhes</a></li>
                                        </ul>
                                    </div>
                                </div>
                                <!--================================-->
                                <!--End widget-->

                            </div>
                        </div>
                    </div>
                    <!--================================-->
                    <!--End menu-->

                </div>
            </nav>
            <!--===================================================-->
            <!--END MAIN NAVIGATION-->

        <!-- SCROLL PAGE BUTTON -->
        <!--===================================================-->
        <button class="scroll-top btn">
            <i class="pci-chevron chevron-up"></i>
        </button>
        <!--===================================================-->
    </div>
    <!--===================================================-->
    <!-- END OF CONTAINER -->
    
    <!--JAVASCRIPT-->
    <!--=================================================-->

    <!--jQuery [ REQUIRED ]-->
    <script src="js/jquery.min.js"></script>


    <!--BootstrapJS [ RECOMMENDED ]-->
    <script src="js/bootstrap.min.js"></script>


    <!--NiftyJS [ RECOMMENDED ]-->
    <script src="js/nifty.min.js"></script>

    <!--=================================================-->
    
    <!--DataTables [ OPTIONAL ]-->
    <script src="plugins/datatables/media/js/jquery.dataTables.js"></script>
	<script src="plugins/datatables/media/js/dataTables.bootstrap.js"></script>
	<script src="plugins/datatables/extensions/Responsive/js/dataTables.responsive.min.js"></script>


    <!--DataTables Sample [ SAMPLE ]-->
    <script src="js/demo/tables-datatables.js"></script>
    <script>
        $('#table-table').DataTable({
        "aLengthMenu": [[10, 25, 50, -1], [10, 25, 50, "Todos"]],
        "iDisplayLength": 25 

    });

    </script>
</body>
</html>
