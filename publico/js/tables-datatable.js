$(function(){var e=$("#datatable1").DataTable({responsive:{details:!1}});$(document).on("sidebarChanged",function(){e.columns.adjust(),e.responsive.recalc(),e.responsive.rebuild()})});
$(document).ready(function() {$('#datatable20').DataTable( {responsive: true,dom: "<'row'<'col-sm-2 text-left'f><'col-sm-4'l><'col-sm-6 text-right'B>>" + "<'row'<'col-sm-12'tr>>" + "<'row'<'col-sm-5'i><'col-sm-7'p>>", buttons: [{ extend: 'excelHtml5', text: '<i class="fas fa-file-excel"> &nbsp;EXCEL</i>', title: 'ial360-export', titleAttr: 'Exportar para arquivo XLSX', className: 'btn-sm btn-success br-3', init: function(api, node, config) { $(node).removeClass('btn-default') }  }, { extend: 'pdfHtml5', text: '<i class="fas fa-file-pdf"> &nbsp;PDF</i>', title: 'ial360-export', titleAttr: 'Exportar para arquivo PDF', className: 'btn-sm btn-danger ml-2', init: function(api, node, config) { $(node).removeClass('btn-default') } }, ], scrollY: '50vh', scrollCollapse: true, scrollX: false, paging: true, language:  { 'search': 'Filtro:', 'decimal': ',', 'thousands': '.', 'emptyTable': 'Nenhum registro encontrado', 'info': 'Mostrando de _START_ até _END_ de _TOTAL_ registros', 'infoEmpty': 'Mostrando 0 até 0 de 0 registros', 'infoFiltered':   '(filtrado de _MAX_ registros)', 'infoPostFix':    '', 'lengthMenu': '_MENU_ resultados por página', 'loadingRecords': 'Carregando...', 'processing':     'Processando...', 'zeroRecords': 'Nenhum registro encontrado', 'paginate': { 'first': 'Primeiro', 'last': 'Último', 'next': 'Próximo', 'previous':   'Anterior' }, 'aria': { 'sortAscending':  ': Ordenar colunas de forma ascendente', 'sortDescending': ': Ordenar colunas de forma descendente' } } } ); } );