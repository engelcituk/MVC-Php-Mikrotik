<nav class="navbar navbar-expand-lg navbar-transparent navbar-absolute fixed-top ">
    <div class="container-fluid">
        <div class="navbar-wrapper">
        <div class="navbar-minimize">
            <button id="minimizeSidebar" class="btn btn-just-icon btn-white btn-fab btn-round">
            <i class=" text_align-center visible-on-sidebar-regular fas fa-ellipsis-v"></i>
            <i class=" visible-on-sidebar-mini fas fa-bars"></i>

            </button>
        </div>
        
        </div>
        <button class="navbar-toggler" type="button" data-toggle="collapse" aria-controls="navigation-index" aria-expanded="false" aria-label="Toggle navigation">
        <span class="sr-only">Toggle navigation</span>
        <span class="navbar-toggler-icon icon-bar"></span>
        <span class="navbar-toggler-icon icon-bar"></span>
        <span class="navbar-toggler-icon icon-bar"></span>
        </button>
        <div class="collapse navbar-collapse justify-content-end">
        
        <ul class="navbar-nav">
            <li class="nav-item dropdown">
            <a class="nav-link" href="#" id="navbarDropdownProfile" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <i class="fas fa-user"></i>
                <p class="d-lg-none d-md-block">
                Account
                </p>
            </a>
            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdownProfile">
                <a class="dropdown-item" href="<?php echo URLROOT; ?>/usuariosmikrotik/editarperfilmikrotik">Perfil</a>
                <div class="dropdown-divider"></div>
                <a class="dropdown-item" href="<?php echo URLROOT; ?>/paginas/logout">Salir</a>
            </div>
            </li>
        </ul>
        </div>
    </div>
    </nav>