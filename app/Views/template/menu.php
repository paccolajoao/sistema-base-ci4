<!--start sidebar-->
<aside class="sidebar-wrapper">
    <div class="sidebar-header">
        <div class="logo-icon">
            <img src="assets/images/logo-icon.png" class="logo-img" alt="">
        </div>
        <div class="logo-name flex-grow-1">
            <h5 class="mb-0">Roksyn</h5>
        </div>
        <div class="sidebar-close ">
            <span class="material-symbols-outlined">close</span>
        </div>
    </div>
    <!-- Menu Lateral -->
    <div class="sidebar-nav" data-simplebar="true">
        <ul class="metismenu" id="menu">
            <li>
                <a href="<?= base_url('dashboard') ?>">
                    <div class="parent-icon"><i class="fa-solid fa-chart-line"></i></div>
                    <div class="menu-title">Dashboard</div>
                </a>
            </li>
            <li>
                <a href="<?= base_url('usuarios') ?>">
                    <div class="parent-icon"><i class="fa-solid fa-users"></i></div>
                    <div class="menu-title">Usuários</div>
                </a>
            </li>
            <li>
                <a class="has-arrow" href="javascript:;">
                    <div class="parent-icon"><i class="fa-solid fa-folder-plus"></i>
                    </div>
                    <div class="menu-title">Cadastros</div>
                </a>
                <ul>
                    <li> <a href="icons-line-icons.html"><span class="material-symbols-outlined">arrow_right</span>Clientes</a>
                    </li>
                    <li> <a href="icons-boxicons.html"><span class="material-symbols-outlined">arrow_right</span>Estoque</a>
                    </li>
                    <li> <a href="<?= base_url('fornecedores') ?>"><span class="material-symbols-outlined">arrow_right</span>Fornecedores</a>
                    </li>
                    <li> <a href="<?= base_url('produtos') ?>"><span class="material-symbols-outlined">arrow_right</span>Produtos</a>
                    </li>
                    <li> <a href="icons-feather-icons.html"><span class="material-symbols-outlined">arrow_right</span>Serviços</a>
                    </li>
                    <li> <a href="<?= base_url('unidadesmedida') ?>"><span class="material-symbols-outlined">arrow_right</span>Unidades de Medida</a>
                    </li>
                </ul>
            </li>
            <li>
                <a href="<?= base_url('desenvolvimento') ?>">
                    <div class="parent-icon"><i class="fa-solid fa-code"></i></i></div>
                    <div class="menu-title">Development</div>
                </a>
            </li>
        </ul>
    </div>
    <!-- End Menu Lateral -->
    <div class="sidebar-bottom dropdown dropup-center dropup">
        <div class="dropdown-toggle d-flex align-items-center px-3 gap-3 w-100 h-100" data-bs-toggle="dropdown">
            <div class="user-img">
                <img src="<?=
                                !empty(session()->get('usuarioLogado')->profilePicture)
                                ? base_url('assets/img_user/' . session()->get('usuarioLogado')->profilePicture)
                                : 'assets/images/avatars/user_default.png'
                          ?>"
                     alt="">
            </div>
            <div class="user-info">
                <h5 class="mb-0 user-name"><?= getNomeSobrenomeUsuario(session()->get('usuarioLogado')->name) ?></h5>
                <p class="mb-0 user-designation">Aqui vai a permissão Biiz</p>
            </div>
        </div>
        <ul class="dropdown-menu dropdown-menu-end">
            <li><a class="dropdown-item" href="javascript:;"><span class="material-symbols-outlined me-2">
            account_circle
          </span><span>Meu Perfil</span></a>
            </li>
            <li><a class="dropdown-item" href="javascript:;"><span class="material-symbols-outlined me-2">
            tune
          </span><span>Configurações</span></a>
            </li>
            <li>
                <div class="dropdown-divider mb-0"></div>
            </li>
            <li><a class="dropdown-item" id="botaoLogout"><span class="material-symbols-outlined me-2">
            logout
          </span><span>Sair</span></a>
            </li>
        </ul>
    </div>
</aside>
<!--end sidebar-->

<!---- carregando --->
<div class="loading full-loading">
    <div class="spinner-grow" style="width: 4rem; height: 4rem;" role="status"></div>
    <div class="loading-text">
        Carregando...
    </div>
</div>
<!---- end carregando --->