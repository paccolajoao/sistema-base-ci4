<?php

namespace App\Controllers;

use App\Models\UsuarioModel;

class Login extends BaseController
{
    public function index()
    {
        $data['title'] = ucfirst("login");
        if (isUsuarioLogado()) return redirect()->route('/');
        return view("pages/login/login", $data);
    }

    public function realizarLogin() {

        // Removo todos os campos que vem vazio
        array_filter($this->request->getVar());

        // Validação
        if (!$this->validate('loginRules')) {
            // The validation failed.
            $return = ['msg' => 'error', 'error' => $this->validator->getErrors()];
            return redirect()->route('login')->with('retorno', $return);
        }

        // Recebo os dados
        $data = $this->validator->getValidated();

        // Carrego o model
        $userModel = new UsuarioModel();
        $usuarioLogado = $userModel->encontrarUsuarioLogin($data);

        if (empty($usuarioLogado)) {
            $return = ['msg' => 'error', 'error' => ['Usuário não encontrado ou inativado.']];
            return redirect()->route('login')->with('retorno', $return);
        }

        session()->set('usuarioLogado', $usuarioLogado);
        return redirect()->route('/');

    }
}
