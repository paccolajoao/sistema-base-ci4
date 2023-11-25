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

    /**
     * Produto produtos
     * @var array|array[]
     */
    public array $produtoRules = [
        'nome' => [
            'rules' => 'required|max_length[200]|min_length[6]',
            'errors' => [
                'required' => 'O campo nome é obrigatório.',
                'max_length' => 'Tamanho máximo do campo nome é 200 caracteres.',
                'min_length' => 'Tamanho mínimo do campo nome é 6 caracteres.'
            ],
        ],
        'codigo' => [
            'rules' => 'permit_empty|max_length[50]',
            'errors' => [
                'max_length' => 'Tamanho máximo do campo código é 50 caracteres.'
            ],
        ],
        'ativo' => [
            'rules' => 'required',
            'errors' => [
                'required' => 'O campo status é obrigatório.',
            ],
        ],
        'controla_estoque' => [
            'rules' => 'required',
            'errors' => [
                'required' => 'O campo controla estoque é obrigatório.',
            ],
        ],
        'observacoes' => [
            'rules' => 'max_length[500]',
            'errors' => [
                'max_length' => 'Tamanho máximo do campo observações é 500 caracteres.',
            ],
        ],
    ];

    public array $fornecedorRules = [
        'cpf_cnpj' => [
            'rules' => 'required|max_length[18]|min_length[14]|is_unique[fornecedores.cpf_cnpj]',
            'errors' => [
                'required' => 'O campo CPF/CNPJ é obrigatório.',
                'max_length' => 'Tamanho máximo do campo CPF/CNPJ é 18 caracteres.',
                'min_length' => 'Tamanho mínimo do campo CPF/CNPJ é 14 caracteres.'
            ],
        ],
        'razao_social' => [
            'rules' => 'required|max_length[200]|min_length[10]',
            'errors' => [
                'required' => 'O campo Razão Social é obrigatório.',
                'max_length' => 'Tamanho máximo do campo Razão Social é 200 caracteres.',
                'min_length' => 'Tamanho mínimo do campo Razão Social é 10 caracteres.'
            ],
        ],
        'nome_fantasia' => [
            'rules' => 'permit_empty|max_length[200]|min_length[10]',
            'errors' => [
                'max_length' => 'Tamanho máximo do campo Nome Fantasia é 200 caracteres.',
                'min_length' => 'Tamanho mínimo do campo Nome Fantasia é 10 caracteres.'
            ],
        ],
        'inscricao_municipal' => [
            'rules' => 'permit_empty|max_length[50]|min_length[8]',
            'errors' => [
                'max_length' => 'Tamanho máximo do campo Inscrição Municipal é 200 caracteres.',
                'min_length' => 'Tamanho mínimo do campo Inscrição Municipal é 6 caracteres.'
            ],
        ],
        'inscricao_estadual' => [
            'rules' => 'permit_empty|max_length[50]|min_length[8]',
            'errors' => [
                'max_length' => 'Tamanho máximo do campo Inscrição Estadual é 200 caracteres.',
                'min_length' => 'Tamanho mínimo do campo Inscrição Estadual é 6 caracteres.'
            ],
        ],
        'codigo' => [
            'rules' => 'permit_empty|max_length[50]',
            'errors' => [
                'max_length' => 'Tamanho máximo do campo código é 50 caracteres.'
            ],
        ],
        'ativo' => [
            'rules' => 'required',
            'errors' => [
                'required' => 'O campo status é obrigatório.',
            ],
        ],
        'tipo' => [
            'rules' => 'required',
            'errors' => [
                'required' => 'O campo tipo é obrigatório.',
            ],
        ],
        'porte' => [
            'rules' => 'required',
            'errors' => [
                'required' => 'O campo porte é obrigatório.',
            ],
        ],
        'observacoes' => [
            'rules' => 'max_length[500]',
            'errors' => [
                'max_length' => 'Tamanho máximo do campo observações é 500 caracteres.',
            ],
        ],
    ];

    public array $unidadeMedidaRules = [
        'nome' => [
            'rules' => 'required|max_length[50]|min_length[3]',
            'errors' => [
                'required' => 'O campo nome é obrigatório.',
                'max_length' => 'Tamanho máximo do campo nome é 50 caracteres.',
                'min_length' => 'Tamanho mínimo do campo nome é 3 caracteres.'
            ],
        ],
        'isRelacional' => [
            'rules' => 'required',
            'errors' => [
                'required' => 'O campo relacional é obrigatório.',
            ],
        ],
        'ativo' => [
            'rules' => 'required',
            'errors' => [
                'required' => 'O campo ativo é obrigatório.',
            ],
        ],
        'quantidade' => [
            'rules' => 'required_with[isRelacional]',
            'errors' => [
                'required_with' => 'Caso seja uma unidade de medida relacional, digite a quantidade.'
            ],
        ],
        'UMBase' => [
            'rules' => 'required_with[isRelacional]',
            'errors' => [
                'required_with' => 'Caso seja uma unidade de medida relacional, selecione a Unidade de Medida base.'
            ],
        ]
    ];
}