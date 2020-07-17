<div class="sidebar" data-color="rose" data-background-color="black" data-image="<?php echo URLROOT; ?>/img/sidebar-1.jpg">
      <div class="logo">
        <a href="http://www.creative-tim.com/" class="simple-text logo-mini">
          CT
        </a>
        <a href="http://www.creative-tim.com/" class="simple-text logo-normal">
          Creative Tim
        </a>
      </div>
      <div class="sidebar-wrapper">
        <div class="user">
          <div class="photo">
            <img src="<?php echo URLROOT; ?>/img/avatar.jpg" />
          </div>
          <div class="user-info">
            <a data-toggle="collapse" href="#collapseExample" class="username">
              <span>
                Tania Andrew
                <b class="caret"></b>
              </span>
            </a>
            <div class="collapse" id="collapseExample">
              <ul class="nav">
                <li class="nav-item">
                  <a class="nav-link" href="#">
                    <span class="sidebar-mini"> P </span>
                    <span class="sidebar-normal"> Perfil </span>
                  </a>
                </li>
              </ul>
            </div>
          </div>
        </div>
        <ul class="nav">
          <li class="nav-item <?php echo activeMenu('dashboard'); ?> ">
            <a class="nav-link" href="<?php echo URLROOT; ?>/dashboard">
              <i class="material-icons">dashboard</i>
              <p> Dashboard </p>
            </a>
          </li>
          <li class="nav-item ">
            <a class="nav-link" data-toggle="collapse" href="#pagesExamples">
              <i class="material-icons">group</i>
              <p> Usuarios hotspot
                <b class="caret"></b>
              </p>
            </a>
            <div class="collapse <?php echo setCollapseShow('usuarioshotspot'); ?>" id="pagesExamples">
              <ul class="nav">
                <li class="nav-item <?php echo activeMenu('usuarioshotspot'); ?>">
                  <a class="nav-link" href="<?php echo URLROOT; ?>/usuarioshotspot">
                    <span class="sidebar-mini"> UH </span>
                    <span class="sidebar-normal">Usuarios hotspot </span>
                  </a>
                </li>
                <li class="nav-item <?php echo activeMenu('usuarioshotspot'); ?>">
                  <a class="nav-link" href="<?php echo URLROOT; ?>/usuarioshotspot/activos">
                    <span class="sidebar-mini"> UA </span>
                    <span class="sidebar-normal"> Usuarios activos </span>
                  </a>
                </li>
                <li class="nav-item <?php echo activeMenu('usuarioshotspot'); ?>">
                  <a class="nav-link" href="<?php echo URLROOT; ?>/usuarioshotspot/generador">
                    <span class="sidebar-mini"> G </span>
                    <span class="sidebar-normal"> Generador </span>
                  </a>
                </li>
                <li class="nav-item <?php echo activeMenu('usuarioshotspot'); ?>">
                  <a class="nav-link" href="<?php echo URLROOT; ?>/usuarioshotspot/agregar">
                    <span class="sidebar-mini"> AU </span>
                    <span class="sidebar-normal"> Agregar usuario </span>
                  </a>
                </li>
                
              </ul>
            </div>
          </li>
          <li class="nav-item ">
            <a class="nav-link" data-toggle="collapse" href="#componentsExamples">
              <i class="material-icons">connect_without_contact</i>
              <p> Grupo límite
                <b class="caret"></b>
              </p>
            </a>
            <div class="collapse" id="componentsExamples">
              <ul class="nav">
                <li class="nav-item ">
                  <a class="nav-link" href="<?php echo URLROOT; ?>/grupolimiteanchobanda">
                    <span class="sidebar-mini"> LGL </span>
                    <span class="sidebar-normal"> Lista de grupo límite </span>
                  </a>
                </li>
                <li class="nav-item ">
                  <a class="nav-link" href="<?php echo URLROOT; ?>/grupolimiteanchobanda/generador">
                    <span class="sidebar-mini"> AGL </span>
                    <span class="sidebar-normal"> Agregar grupo limite </span>
                  </a>
                </li>
                
                
              </ul>
            </div>
          </li>
          <li class="nav-item ">
            <a class="nav-link" data-toggle="collapse" href="#formsExamples">
              <i class="material-icons">menu</i>
              <p> Extras mikrotik
                <b class="caret"></b>
              </p>
            </a>
            <div class="collapse" id="formsExamples">
              <ul class="nav">
                <li class="nav-item ">
                  <a class="nav-link" href="<?php echo URLROOT; ?>/usuariosmikrotik/editarperfilmikrotik ">
                    <span class="sidebar-mini"> P </span>
                    <span class="sidebar-normal"> Perfil </span>
                  </a>
                </li>
                <li class="nav-item ">
                  <a class="nav-link" href="<?php echo URLROOT; ?>/usuariosmikrotik">
                    <span class="sidebar-mini"> UM </span>
                    <span class="sidebar-normal"> Usuarios Mikrotik </span>
                  </a>
                </li>
                <li class="nav-item ">
                  <a class="nav-link" href="<?php echo URLROOT; ?>/usuariosmikrotik/editarpassword">
                    <span class="sidebar-mini"> ECM </span>
                    <span class="sidebar-normal"> Editar contraseña MKT </span>
                  </a>
                </li>
                <li class="nav-item ">
                  <a class="nav-link" href="<?php echo URLROOT; ?>/usuariosmikrotik/editaridentidad">
                    <span class="sidebar-mini"> EIM </span>
                    <span class="sidebar-normal"> Editar identidad MKT </span>
                  </a>
                </li>
                <li class="nav-item ">
                  <a class="nav-link" href="<?php echo URLROOT; ?>/usuariosmikrotik/reiniciarmikrotik">
                    <span class="sidebar-mini"> RM </span>
                    <span class="sidebar-normal"> Reiniciar Mikrotik </span>
                  </a>
                </li>
              </ul>
            </div>
          </li>
          
        </ul>
      </div>
    </div>