$(document).ready(function() {
  $('#dt_user').DataTable({
    language: {
      url: '//cdn.datatables.net/plug-ins/1.13.4/i18n/pt-BR.json',
    },
    processing: true,
    serverSide: true,
    ajax: {
      url: 'usuarios/data',
      data: function(d) {
        const usuarioFiltrar = $("#usuarioFiltrar").val();
        const nomeFiltrar    = $("#nomeFiltrar").val();
        const statusFiltrar  = $("#statusFiltrar").val();

        return $.extend({}, d, {
          usuarioFiltrar,
          nomeFiltrar,
          statusFiltrar
        });
      }
    }
  });
});

$("#btnFiltrarUsuarios").on("click", function () {
  $("#dt_user").DataTable().ajax.reload();
  $("#btnFecharFiltrarUsuarios").trigger("click");
});