$(document).ready(function(){

    makeCharts('grafico_bal','grafico-contBAL','Balanceamento por mês','Volume');

    function makeCharts(acao,div_chart,title = '',category = '', tipo = ''){
        let utitle = '';

        if(title != ''){
            utitle = title.toUpperCase();
        }

        let options = {

            chart: {
                type: 'column'
            },
            title: {
                text: utitle
            },
            /*subtitle: {
                text: 'Bladder Reutilizados.'
            }*/
            xAxis: {
                type: 'category',
                crosshair: true
            },
            yAxis: [{
                min: 0,
                title: {
                    text: category
                }
            },
            {
               title: {
                    text: tipo
                },
                labels: {
                    //format: '{value}',
                    formatter: function () {
                        return '' + Highcharts.numberFormat(this.y, 0, ',', '.');
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
            data: {"acao":acao},
            success: function (retorno) {
                let resultado = JSON.parse(retorno);
                options.series = resultado;
                Highcharts.chart(div_chart,options);

            }
        });

    }

    function makeGraphicsPie( acao,div_chart, title = '',enable3d) {

        let cor;

        let options = {
            chart: {
                type: 'pie',
                options3d: {
                    enabled: enable3d,
                    alpha: 45,
                    beta: 0
                }
            },
            title: {
                text: title,
                style: {
                    display: 'none'
                }
            },
            tooltip: {
                headerFormat: '<span style="font-size:11px">{series.name}</span><br>',
                pointFormat: '<span style="color:{point.color}"><b>{point.name}</b></span>: {point.percentage:.1f} %<br>Qtde: {point.y}'
            },
            plotOptions: {
                pie: {
                    allowPointSelect: true,
                    cursor: 'pointer',
                    dataLabels: {
                        enabled: true,
                        format : '<b>{point.name}</b>:<br>{point.percentage:.1f} %<br>Qtde: {point.y}'
                    },
                    showInLegend: true,
                    //innerSize: 150,
                    //depth: 45
                }
            },
            legend: {
                enabled: false
            },
            series: {},
            drilldown: {
                series: {}
            }
        };

        $.ajax({
            type: "POST",
            url: "server_graficos.php",
            data: {"acao":acao},
            success: function (retorno) {
                console.log(retorno);
                let resultado = JSON.parse(retorno);
                options.series = resultado;
                Highcharts.chart(div_chart,options);

            }
        });

    }

});