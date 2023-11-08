/**
 * Crio a tabela, seto em uma variavel global e monto a estrutura
 * no ajax retorno um json e dentro de data coloco os valores
 */

var table = null;

$(document).ready(function() {
  table = initDataTable (
      'dt_user',
      'usuarios/data',
      {
        usuarioFiltrar: function() { return $('#usuarioFiltrar').val() },
        nomeFiltrar:    function() { return $('#nomeFiltrar').val() },
        statusFiltrar:  function() { return $('#statusFiltrar').val() }
      });
});

/**
 * dou reload no ajax e recebo via json as inputs em outros campos do back end
 */
$("#btnFiltrarUsuarios").on("click", function () {
  refreshDataTable(table);
  $("#btnFecharFiltrarUsuarios").trigger("click");
});

$("form#usuarioData").on("submit", function (e) {
  e.preventDefault();
  showFullLoading();
  var formData = new FormData(this);

  var request = $.ajax({
    url: "create",
    method: "POST",
    data: formData,
    contentType: false,
    processData: false
  });

  request.done(function (msg) {
    let ret = JSON.parse(msg);
    if (ret.msg === 'success'){
      success_notification('Sucesso ao criar usuário.');
      setTimeout(() => {
        location.href = '/usuarios';
      }, 3000);
    }
    else {
      error_notification(ret.error);
      hideFullLoading();
    }
  });

  request.fail(function (jqXHR, textStatus) {
    alert("Request failed: " + textStatus);
    hideFullLoading();
  });
});