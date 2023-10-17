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
     * Usuário User
     * @var array|array[]
     */
    public array $userRules = [
        'username' => [
            'rules' => 'required|max_length[50]|min_length[6]|is_unique[user.username]',
            'errors' => [
                'required' => 'You must choose a Username.',
                'max_length' => 'Max length is 30 characters.',
                'min_length' => 'Min length is 6 characters.',
                'is_unique' => 'This username is already registered.'
            ],
        ],
        'password' => [
            'rules' => 'required|max_length[30]|min_length[10]',
            'errors' => [
                'required' => 'You must choose a Password.',
                'max_length' => 'Max length is 254 characters.',
                'min_length' => 'Min length is 10 characters.'
            ],
        ],
        'pass_conference' => [
            'rules' => 'required|max_length[30]|min_length[10]|matches[password]',
            'errors' => [
                'required' => 'You must choose a Conference Password.',
                'max_length' => 'Max length is 254 characters.',
                'min_length' => 'Min length is 10 characters.'
            ],
        ],
        'status' => [
            'rules' => 'required',
            'errors' => [
                'required' => 'You must choose a Status.',
            ],
        ],
        'name' => [
            'rules' => 'required|max_length[100]|min_length[6]',
            'errors' => [
                'required' => 'You must choose a Name.',
                'max_length' => 'Max length is 254 characters.',
                'min_length' => 'Min length is 6 characters.'
            ],
        ],
        'email' => [
            'rules' => 'required|max_length[50]|valid_email|is_unique[user.email]',
            'errors' => [
                'required' => 'Please check the Email field. It does not appear to be valid.',
                'max_length' => 'Max length is 254 characters.',
                'valid_email' => 'Please check the Email field. It does not appear to be valid.',
                'is_unique' => 'This email is already registered.'
            ],
        ]
    ];
}
