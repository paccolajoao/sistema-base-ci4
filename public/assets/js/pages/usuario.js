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
  var urlSendAjax = window.location.origin + "/usuarios/create";

  // Envio o id do usuário para a url
  if (!isEmpty($("#id_usuario").val(),true)) {
    urlSendAjax += '/' + $("#id_usuario").val();
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
      success_notification('Sucesso ao criar/editar usuário.');
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

$(document).on("click", ".editar-usuario", function() {
  let idUser = $(this).data("id");
  location.href = 'usuarios/add/' + idUser;
});

$(document).on("click", ".excluir-usuario", function() {
  let idUser = $(this).data("id");

  var urlSendAjax = window.location.origin + "/usuarios/delete";

  // Envio o id do usuário para a url
  if (!isEmpty(idUser,true)) {
    urlSendAjax += '/' + idUser;
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