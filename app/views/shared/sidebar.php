<div class="sidebar" data-color="rose" data-background-color="black" data-image="<?php echo URLROOT; ?>/img/sidebar-1.png">
      <div class="logo">
        <a href="#" class="simple-text logo-mini">
          MK
        </a>
        <a href="#" class="simple-text logo-normal">
          Mikrotik php
        </a>
      </div>
      <div class="sidebar-wrapper">
        <div class="user">
          <div class="photo">
            <img src="<?php echo URLROOT; ?>/img/avatar.png" />
          </div>
          <div class="user-info">
            <a data-toggle="collapse" href="#collapseExample" class="username">
              <span>
                 <?php echo $_SESSION['usuario'];?>
                <b class="caret"></b>
              </span>
            </a>
            <div class="collapse" id="collapseExample">
              <ul class="nav">
                <li class="nav-item">
                  <a class="nav-link" href="<?php echo URLROOT; ?>/usuariosmikrotik/editarperfilmikrotik">
                    <span class="sidebar-mini"> P </span>
                    <span class="sidebar-normal"> Perfil </span>
                  </a>
                </li>
              </ul>
            </div>
          </div>
        </div>
        <ul class="nav">
          <li class="nav-item <?php echo activeMenu(ROOTFOLDER.'dashboard'); ?>">
            <a class="nav-link" href="<?php echo URLROOT; ?>/dashboard">
            <i class="fas fa-tachometer-alt"></i>
              <p> Dashboard </p>
            </a>
          </li>
          <li class="nav-item <?php echo activeMenuArray([ROOTFOLDER.'usuarioshotspot']); ?>">
            <a class="nav-link" data-toggle="collapse" href="#pagesExamples">
            <i class="fas fa-users"></i>
              <p> Hotspot
                <b class="caret"></b>
              </p>
            </a>
            <div class="collapse <?php echo setCollapseShowArray([ROOTFOLDER.'usuarioshotspot',ROOTFOLDER.'usuarioshotspot/activos',ROOTFOLDER.'usuarioshotspot/generador',ROOTFOLDER.'usuarioshotspot/agregar']); ?>" id="pagesExamples">
              <ul class="nav">
                <li class="nav-item <?php echo activeMenu(ROOTFOLDER.'usuarioshotspot'); ?>">
                  <a class="nav-link" href="<?php echo URLROOT; ?>/usuarioshotspot">
                    <span class="sidebar-mini"> <i class="fas fa-users"></i> </span>
                    <span class="sidebar-normal">Usuarios hotspot </span>
                  </a>
                </li>
                <li class="nav-item <?php echo activeMenu(ROOTFOLDER.'usuarioshotspot/activos'); ?>">
                  <a class="nav-link" href="<?php echo URLROOT; ?>/usuarioshotspot/activos">
                    <span class="sidebar-mini"> <i class="fas fa-hourglass-start"></i> </span>
                    <span class="sidebar-normal"> Usuarios activos </span>
                  </a>
                </li>
                <li class="nav-item <?php echo activeMenu(ROOTFOLDER.'usuarioshotspot/generador'); ?>">
                  <a class="nav-link" href="<?php echo URLROOT; ?>/usuarioshotspot/generador">
                    <span class="sidebar-mini"> <i class="fas fa-plus-square"></i>  </span>
                    <span class="sidebar-normal"> Generador </span>
                  </a>
                </li>
                <li class="nav-item <?php echo activeMenu(ROOTFOLDER.'usuarioshotspot/agregar'); ?>">
                  <a class="nav-link" href="<?php echo URLROOT; ?>/usuarioshotspot/agregar">
                    <span class="sidebar-mini"> <i class="fas fa-user"></i>  </span>
                    <span class="sidebar-normal"> Agregar usuario </span>
                  </a>
                </li>
                
              </ul>
            </div>
          </li>
          <li class="nav-item <?php echo activeMenuArray([ROOTFOLDER.'grupolimiteanchobanda',ROOTFOLDER.'grupolimiteanchobanda/generador']); ?>">
            <a class="nav-link" data-toggle="collapse" href="#componentsExamples">
            <i class="fas fa-wifi"></i>
              <p> Grupo límite
                <b class="caret"></b>
              </p>
            </a>
            <div class="collapse <?php echo setCollapseShowArray([ROOTFOLDER.'grupolimiteanchobanda',ROOTFOLDER.'grupolimiteanchobanda/generador']); ?> " id="componentsExamples">
              <ul class="nav">
                <li class="nav-item <?php echo activeMenu(ROOTFOLDER.'grupolimiteanchobanda'); ?>">
                  <a class="nav-link" href="<?php echo URLROOT; ?>/grupolimiteanchobanda">
                    <span class="sidebar-mini"> <i class="fas fa-list"></i> </span>
                    <span class="sidebar-normal"> Lista de grupo límite </span>
                  </a>
                </li>
                <li class="nav-item <?php echo activeMenu(ROOTFOLDER.'grupolimiteanchobanda/generador'); ?>">
                  <a class="nav-link" href="<?php echo URLROOT; ?>/grupolimiteanchobanda/generador">
                    <span class="sidebar-mini"> <i class="fas fa-layer-group"></i> </span>
                    <span class="sidebar-normal"> Agregar grupo limite </span>
                  </a>
                </li>
                
                
              </ul>
            </div>
          </li>
          <li class="nav-item <?php echo activeMenuArray([ROOTFOLDER.'usuariosmikrotik/editarperfilmikrotik',ROOTFOLDER.'usuariosmikrotik',ROOTFOLDER.'usuariosmikrotik/editarpassword',ROOTFOLDER.'usuariosmikrotik/editaridentidad',ROOTFOLDER.'usuariosmikrotik/reiniciarmikrotik',ROOTFOLDER.'usuariosmikrotik/datosticket']); ?>">
            <a class="nav-link" data-toggle="collapse" href="#formsExamples">
            <i class="fas fa-bars"></i>
              <p> Extras mikrotik
                <b class="caret"></b>
              </p>
            </a>
            <div class="collapse <?php echo setCollapseShowArray([ROOTFOLDER.'usuariosmikrotik/editarperfilmikrotik',ROOTFOLDER.'usuariosmikrotik',ROOTFOLDER.'usuariosmikrotik/editarpassword',ROOTFOLDER.'usuariosmikrotik/agregar',ROOTFOLDER.'usuariosmikrotik/editaridentidad',ROOTFOLDER.'usuariosmikrotik/reiniciarmikrotik',ROOTFOLDER.'usuariosmikrotik/datosticket']); ?> " id="formsExamples">
              <ul class="nav">
                <li class="nav-item <?php echo activeMenu(ROOTFOLDER.'usuariosmikrotik'); ?>">
                  <a class="nav-link" href="<?php echo URLROOT; ?>/usuariosmikrotik">
                    <span class="sidebar-mini"> <i class="fas fa-users"></i> </span>
                    <span class="sidebar-normal"> Usuarios Mikrotik </span>
                  </a>
                </li>
                <li class="nav-item <?php echo activeMenu(ROOTFOLDER.'usuariosmikrotik/agregar'); ?>">
                  <a class="nav-link" href="<?php echo URLROOT; ?>/usuariosmikrotik/agregar">
                    <span class="sidebar-mini"> <i class="fas fa-plus-square"></i> </span>
                    <span class="sidebar-normal"> Agregar </span>
                  </a>
                </li>
                <li class="nav-item <?php echo activeMenu(ROOTFOLDER.'usuariosmikrotik/editarperfilmikrotik'); ?>">
                  <a class="nav-link" href="<?php echo URLROOT; ?>/usuariosmikrotik/editarperfilmikrotik ">
                    <span class="sidebar-mini"> <i class="fas fa-user-circle"></i> </span>
                    <span class="sidebar-normal"> Perfil </span>
                  </a>
                </li>
                <li class="nav-item <?php echo activeMenu(ROOTFOLDER.'usuariosmikrotik/editarpassword'); ?>">
                  <a class="nav-link" href="<?php echo URLROOT; ?>/usuariosmikrotik/editarpassword">
                    <span class="sidebar-mini"> <i class="fas fa-lock"></i> </span>
                    <span class="sidebar-normal"> Editar contraseña MKT </span>
                  </a>
                </li>
                <li class="nav-item <?php echo activeMenu(ROOTFOLDER.'usuariosmikrotik/editaridentidad'); ?>">
                  <a class="nav-link" href="<?php echo URLROOT; ?>/usuariosmikrotik/editaridentidad">
                    <span class="sidebar-mini"> <i class="fas fa-file-signature"></i> </span>
                    <span class="sidebar-normal"> Editar identidad MKT </span>
                  </a>
                </li>
                
                <li class="nav-item <?php echo activeMenu(ROOTFOLDER.'usuariosmikrotik/datosticket'); ?>">
                <a class="nav-link" href="<?php echo URLROOT; ?>/usuariosmikrotik/datosticket">
                    <span class="sidebar-mini"> <i class="fas fa-ticket-alt"></i></span>
                    <span class="sidebar-normal"> Datos Ticket </span>
                  </a>
                </li>

                <li class="nav-item <?php echo activeMenu(ROOTFOLDER.'usuariosmikrotik/reiniciarmikrotik'); ?>">
                  <a class="nav-link" href="<?php echo URLROOT; ?>/usuariosmikrotik/reiniciarmikrotik">
                    <span class="sidebar-mini"> <i class="fas fa-power-off"></i> </span>
                    <span class="sidebar-normal"> Reiniciar Mikrotik </span>
                  </a>
                </li>

              </ul>
            </div>
          </li>

        </ul>
      </div>
    </div>