/**
 * Função para verificar se um valor é vazio (null, empty ou undefined)
 * @param val string|int|float Valor a ser verificado
 * @param zeroIsEmpty boolean True: Zero é considerado vazio. False: Zero não é considerado vazio.
 * @returns {boolean}
 */
function isEmpty (val, zeroIsEmpty = false) {
    if (val === '') {
        return true;
    }

    if (val === null) {
        return true;
    }

    if (val === undefined) {
        return true;
    }

    if (zeroIsEmpty === true) {
        if (val === 0) {
            return true;
        }

        if (val === '0') {
            return true;
        }
    }

    return false;
}

/**
 * LOADING
 */
function showFullLoading () {
    $(".full-loading").css("display", "block");
}

function hideFullLoading () {
    $(".full-loading").css("display", "none");
}

/**
 * DATATABLE
 */

/**
 * DataTable inicializa o datatable
 * @param idTable
 * @param urlAjax
 * @param filterParams
 * @returns {*|jQuery}
 */
function initDataTable (idTable, urlAjax, filterParams = {}) {
    return $('#' + idTable).DataTable({
        language: {
            url: '//cdn.datatables.net/plug-ins/1.13.4/i18n/pt-BR.json',
        },
        pageLength: 25,
        order: [[1, 'asc']],
        processing: true,
        deferRender: true,
        dom: 'Bfrtip',
        buttons: [
            'excel', 'csv',
            {
                extend: 'pdf',
                orientation: 'landscape',
                pageSize: 'A4'
            }
        ],
        ajax: {
            url: urlAjax,
            data: filterParams
        }
    });
}

/**
 * Atualiza o Data Table na tela
 * @param table
 */
function refreshDataTable (table) {
    table.clear();
    table.ajax.reload();
    table.draw();
}

/**
 * NOTIFICAÇÕES
 */

/**
 * Função para splitar o obj da mensagem e retornar todos os erros
 * por linha
 * @param a Objeto que será splitado e todos os erros serão trazidos em uma string
 * @returns {string} String contendo os erros do obj passado como parametro
 */
function joinObj(a) {
    if (typeof a !== 'object') {
        console.log(a);
        return 'Erro de requisição. Contate o suporte.';
    }
    var out = [];
    Object.values(a).forEach(val => {
        out.push(val);
    });
    return out.join("<br>");
}

/**
 * Notificação de erro
 * @param msg Objeto da mensagem a ser exibido o erro
 */
function error_notification(msg) {
    Lobibox.notify('error', {
        pauseDelayOnHover: true,
        continueDelayOnInactiveTab: false,
        position: 'top right',
        sound: false,
        rounded: true,
        icon: 'bi bi-x-circle-fill',
        msg: joinObj(msg)
    });
}

/**
 * Notificação de sucesso
 * @param msg Texto da mensagem de sucesso a ser exibida
 */

function success_notification(msg) {
    Lobibox.notify('success', {
        pauseDelayOnHover: true,
        continueDelayOnInactiveTab: false,
        sound: false,
        rounded: true,
        position: 'top right',
        icon: 'bi bi-check-circle-fill',
        msg: msg
    });
}