<?php require APPROOT . '/views/shared/head.php'; ?>
    <body class="">
        <div class="wrapper ">
            <!-- sidebar -->
            <?php require APPROOT . '/views/shared/sidebar.php'; ?> 
            <!-- sidebar -->
            <div class="main-panel">
            <!-- Navbar -->
                <?php require APPROOT . '/views/shared/navbar.php'; ?> 
            <!-- End Navbar -->
            <div class="content">
                <div class="content">
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-md-12">
                            <a href="<?php echo URLROOT; ?>/usuarioshotspot" class="btn btn-warning mr-auto" > <i class="fas fa-arrow-left"></i> Volver</a> 
                                <div class="card ">
                                    <div class="card-header card-header-success card-header-icon">
                                        <div class="card-icon">
                                            <i class="fas fa-users"></i>
                                        </div>
                                        <h4 class="card-title">Generador de usuarios hotspot <?php 
                                        
                                        echo tranformarTiempo(60, 'minuto')?> </h4>

                                        
                                    </div>
                                    <div class="card-body ">
                                        <form action="<?php echo URLROOT.'/usuarioshotspot/generador'; ?>" method="post">
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="form-group d-none">
                                                        <input type="text" class="form-control" name="tokenCSRF" value="<?php echo $_SESSION["tokencsrf"]; ?>">
                                                    </div>
                                                    
                                                    <div class="form-group">
                                                        <label for="GLAB" class="form-label"> Longitud del nombre de usuario*</label>
                                                        <select class="custom-select custom-select-sm" name="longitudUser">
                                                            <option value="">Elija longitud</option>
                                                            <option value="3">3</option>
                                                            <option value="4">4</option>
                                                            <option value="5">5</option>
                                                            <option value="6">6</option>
                                                        </select> 
                                                        <span class="error"><?php echo $data['fields']['longitudUser_err'];?></span>
                                                    </div>

                                                    <div class="form-group">
                                                        <label for="GLAB" class="form-label"> Grupo Limitación Ancho Banda *</label>
                                                        <select class="custom-select custom-select-sm" name="grupoLimiteAnchosBanda">
                                                            <?php $selected = ($data['fields']['grupoLimiteAnchosBanda'] == '') ? 'selected': '';?>
                                                            <option value='' <?php echo $selected; ?> >Elija</option>
                                                            <?php 
                                                                foreach ($data['anchosBanda'] as $item) {
                                                                    $selected = ($data['fields']['grupoLimiteAnchosBanda'] == $item["name"]) ? 'selected': '';
                                                                    $dash = !empty($item['rate-limit']) ? '--' : ''; //dash es un guion
                                                                    echo '<option value="'.$item["name"].'" '.$selected.'>'.$item["name"].$dash.$item["rate-limit"].'</option>';
                                                            }
                                                            ?>
                                                        </select> 
                                                        <span class="error"><?php echo $data['fields']['grupoLimiteAnchosBanda_err'];?></span>
                                                    </div>


                                                    <div class="form-group">
                                                        <label for="limiteTiempo" class="form-label"> Límite de tiempo *</label> 
                                                        <input type="Contraseña" class="form-control" name="limiteTiempo" aria-required="true" value="<?php echo $data['fields']['limiteTiempo'];?>">
                                                        <span class="error"><?php echo $data['fields']['limiteTiempo_err'];?></span>
                                                    </div>

                                                    <div class="form-group">
                                                        <label for="información" class="form-label"> Precio *</label>
                                                        <textarea class="form-control" name="precio" rows="2" aria-required="true"> <?php echo $data['fields']['precio'];?></textarea>
                                                        <span class="error"><?php echo $data['fields']['precio_err'];?></span>
                                                    </div> 
                                                </div>
                                                <div class="col-md-6">

                                                    <div class="form-group">
                                                        <label for="GLAB" class="form-label"> Longitud de la contraseña*</label>
                                                        <select class="custom-select custom-select-sm" name="longitudPassword">
                                                            <option value="">Elija longitud</option>
                                                            <option value="3">3</option>
                                                            <option value="4">4</option>
                                                            <option value="5">5</option>
                                                            <option value="6">6</option>
                                                        </select> 
                                                        <span class="error"><?php echo $data['fields']['longitudPassword_err'];?></span>
                                                    </div>

                                                    <div class="form-group">
                                                        <label for="GLAB" class="form-label"> Tipo de tiempos*</label>
                                                        <select class="custom-select custom-select-sm" name="tipoTiempos">
                                                            <option value="">Elija un tiempo</option>
                                                            <option value="minuto">Minuto</option>
                                                            <option value="hora">Hora</option>
                                                            <option value="dia">Día </option>
                                                            
                                                        </select> 
                                                        <span class="error"><?php echo $data['fields']['tipoTiempos_err'];?></span>
                                                    </div>

                                                    <div class="form-group">
                                                        <label for="GLAB" class="form-label"> Cantidad de usuarios a generar*</label>
                                                        <select class="custom-select custom-select-sm" name="cantidadUsers">
                                                            <option value="">Elija cantidad</option>
                                                            <option value="5">5 Usuarios</option>
                                                            <option value="10">10 Usuarios</option>
                                                            <option value="15">15 Usuarios</option>
                                                            <option value="20">20 Usuarios</option>
                                                            <option value="25">25 Usuarios</option>
                                                            <option value="50">50 Usuarios</option>
                                                            <option value="100">100 Usuarios</option>
                                                            <option value="150">150 Usuarios</option>
                                                            <option value="200">200 Usuarios</option>
                                                            <option value="250">250 Usuarios</option>
                                                            <option value="300">300 Usuarios</option>
                                                            <option value="500">500 Usuarios</option>
                                                        </select> 
                                                        <span class="error"><?php echo $data['fields']['cantidadUsers_err'];?></span>
                                                    </div>

                                                </div>
                                                
                                            </div>
                                            <button class="btn btn-primary mr-auto"> <i class="fas fa-save"></i> Generar usuarios</button>    
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- footer -->
            <?php require APPROOT . '/views/shared/footer.php'; ?> 
            <!-- footer -->
            </div>
        </div>
        <?php require APPROOT . '/views/shared/scriptjs.php'; ?> 
    </body>
</html>