<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">

    <title>Dashboard | Materiais</title>


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
    <link rel="stylesheet" href="css/demo/icons.css">

    
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
					<li><a href="#">Produção dos Materiais</a></li>
                    </ol>
                    <!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
                    <!--End breadcrumb-->

                </div>
                <!--Page content-->
                <!--===================================================-->
                <?php
                    error_reporting(E_ALL & ~E_NOTICE & ~E_WARNING);
                    require_once('php/connect.php');
                    $material = $_GET['material'];
                    $data_init = date('d/m/Y',strtotime($_GET['datainit']));
                    $data_final = date('d/m/Y',strtotime($_GET['datafinal']));
                    $turno = $_GET['turno'];
                ?>
                <div id="page-content">
					    <div class="row">
					        <div class="col-lg-12">
					            <div id="" class="panel">
                                    <div class="panel-heading">
                                        <h3 class="panel-title">Consultar Produção</h3>
                                    </div>
                                    <div class="panel-body">
                                        <form id="form-highlight-cured" action="prodmateriais.php">
                                             <div class="col-md-2">
                                                 <label>Data inicial</label>
                                                <div id="dt-inicio">
                                                    <div class="input-group date">
                                                        <input name="datainit" type="date" class="form-control" value="<?php echo $_REQUEST['datainit']; ?>">
                                                    </div>
                                                </div>
                                             </div>         
                                             <div class="col-2 col-sm-2 col-md-2 col-lg-2 col-xl-2">
                                                 <label>Data final</label>
                                                <div id="dt-fim">
                                                    <div class="input-group date">
                                                        <input name="datafinal" type="date" class="form-control" value="<?php echo $_REQUEST['datafinal']; ?>"> 
                                                    </div>
                                                </div>
                                             </div>
                                             <div class="col-md-2">
                                                <label>Turno</label>
                                                <select id="edt-turno" name="turno" class="form-control">
                                                    <option value="">Todos</option>
                                                    <option value="1">1</option>
                                                    <option value="2">2</option>
                                                    <option value="3">3</option>
                                                </select>
                                            </div>
                                            <div class="col-md-2">
                                                <label>Material</label>
                                                <select id="edt-material" name="material" class="form-control">
                                                    <option value="">------</option>
                                                    <option value="BE">BE</option>
                                                    <option value="BL">BL</option>
                                                    <option value="CH">CH</option>
                                                    <option value="DG">DG</option>
                                                    <option value="FL">FL</option>
                                                    <option value="GT">GT</option>
                                                    <option value="LN">LN</option>
                                                    <option value="LS">LS</option>
                                                    <option value="OL">OL</option>
                                                    <option value="PA">PA</option>
                                                    <option value="PL">PL</option>
                                                    <option value="PX">PX</option>
                                                    <option value="RA">RA</option>
                                                    <option value="SQ">SQ</option>
                                                    <option value="SW">SW</option>
                                                    <option value="TF">TF</option>
                                                    <option value="TR">TR</option>
                                                    <option value="TW">TW</option>
                                                </select>
                                            </div>
                                            <div class="col-sm-2 col-md-2 col-lg-2 col-xl-2">
                                                <br>
                                                <button type="submit" id="btn-highligh-cured" class="btn btn-success btn-labeled form-control" style="width: 110px;"><i class="btn-label fa fa-search"></i> Executar</button>
                                              </div>
                                        </form>		        
                                    </div>
					    		</div>
					        </div>
					            <!--===================================================-->
					            <!--End form-group -->
                        </div>   
                        <div class="panel">
                            <div class="panel-heading">
                                <div class="row">
                                    <div class="col-lg-4">
                                        <h3 class="panel-title">Tabela</h3>
                                    </div>
                                    <div class="col-lg-4 col-lg-offset-4 text-right">
                                        <button class="btn btn-default" onclick="exceller()"><i class="demo-pli-printer"></i></button>
                                    </div>
                                </div>                                
                            </div>
                            <div class="panel-body">
                                <table id="demo-dt-selection" class="table table-striped table-bordered" cellspacing="0" width="100%">
                                    <thead>
                                        <tr>
                                            <th>Data</th>
                                            <th>Maquina</th>
                                            <th class="min-tablet">Material</th>
                                            <th class="min-tablet">Turno</th>
                                            <th class="min-desktop">Produzido</th>
                                        </tr>
                                    </thead>
                                    <?php
                                        $sql = "
                                            SELECT
                                                TO_CHAR(PV.dtprod, 'DD/MM/YYYY') Data,
                                                RE.code MAQ,
                                                P.code PNEU,
                                                PV.shift TURNO,
                                                SUM(PV.qty) As PROD
                                            FROM
                                                ctblprodlineev PV, ctblprodline PL
                                                INNER JOIN tblwohd W ON W.idwohd = PL.idwohd
                                                INNER JOIN tblproduct P ON W.idproduct = P.idproduct
                                                INNER JOIN tblresource RE ON RE.idresource = PL.idresource
                                            WHERE
                                                PV.dtdelete IS NULL
                                                AND PV.dtprod >= TO_DATE ('$data_init','DD/MM/YYYY')
                                                AND PV.dtprod <= TO_DATE ('$data_final','DD/MM/YYYY')
                                                AND PL.seqprodline = PV.seqprodline AND PL.version = PV.version
                                                AND PL.idresource = PV.idresource  AND PL.dtprod = PV.dtprod
                                                AND PL.shift = PV.shift AND PV.shift like '$turno%' AND P.Code like '$material%'
                                                AND (RE.Code NOT LIKE 'E0%' AND RE.Code NOT LIKE 'LRF%')
                                            GROUP BY
                                                TO_CHAR(PV.dtprod, 'DD/MM/YYYY'),
                                                RE.code,
                                                P.code,
                                                PV.shift
                                            ORDER BY
                                                TO_CHAR(PV.dtprod, 'DD/MM/YYYY'), RE.code, PV.shift";
                                                //AND RE.Code NOT LIKE 'MD%' AND RE.Code NOT LIKE 'MF%' AND RE.Code NOT LIKE 'NG%' AND RE.Code NOT LIKE 'TBT%'
                                    $stmt_temp = connect_pcf($sql);
                                    ?>
                                    <tbody>
                                    <?php
                                    if(OCIExecute($stmt_temp)){
                                        $cont = 0;
                                    while(OCIFetchInto($stmt_temp, $linha, OCI_ASSOC)){
                                        $cont++;
                                        ?>  
                                            <tr>
                                                <td><?php echo $linha['DATA']; ?></td>
                                                <td><?php echo $linha['MAQ']; ?></td>
                                                <td><?php echo $linha['PNEU']; ?></td>
                                                <td><?php echo $linha['TURNO']; ?></td>
                                                <td><?php echo $linha['PROD']; ?></td>
                                            </tr>
                                        <?php 
                                        }
                                    }else{
                                            echo "Aconteceu um erro no resultado da consulta!";
                                    } ?> 
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
                                    <li class="active-sub">
						                <a href="prodmateriais.php">
						                    <i class="demo-pli-computer-secure"></i>
						                    <span class="menu-title">Produção dos Materiais</span>		
						                </a>
                                    </li>
                                    
									<!--Menu list item-->
						            <li>
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
						            <li>
						                <a href="#">
						                    <i class="demo-pli-receipt-4"></i>
						                    <span class="menu-title">Inventário</span>
											<i class="arrow"></i>
						                </a>
						
						                <!--Submenu-->
						                <ul class="collapse">
						                    <li><a href="inventgeral.php?dt_ini=<?php echo date('d-m-Y'); ?>">Geral</a></li>
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

    <script src="js/export.js"></script>

    <!--DataTables Sample [ SAMPLE ]-->
    <script src="js/demo/tables-datatables.js"></script>
</body>
</html>
