
// Tables-DataTables.js
// ====================================================================
// This file should not be included in your project.
// This is just a sample how to initialize plugins or components.
//
// - ThemeOn.net -



$(document).on('nifty.ready', function() {


    // DATA TABLES
    // =================================================================
    // Require Data Tables
    // -----------------------------------------------------------------
    // http://www.datatables.net/
    // =================================================================

    $.fn.DataTable.ext.pager.numbers_length = 5;


    // Basic Data Tables with responsive plugin
    // -----------------------------------------------------------------
    $('#demo-dt-basic').dataTable( {
        "responsive": true,
        "language": {
            "paginate": {
              "previous": '<i class="demo-psi-arrow-left"></i>',
              "next": '<i class="demo-psi-arrow-right"></i>'
            }
        }
    } );


$('#demo-dt-basic').DataTable({
   "aLengthMenu": [[10, 25, 50, -1], [10, 25, 50, "Todos"]],
   "aaSorting": [[ 0, "asc" ]],
   "rowsGroup": [0],
   "oLanguage": {
   "sLengthMenu":        "Exibir _MENU_ registros por p�gina",
   "sZeroRecords":    "Nenhum registro encontrado",
   "sInfo":         "Exibindo _START_ a _END_ de _TOTAL_ registros",
   "sSearch":         "Localizar",
   "sInfoEmpty":     "Nenhum registro dispon�vel",
   "sInfoFiltered":   "(Filtrado de _MAX_ registros)",
   "sLoadingRecords":     "Carregando...",
   "sProcessing":         "Processando...",
   "sInfoThousands":  ".",
   "oPaginate": {
         "sFirst":      "Primeiro",
         "sLast":       "�ltimo",
         "sNext":       "Pr�ximo",
         "sPrevious":   "Anterior"
      }
   },
   dom: 'lBfrtip',
       buttons: [
           { extend: 'excel', text: 'Excel', title: 'Vulcaniza��o - Open/Close' },
           { 
               extend: 'print', text: 'Imprimir',  title: 'Vulcaniza��o - Open/Close',
               customize: function ( win ) {
                   $(win.document.body)
                       .css( 'font-size', '8pt' );
                   $(win.document.body).find( 'table' )
                       .addClass( 'compact' )
                       .css( 'font-size', 'inherit' );
               }
           }
       ]
});





    // Row selection (single row)
    // -----------------------------------------------------------------
    var rowSelection = $('#demo-dt-selection').DataTable({
        "responsive": true,
        "language": {
            "paginate": {
              "previous": '<i class="demo-psi-arrow-left"></i>',
              "next": '<i class="demo-psi-arrow-right"></i>'
            }
        }
    });

    $('#demo-dt-selection').on( 'click', 'tr', function () {
        if ( $(this).hasClass('selected') ) {
            $(this).removeClass('selected');
        }
        else {
            rowSelection.$('tr.selected').removeClass('selected');
            $(this).addClass('selected');
        }
    } );






    // Row selection and deletion (multiple rows)
    // -----------------------------------------------------------------
    var rowDeletion = $('#demo-dt-delete').DataTable({
        "responsive": true,
        "language": {
            "paginate": {
              "previous": '<i class="demo-psi-arrow-left"></i>',
              "next": '<i class="demo-psi-arrow-right"></i>'
            }
        },
        "dom": '<"toolbar">frtip'
    });
    $('#demo-custom-toolbar').appendTo($("div.toolbar"));

    $('#demo-dt-delete tbody').on( 'click', 'tr', function () {
        $(this).toggleClass('selected');
    } );

    $('#demo-dt-delete-btn').click( function () {
        rowDeletion.rows('.selected').remove().draw( false );
    } );






    // Add Row
    // -----------------------------------------------------------------
    var t = $('#demo-dt-addrow').DataTable({
        "responsive": true,
        "language": {
            "paginate": {
              "previous": '<i class="demo-psi-arrow-left"></i>',
              "next": '<i class="demo-psi-arrow-right"></i>'
            }
        },
        "dom": '<"newtoolbar">frtip'
    });
    $('#demo-custom-toolbar2').appendTo($("div.newtoolbar"));

    var randomInt = function(min,max){
        return Math.floor(Math.random()*(max-min+1)+min);
    }
    $('#demo-dt-addrow-btn').on( 'click', function () {
        t.row.add( [
            'Adam Doe',
            'New Row',
            'New Row',
            randomInt(1,100),
            '2015/10/15',
            '$' + randomInt(1,100) +',000'
        ] ).draw();
    } );


});
