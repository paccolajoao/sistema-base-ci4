/**
 * Crio a tabela, seto em uma variavel global e monto a estrutura
 * no ajax retorno um json e dentro de data coloco os valores
 */

var table = null;

$(document).ready(function () {
    table = initDataTable(
        'dt_default',
        'unidadesmedida/data',
        {
            nomeFiltrar: function () {
                return $('#nomeFiltrar').val()
            },
            relacionalFiltrar: function () {
                return $('#relacionalFiltrar').val()
            },
            statusFiltrar: function () {
                return $('#statusFiltrar').val()
            }
        });

    $('.quantidade_umbase').mask('#.##0,000000', {reverse: true});
    // Carrego os Select2 da cidade
    var urlSendAjax = window.location.origin + "/select2/select2UnidadeMedida";
    $('#UMBase').select2({
        theme: "bootstrap-5",
        width: $(this).data('width') ? $(this).data('width') : $(this).hasClass('w-100') ? '100%' : 'style',
        ajax: {
            url: urlSendAjax,
            dataType: 'json',
            data: function (params) {
                return {
                    search: params.term,
                    type: 'public'
                };
            },
            processResults: function (data) {
                return {
                    results: data
                };
            },
            cache: true
        }
    });

    $("#isRelacional").trigger("change");
});

/**
 * dou reload no ajax e recebo via json as inputs em outros campos do back end
 */
$("#btnFiltrar").on("click", function () {
    refreshDataTable(table);
    $("#btnFecharFiltrar").trigger("click");
});

$("form#unidadesMedidaData").on("submit", function (e) {
    e.preventDefault();
    showFullLoading();
    var formData = new FormData(this);
    var urlSendAjax = window.location.origin + "/unidadesmedida/create";

    // Envio o id do usuário para a url
    if (!isEmpty($("#id_unidade_medida").val(), true)) {
        urlSendAjax += '/' + $("#id_unidade_medida").val();
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
        if (ret.msg === 'success') {
            success_notification('Sucesso ao criar/editar unidade de medida.');
            setTimeout(() => {
                location.href = '/unidadesmedida';
            }, 3000);
        } else {
            error_notification(ret.error);
            hideFullLoading();
        }
    });

    request.fail(function (jqXHR, textStatus) {
        alert("Request failed: " + textStatus);
        hideFullLoading();
    });
});

$(document).on("click", ".editar-registro", function () {
    let idRegistro = $(this).data("id");
    location.href = 'unidadesmedida/add/' + idRegistro;
});

$(document).on("click", ".excluir-registro", function () {
    let idRegistro = $(this).data("id");

    var urlSendAjax = window.location.origin + "/unidadesmedida/delete";

    // Envio o id do usuário para a url
    if (!isEmpty(idRegistro, true)) {
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
                if (ret.msg === 'success') {
                    Swal.fire({
                        title: "Removido!",
                        text: "O registro foi removido com sucesso!",
                        icon: "success"
                    });
                    refreshDataTable(table);
                } else {
                    error_notification(ret.error);
                }
            });

            request.fail(function (jqXHR, textStatus) {
                alert("Request failed: " + textStatus);
            });
        }
    });
});

$("#isRelacional").change(function () {
    $(".hidden-by-relacional").removeClass('d-block');
    $(".hidden-by-relacional").removeClass('d-none');
    if ($(this).val() === '1') {
        $(".hidden-by-relacional").addClass('d-block');
        // Carrego a UMBase no Select2
        if (!isEmpty($("#UMBase").data('umbase'),true)) {
            let paramsSelect2UM = {
                "idUM": $("#UMBase").data('umbase'),
                "idSelect2": "UMBase"
            };
            setSelect2UM(paramsSelect2UM);
        }
    } else {
        $(".hidden-by-relacional").addClass('d-none');
    }
});