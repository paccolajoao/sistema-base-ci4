<?php

namespace Config;

use CodeIgniter\Config\BaseConfig;
use CodeIgniter\Validation\StrictRules\CreditCardRules;
use CodeIgniter\Validation\StrictRules\FileRules;
use CodeIgniter\Validation\StrictRules\FormatRules;
use CodeIgniter\Validation\StrictRules\Rules;

class Validation extends BaseConfig
{
    // --------------------------------------------------------------------
    // Setup
    // --------------------------------------------------------------------

    /**
     * Stores the classes that contain the
     * rules that are available.
     *
     * @var string[]
     */
    public array $ruleSets = [
        Rules::class,
        FormatRules::class,
        FileRules::class,
        CreditCardRules::class,
    ];

    /**
     * Specifies the views that are used to display the
     * errors.
     *
     * @var array<string, string>
     */
    public array $templates = [
        'list'   => 'CodeIgniter\Validation\Views\list',
        'single' => 'CodeIgniter\Validation\Views\single',
    ];

    // --------------------------------------------------------------------
    // Rules
    // --------------------------------------------------------------------

    /**
     * Usuário usuario
     * @var array|array[]
     */
    public array $userRules = [
        'username' => [
            'rules' => 'required|max_length[50]|min_length[6]|is_unique[usuario.username]',
            'errors' => [
                'required' => 'O campo usuário é obrigatório.',
                'max_length' => 'Tamanho máximo do campo usuário é 50 caracteres.',
                'min_length' => 'Tamanho mínimo do campo usuário é 6 caracteres.',
                'is_unique' => 'Esse usuário já foi cadastrado.'
            ],
        ],
        'password' => [
            'rules' => 'required|max_length[30]|min_length[10]',
            'errors' => [
                'required' => 'O campo senha é obrigatório.',
                'max_length' => 'Tamanho máximo do campo senha é 30 caracteres.',
                'min_length' => 'Tamanho mínimo do campo senha é 10 caracteres.'
            ],
        ],
        'pass_conference' => [
            'rules' => 'required|max_length[30]|min_length[10]|matches[password]',
            'errors' => [
                'required' => 'O campo confirmação senha é obrigatório.',
                'max_length' => 'Tamanho máximo do campo confirmação senha é 30 caracteres.',
                'min_length' => 'Tamanho mínimo do campo confirmação senha é 10 caracteres.',
                'matches' => 'O campo confirmação senha é diferente do campo senha.'
            ],
        ],
        'status' => [
            'rules' => 'required',
            'errors' => [
                'required' => 'O campo status é obrigatório.',
            ],
        ],
        'name' => [
            'rules' => 'required|max_length[100]|min_length[6]',
            'errors' => [
                'required' => 'O campo nome é obrigatório.',
                'max_length' => 'Tamanho máximo do campo nome é 100 caracteres.',
                'min_length' => 'Tamanho mínimo do campo nome é 6 caracteres.'
            ],
        ],
        'email' => [
            'rules' => 'required|max_length[50]|valid_email|is_unique[usuario.email]',
            'errors' => [
                'required' => 'O campo email é obrigatório.',
                'max_length' => 'Tamanho máximo do campo email senha é 50 caracteres.',
                'valid_email' => 'O email não é válido.',
                'is_unique' => 'Esse email já foi cadastrado.'
            ],
        ],
        'foto_perfil' => [
            'rules' => 'is_image[foto_perfil]|ext_in[foto_perfil,jpge,jpg,png]|max_size[foto_perfil,2048]',
            'errors' => [
                'is_image[foto_perfil]' => 'O arquivo inserido não é uma imagem.',
                'ext_in[foto_perfil,jpge,jpg,png]' => 'Formato da foto não permitido.'
            ],
        ]
    ];

    public array $userUpdateRules = [
        'username' => [
            'rules' => 'required|max_length[50]|min_length[6]',
            'errors' => [
                'required' => 'O campo usuário é obrigatório.',
                'max_length' => 'Tamanho máximo do campo usuário é 50 caracteres.',
                'min_length' => 'Tamanho mínimo do campo usuário é 6 caracteres.',
                'is_unique' => 'Esse usuário já foi cadastrado.'
            ],
        ],
        'password' => [
            'rules' => 'permit_empty|min_length[10]|max_length[30]',
            'errors' => [
                'required' => 'O campo senha é obrigatório.',
                'max_length' => 'Tamanho máximo do campo senha é 30 caracteres.',
                'min_length' => 'Tamanho mínimo do campo senha é 10 caracteres.'
            ],
        ],
        'pass_conference' => [
            'rules' => 'permit_empty|min_length[10]|max_length[30]|matches[password]',
            'errors' => [
                'required' => 'O campo confirmação senha é obrigatório.',
                'max_length' => 'Tamanho máximo do campo confirmação senha é 30 caracteres.',
                'min_length' => 'Tamanho mínimo do campo confirmação senha é 10 caracteres.',
                'matches' => 'O campo confirmação senha é diferente do campo senha.'
            ],
        ],
        'status' => [
            'rules' => 'required',
            'errors' => [
                'required' => 'O campo status é obrigatório.',
            ],
        ],
        'name' => [
            'rules' => 'required|max_length[100]|min_length[6]',
            'errors' => [
                'required' => 'O campo nome é obrigatório.',
                'max_length' => 'Tamanho máximo do campo nome é 100 caracteres.',
                'min_length' => 'Tamanho mínimo do campo nome é 6 caracteres.'
            ],
        ],
        'email' => [
            'rules' => 'required|max_length[50]|valid_email',
            'errors' => [
                'required' => 'O campo email é obrigatório.',
                'max_length' => 'Tamanho máximo do campo email senha é 50 caracteres.',
                'valid_email' => 'O email não é válido.',
                'is_unique' => 'Esse email já foi cadastrado.'
            ],
        ],
        'foto_perfil' => [
            'rules' => 'is_image[foto_perfil]|ext_in[foto_perfil,jpge,jpg,png]|max_size[foto_perfil,2048]',
            'errors' => [
                'is_image[foto_perfil]' => 'O arquivo inserido não é uma imagem.',
                'ext_in[foto_perfil,jpge,jpg,png]' => 'Formato da foto não permitido.'
            ],
        ]
    ];

    /**
     * Login usuario
     * @var array|array[]
     */

    public array $loginRules = [
        'input_user' => [
            'rules' => 'required|max_length[50]|min_length[6]',
            'errors' => [
                'required' => 'O campo usuário é obrigatório.',
                'max_length' => 'Usuário deve conter no máximo é 50 caracteres.',
                'min_length' => 'Usuário deve conter no mínimo é 6 caracteres.'
            ],
        ],
        'input_password' => [
            'rules' => 'required|max_length[30]|min_length[10]',
            'errors' => [
                'required' => 'O campo senha é obrigatório.',
                'max_length' => 'Senha deve conter no máximo 30 caracteres.',
                'min_length' => 'Senha deve conter no mínimo 10 caracteres.'
            ],
        ]
    ];
}
