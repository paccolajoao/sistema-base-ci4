/**
 * Crio a tabela, seto em uma variavel global e monto a estrutura
 * no ajax retorno um json e dentro de data coloco os valores
 */

var table = null;

$(document).ready(function () {
    table = initDataTable(
        'dt_default',
        'fornecedores/data',
        {
            razaoSocialFiltrar: function () {
                return $('#razaoSocialFiltrar').val()
            },
            codigoFiltrar: function () {
                return $('#codigoFiltrar').val()
            },
            statusFiltrar: function () {
                return $('#statusFiltrar').val()
            },
            tipoFiltrar: function () {
                return $('#tipoFiltrar').val()
            }
        });

    $('.cnpj').mask('00.000.000/0000-00', {reverse: true});
    $('.cep').mask('00000-000');

    // Carrego os Select2 da cidade
    var urlSendAjax = window.location.origin + "/select2/select2Cidades";
    $( '#cidade' ).select2( {
        theme: "bootstrap-5",
        width: $( this ).data( 'width' ) ? $( this ).data( 'width' ) : $( this ).hasClass( 'w-100' ) ? '100%' : 'style',
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
    } );
});

/**
 * dou reload no ajax e recebo via json as inputs em outros campos do back end
 */
$("#btnFiltrar").on("click", function () {
    refreshDataTable(table);
    $("#btnFecharFiltrar").trigger("click");
});

$("form#fornecedorData").on("submit", function (e) {
    e.preventDefault();
    showFullLoading();
    var formData = new FormData(this);
    var urlSendAjax = window.location.origin + "/fornecedores/create";

    // Envio o id do usuário para a url
    if (!isEmpty($("#id_fornecedor").val(), true)) {
        urlSendAjax += '/' + $("#id_fornecedor").val();
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
            success_notification('Sucesso ao criar/editar fornecedor.');
            setTimeout(() => {
                location.href = '/fornecedores';
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
    location.href = 'produtos/add/' + idRegistro;
});

$(document).on("click", ".excluir-registro", function () {
    let idRegistro = $(this).data("id");

    var urlSendAjax = window.location.origin + "/produtos/delete";

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

/**
 * Máscaras
 */

$("#tipo").change(function () {
    $("#cpf_cnpj").val('');
    $("#cpf_cnpj").removeClass('cpf');
    $("#cpf_cnpj").removeClass('cnpj');
    if ($(this).val() === '1') {
        $(".label-cpf-cnpj").html('CNPJ');
        $("#cpf_cnpj").addClass('cnpj');
        $('.cnpj').mask('00.000.000/0000-00', {reverse: true});
    } else {
        $(".label-cpf-cnpj").html('CPF');
        $("#cpf_cnpj").addClass('cpf');
        $('.cpf').mask('000.000.000-00', {reverse: true});
    }
});

$("#cep_button").click(function () {
    showFullLoading();
    let cep = regexOnlyNumbers($("#cep").val());
    let url = 'https://viacep.com.br/ws/' + cep + '/json/';
    let urlSendAjaxCidades = window.location.origin + "/select2/select2Cidades";

    if (cep.length === 8) {
        fetch(url).then(function (response) {
            return response.json();
        }).then(function (data) {
            if (data.erro === true) {
                Swal.fire({
                    icon: "error",
                    title: "Oops...",
                    text: "CEP não encontrado!"
                });
                hideFullLoading();
                return false;
            }

            $("#endereco").val(data.logradouro);
            $("#bairro").val(data.bairro);
            $("#complemento").val(data.complemento);

            // Carrego a cidade no Select2
            let paramsSelect2Cidade = {
              "ibge": data.ibge,
              "idSelect2": "cidade"
            };
            setSelect2Cidade(paramsSelect2Cidade);

            hideFullLoading();
            return true;
        }).catch(function (err) {
            console.log('Fetch Error :-S', err);
            hideFullLoading();
            return false;
        });



    } else {
        hideFullLoading();
    }
});