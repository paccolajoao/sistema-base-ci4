/**
 * Crio a tabela, seto em uma variavel global e monto a estrutura
 * no ajax retorno um json e dentro de data coloco os valores
 */

var table = null;

$(document).ready(function() {
  table = initDataTable (
      'dt_default',
      'produtos/data',
      {
        nomeFiltrar: function() { return $('#nomeFiltrar').val() },
        codigoFiltrar:    function() { return $('#codigoFiltrar').val() },
        statusFiltrar:  function() { return $('#statusFiltrar').val() }
      });
});

/**
 * dou reload no ajax e recebo via json as inputs em outros campos do back end
 */
$("#btnFiltrar").on("click", function () {
  refreshDataTable(table);
  $("#btnFecharFiltrar").trigger("click");
});

$("form#produtoData").on("submit", function (e) {
  e.preventDefault();
  showFullLoading();
  var formData = new FormData(this);
  var urlSendAjax = window.location.origin + "/produtos/create";

  // Envio o id do usuário para a url
  if (!isEmpty($("#id_produto").val(),true)) {
    urlSendAjax += '/' + $("#id_produto").val();
  }

  var request = $.ajax({
    url: urlSendAjax,
    method: "POST",
    data: formData,
    contentType: false,
    processData: false
  });

  request.done(function (msg) {
    let ret = JSON.parse(msg);
    if (ret.msg === 'success'){
      success_notification('Sucesso ao criar/editar produto.');
      setTimeout(() => {
        location.href = '/produtos';
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

$(document).on("click", ".editar-registro", function() {
  let idRegistro = $(this).data("id");
  location.href = 'produtos/add/' + idRegistro;
});

$(document).on("click", ".excluir-registro", function() {
  let idRegistro = $(this).data("id");

  var urlSendAjax = window.location.origin + "/produtos/delete";

  // Envio o id do usuário para a url
  if (!isEmpty(idRegistro,true)) {
    urlSendAjax += '/' + idRegistro;
  }

  Swal.fire({
    title: "Tem certeza que deseja excluir esse registro?",
    text: "Não será possível reverter essa ação!",
    icon: "warning",
    showCancelButton: true,
    cancelButtonText: "Cancelar",
    confirmButtonColor: "#3085d6",
    cancelButtonColor: "#d33",
    confirmButtonText: "Sim, remover o registro!"
  }).then((result) => {
    if (result.isConfirmed) {
      var request = $.ajax({
        url: urlSendAjax,
        method: "POST",
        contentType: false,
        processData: false
      });

      request.done(function (msg) {
        let ret = JSON.parse(msg);
        if (ret.msg === 'success'){
          Swal.fire({
            title: "Removido!",
            text: "O registro foi removido com sucesso!",
            icon: "success"
          });
          refreshDataTable(table);
        }
        else {
          error_notification(ret.error);
        }
      });

      request.fail(function (jqXHR, textStatus) {
        alert("Request failed: " + textStatus);
      });
    }
  });
});