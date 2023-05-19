<?php

namespace App\Controllers;

use App\Models\UsuarioModel;

class Usuario extends BaseController
{
  private UsuarioModel $usuariomodel;

  public function index()
  {

    $data['title'] = ucfirst("usuários");
    return view("pages/usuario/index", $data);
  }
}
