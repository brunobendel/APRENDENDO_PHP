<?php
    error_reporting(E_ALL & ~E_NOTICE & ~E_WARNING);
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">

    <title>Dashboard | Balanceamentos</title>

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

    <!--Demo [ DEMONSTRATION ]-->
    <link href="css/demo/nifty-demo.min.css" rel="stylesheet">

    <link href="plugins/switchery/switchery.min.css" rel="stylesheet">

    <!--DataTables [ OPTIONAL ]-->
    <link href="plugins/datatables/media/css/dataTables.bootstrap.css" rel="stylesheet">
    <link href="plugins/datatables/extensions/Responsive/css/responsive.dataTables.min.css" rel="stylesheet">
    <link href="plugins/animate-css/animate.min.css" rel="stylesheet">
    <link href="css/font-awesome/css/font-awesome.min.css" rel="stylesheet">
    <link href="plugins/fooTable/css/footable.core.css" rel="stylesheet">
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
					<li><a href="#">Balanceamentos</a></li>
                    <li><a href="#">Lona</a></li>
                    </ol>
                    <!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
                    <!--End breadcrumb-->

                </div>
                <!--Page content-->
                <!--===================================================-->
                <div id="page-content">
					    <div class="row">
					        <div class="col-lg-12">
					            <div id="" class="panel">
                                    <div class="panel-body">
                                    <button data-target="#demo-default-modal-form" data-toggle="modal" class="btn btn-warning btn-lg">Adicionar</button>
                                    </div>
					    		</div>
					        </div>
					            <!--===================================================-->
					            <!--End form-group -->
                        </div>   
                        <div class="row">
                            <div class="col-sm-6">
                            <div class="panel">
                                <div class="panel-heading">
                                        <div class="col-lg-4">
                                            <h3 class="panel-title">Tabela</h3>
                                        </div>
                                </div>
                                <div class="panel-body">            
                                <table id="demo-foo-row-toggler" class="table toggle-circle">
                                    <thead>
                                        <tr>
                                            <th data-toggle="true" width="150px">Data de Lançamento</th>
                                            <th width="100px">Pneu</th>
                                            <th data-hide="all">Programado</th>
                                            <th data-hide="all">1° Lona</th>
                                            <th data-hide="all">Programado</th>
                                            <th data-hide="all">Inventário</th>
                                            <th data-hide="all">Equipamento</th>
                                            <th data-hide="all">2° Lona</th>
                                            <th data-hide="all">Programado</th>
                                            <th data-hide="all">Inventário</th>
                                            <th data-hide="all">Equipamento</th>
                                            <th data-hide="all">Maquina</th>
                                            <th data-hide="all"></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    <?php 
                                    include_once('php/listagemBAL.php'); ?>
                                    </tbody>
                                    </table>
                                </div>
                            </div>
                            </div>
                            <div class="col-sm-6">
                            <div class="panel">
                            <div class="panel-heading">
                                    <div class="col-lg-12">
                                        <h3 class="panel-title">Gráficos</h3>
                                    </div>
                            </div>
                            <div class="panel-body">            
                            <div class="col-md-12">
                    <!-- Bar Chart -->
                    <!---------------------------------->
                    <div class="panel">
                        <div class="panel-body" id="grafico-contBAL">
                            
                        </div>
                    </div>
                            </div>
                        </div>
                        </div>
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
						            <li class="active-sub">
                                        <a href="#">
						                    <i class="demo-pli-computer-secure"></i>
						                    <span class="menu-title">Balanceamentos</span>
											<i class="arrow"></i>
						                </a>

                                        <!--Submenu-->
						                <ul class="collapse in">
						                    <li class="active-link"><a href="lona.php">Lona</a></li>
						                </ul>
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

    <div class="modal fade" id="demo-default-modal-form" role="dialog" tabindex="-1" aria-labelledby="demo-default-modal" aria-hidden="true" style="display: none;">
        <div class="modal-dialog">
            <div class="modal-content">

                <!--Modal header-->
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal"><i class="pci-cross pci-circle"></i></button>
                    <h4 class="modal-title">Adicionar balanceamento de lona</h4>
                </div>

                <!--Modal body-->
                <div class="modal-body">
                <form class="form-horizontal" id="formBAL" method="POST">
					                <div class="panel-body">
					                    <div class="form-group">
					                        <label class="col-sm-2 control-label" for="demo-hor-inputemail">Pneu</label>
					                        <div class="col-sm-3">
					                            <input type="text" id="id_pneu" name="id_pneu" onchange="myFunction()" class="form-control" required>
					                        </div>
                                            <label class="col-sm-2 control-label" for="demo-hor-inputpass">Programado</label>
					                        <div class="col-sm-2">
                                                <input type="number" name="pneu_prog" id="pneu_prog" class="form-control" required>
					                        </div>
					                    </div>
					                    <div class="form-group">
                                            <label class="col-sm-2 control-label" for="demo-hor-inputpass">1° Lona</label>
					                        <div class="col-sm-3">
                                                <input type="text" name="lona_1" id="lona_1" class="form-control">
					                        </div>
                                            <label class="col-sm-2 control-label" for="demo-hor-inputpass">Inventario</label>
					                        <div class="col-sm-2">
                                                <input type="number" name="inventario_1" id="inventario_1" class="form-control">
					                        </div>
                                            <div class="col-sm-2">
                                                <input type="number" name="equipamento_1" id="equipamento_1" class="form-control">
					                        </div>
					                    </div>
                                        <div class="form-group">
                                            <label class="col-sm-3 control-label" for="demo-hor-inputpass">Programado</label>
					                        <div class="col-sm-2">
                                                <input type="number" name="prog_1" id="prog_1" class="form-control">
					                        </div>
					                    </div>
                                        <div class="form-group">
                                            <label class="col-sm-2 control-label" for="demo-hor-inputpass">2° Lona</label>
					                        <div class="col-sm-3">
                                                <input type="text" name="lona_2" id="lona_2" class="form-control">
					                        </div>
                                            <label class="col-sm-2 control-label" for="demo-hor-inputpass">Inventario</label>
					                        <div class="col-sm-2">
                                                <input type="number" name="inventario_2" id="inventario_2" class="form-control">
					                        </div>
                                            <div class="col-sm-2">
                                                <input type="number" name="equipamento_2" id="equipamento_2" class="form-control">
					                        </div>
					                    </div>
                                        <div class="form-group">
                                            <label class="col-sm-2 control-label" for="demo-hor-inputpass">Programado</label>
					                        <div class="col-sm-2">
                                                <input type="number" name="prog_2" id="prog_2" class="form-control">
					                        </div>
                                            <label class="col-sm-3 control-label" for="demo-hor-inputpass">Maquina</label>
					                        <div class="col-sm-3">
                                                <select name="maquina" id="maquina" class="form-control">
                                                    <option value="CAL4R2">CAL4R2</option>
                                                    <option value="F-CUTTER">F-CUTTER</option>
                                                </select>
					                        </div>
					                    </div>
					                </div>
                                    <!--Modal footer-->
                                    <div class="modal-footer">
                                        <button data-dismiss="modal" class="btn btn-default" type="button">Fechar</button>
                                        <button class="btn btn-primary" id="Enviar">Enviar</button>
                                    </div>
			    </form>
                </div>
            </div>
        </div>
    </div>

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

    <script src="plugins/switchery/switchery.min.js"></script>

    <!--DataTables Sample [ SAMPLE ]-->
    <script src="js/demo/tables-datatables.js"></script>
    <script src="js/demo/ui-modals.js"></script>
    <script>
    function myFunction() { 
        var pneu = document.getElementById('id_pneu').value;
        var prog = document.getElementById('pneu_prog').value;

        var pneuAtual = {
            'pneu': pneu
        }

        var dados = JSON.stringify(pneuAtual);

        $.ajax({
            url: 'php/procuraLona.php',
            type: 'POST',
            data: { data: dados },

            success: function (result) {
                if(result.success) {
                    $('#lona_1').val(result.lona_1);        
                    $('#lona_2').val(result.lona_2);        
                    $('#inventario_1').val(result.inventario_1);        
                    $('#inventario_2').val(result.inventario_2);        
  //                  $('#prog_1').val(result.inventario_1-(result.prog_1*prog));        
  //                  $('#prog_2').val(result.inventario_2-(result.prog_2*prog));        
                    $('#equipamento_1').val(result.equipamento_1);        
                    $('#equipamento_2').val(result.equipamento_2);        
                } else {
                    $('#lona_1').val("não encontrado!");        
                    $('#lona_2').val("não encontrado!");        
                    $('#inventario_1').val("0");
                    $('#inventario_2').val("0");
                    $('#equipamento_1').val("0");
                    $('#equipamento_2').val("0");
                }
            },
            //error: function (jqXHR, textStatus, errorThrown) {
            //alert("erro");
            //}
        });
    }
    </script>

<script type="text/javascript" language="javascript">
    $(document).ready(function() {
        
        $('#Enviar').click(function() {

            var dados = $('#formBAL').serialize();
        
            console.log(dados);

            if(dados != null || dados != '' ){

                $.ajax({
                type: 'POST',
                dataType: 'json',
                url: 'php/enviaBAL.php',
                async: true,
                data: dados,
                success: function(response) {
                    if(response.success) {
                   alert("Enviado!");
                  location.reload();
                    //$('#demo-default-modal-form').modal('toggle');
                    }
                }
            });

            }
            

            return false;
        });
    });
    </script>

<!--Highcharts -->
<script src='plugins/highcharts/highcharts.js'></script>
<script src='plugins/highcharts/modules/highcharts-3d.js'></script>
<script src='plugins/highcharts/modules/data.js'></script>
<script src='plugins/highcharts/modules/drilldown.js'></script>
<script src="plugins/highcharts/modules/accessibility.js"></script>
<script src="plugins/graficos.js"></script>
<!---<script language="javascript"> 

		$(function(){
			let options = {

				chart: {
					type: 'column'
				},
				title: {
					text: 'Quantidade de BAL por mês'
				},
				/*subtitle: {
					text: 'Bladder Reutilizados.'
				},*/
				xAxis: {
					type: 'category',
					crosshair: true
				},
				yAxis: [{
					min: 0,
					title: {
						text: 'Volume'
					}
				},
				{
					title: {
						text: 'Valor'
					},
					labels: {
						format: '{value}',
						formatter: function () {
								return '' + Highcharts.numberFormat(this.value, 2, ',', '.');				
							}
					},
					opposite: true

				}],
				tooltip: {
					headerFormat: '<span style="font-size:10px">{point.key}</span><table>',
					pointFormat:  '<tr><td style="color:{series.color};padding:0">{series.name}: </td>' +
								  '<td style="padding:0"><b>{point.y:.2f}</b></td></tr>',
					footerFormat: '</table>',
					shared: true,
					useHTML: true
				},
				plotOptions: {
					column: {
						pointPadding: 0.2,
						borderWidth: 1
					},
					series: {
					allowPointSelect: true,
					cursor: 'pointer',
					dataLabels: {
							enabled: true,
							formatter: function () {
								return '' + Highcharts.numberFormat(this.y, 2, ',', '.');
							},
							//rotation: 0,
							//align: 'top',
							style: {
								fontSize: '10px',
								fontFamily: 'Verdana, sans-serif'
							}
						}
					}

				},
				
				series: { }

			};

			$.ajax({
					type: "POST",
					url: "php/contBAL.php",
					data: {"acao":'grafico_bal'},
					success: function (response) {
						console.log(response);
						let resultado = JSON.parse(response);
						options.series = resultado;
						Highcharts.chart('grafico-contBAL',options);
					}
				}); 
		});							

	</script> -->
    <!--aquivo do grafico -->

        <!--FooTable [ OPTIONAL ]-->
        <script src="plugins/fooTable/dist/footable.all.min.js"></script>

        <!--FooTable Example [ SAMPLE ]-->
        <script src="js/demo/tables-footable.js"></script>

</body>
</html>
