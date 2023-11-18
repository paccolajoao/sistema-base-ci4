<?php

/**
 * Verifica se um usuário está logado ou não
 * @return bool
 */
function isUsuarioLogado()
{
    $userData = session()->get('usuarioLogado');
    if (empty($userData)) {
        return false;
    }
    return true;
}

/**
 * Gera um guid unico para ser usado como chave única
 * @return string
 */
function getGUID(): string
{
    if (function_exists('com_create_guid')) {
        return com_create_guid();
    } else {
        mt_srand((double)microtime() * 10000);//optional for php 4.2.0 and up.
        $charid = strtoupper(md5(uniqid(rand(), true)));
        $hyphen = chr(45);// "-"
        $uuid = chr(123)// "{"
            . substr($charid, 0, 8) . $hyphen
            . substr($charid, 8, 4) . $hyphen
            . substr($charid, 12, 4) . $hyphen
            . substr($charid, 16, 4) . $hyphen
            . substr($charid, 20, 12)
            . chr(125);// "}"
        return $uuid;
    }
}

/**
 * Ao passar um nome, retorna a primeira e a ultima palavra concatenados
 * @param $nomeCompleto
 * @return string
 */
function getNomeSobrenomeUsuario($nomeCompleto) {
    $array = explode(" ",$nomeCompleto);
    $first_word = $array[0];
    $last_word  = $array[count($array)-1];

    return $first_word. ' '.$last_word;
}