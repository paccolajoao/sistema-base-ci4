/**
 * Crio a tabela, seto em uma variavel global e monto a estrutura
 * no ajax retorno um json e dentro de data coloco os valores
 */

var table = null;

$(document).ready(function() {
    table = initDataTable (
        'dt_desenvolvimento',
        'desenvolvimento/data',
        {
            dataInicial: function() { return $('#dataInicialFiltrar').val() },
            dataFinal:   function() { return $('#dataFinalFiltrar').val() },
            status:      function() { return $('#statusFiltrar').val() }
        });
});

/**
 * dou reload no ajax e recebo via json as inputs em outros campos do back end
 */
$("#btnFiltrarFuncionarios").on("click", function () {
    refreshDataTable(table);
    $("#btnFecharFiltrarFuncionarios").trigger("click");
});