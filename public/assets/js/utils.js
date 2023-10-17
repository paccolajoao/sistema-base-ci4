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

function showFullLoading () {
    $(".full-loading").css("display", "block");
}

function hideFullLoading() {
    $(".full-loading").css("display", "none");
}