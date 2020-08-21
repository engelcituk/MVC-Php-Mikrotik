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
                                
                                <?php flashMensaje('messageApi'); ?>

                                <div class="card ">
                                    <div class="card-header card-header-success card-header-icon">
                                        <div class="card-icon">
                                            <i class="fas fa-users"></i>
                                        </div>
                                        <h4 class="card-title">Generador de usuarios hotspot</h4>

                                        
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
                                                            <option value="" <?php echo ($data['fields']['longitudUser'] == '' ) ? 'selected': ''; ?> >Elija longitud</option>
                                                            <option value="3" <?php echo ($data['fields']['longitudUser'] == 3 ) ? 'selected': ''; ?> >3</option>
                                                            <option value="4" <?php echo ($data['fields']['longitudUser'] == 4 ) ? 'selected': ''; ?> >4</option>
                                                            <option value="5" <?php echo ($data['fields']['longitudUser'] == 5 ) ? 'selected': ''; ?> >5</option>
                                                            <option value="6" <?php echo ($data['fields']['longitudUser'] == 6 ) ? 'selected': ''; ?> >6</option>
                                                        </select> 
                                                        <span class="error"><?php echo $data['fields']['longitudUser_err'];?></span>
                                                    </div>

                                                    <div class="form-group">
                                                        <label for="GLAB" class="form-label"> Perfil *</label>
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
                                                        <input type="number" min="1" class="form-control validarEntero" name="limiteTiempo" aria-required="true" value="<?php echo $data['fields']['limiteTiempo'];?>" placeholder="ingrese un numero para minutos, horas o días">
                                                        <span class="error"><?php echo $data['fields']['limiteTiempo_err'];?></span>
                                                    </div>

                                                    <div class="form-group">
                                                        <label for="información" class="form-label"> Precio </label>
                                                        <textarea class="form-control" name="precio" rows="2" aria-required="true" > <?php echo $data['fields']['precio'];?></textarea>
                                                        <span class="error"><?php echo $data['fields']['precio_err'];?></span>
                                                    </div> 
                                                </div>
                                                <div class="col-md-6">

                                                    <div class="form-group">
                                                        <label for="GLAB" class="form-label"> Longitud de la contraseña*</label>
                                                        <select class="custom-select custom-select-sm" name="longitudPassword">
                                                            <option value="" <?php echo ($data['fields']['longitudPassword'] == '' ) ? 'selected': ''; ?> >Elija longitud</option>
                                                            <option value="3" <?php echo ($data['fields']['longitudPassword'] == 3 ) ? 'selected': ''; ?> >3</option>
                                                            <option value="4" <?php echo ($data['fields']['longitudPassword'] == 4 ) ? 'selected': ''; ?> >4</option>
                                                            <option value="5" <?php echo ($data['fields']['longitudPassword'] == 5 ) ? 'selected': ''; ?> >5</option>
                                                            <option value="6" <?php echo ($data['fields']['longitudPassword'] == 6 ) ? 'selected': ''; ?> >6</option>
                                                        </select> 
                                                        <span class="error"><?php echo $data['fields']['longitudPassword_err'];?></span>
                                                    </div>

                                                    <div class="form-group">
                                                        <label for="GLAB" class="form-label"> Tipo de tiempos*</label>
                                                        <select class="custom-select custom-select-sm" name="tipoTiempos">
                                                            <option value="" <?php echo ($data['fields']['tipoTiempos'] == '' ) ? 'selected': ''; ?> >Elija un tiempo</option>
                                                            <option value="minuto" <?php echo ($data['fields']['tipoTiempos'] == 'minuto' ) ? 'selected': ''; ?> >Minuto</option>
                                                            <option value="hora" <?php echo ($data['fields']['tipoTiempos'] == 'hora' ) ? 'selected': ''; ?> >Hora</option>
                                                            <option value="dia" <?php echo ($data['fields']['tipoTiempos'] == 'dia' ) ? 'selected': ''; ?> >Día </option>
                                                            
                                                        </select> 
                                                        <span class="error"><?php echo $data['fields']['tipoTiempos_err'];?></span>
                                                    </div>

                                                    <div class="form-group">
                                                        <label for="GLAB" class="form-label"> Cantidad de usuarios a generar*</label>
                                                        <select class="custom-select custom-select-sm" name="cantidadUsers">
                                                            <option value="" <?php echo ($data['fields']['cantidadUsers'] == '' ) ? 'selected': ''; ?> >Elija cantidad</option>
                                                            <option value="5" <?php echo ($data['fields']['cantidadUsers'] == 5 ) ? 'selected': ''; ?> >5 Usuarios</option>
                                                            <option value="10" <?php echo ($data['fields']['cantidadUsers'] == 10 ) ? 'selected': ''; ?> >10 Usuarios</option>
                                                            <option value="15" <?php echo ($data['fields']['cantidadUsers'] == 15 ) ? 'selected': ''; ?> >15 Usuarios</option>
                                                            <option value="20" <?php echo ($data['fields']['cantidadUsers'] == 20 ) ? 'selected': ''; ?> >20 Usuarios</option>
                                                            <option value="25" <?php echo ($data['fields']['cantidadUsers'] == 25 ) ? 'selected': ''; ?> >25 Usuarios</option>
                                                            <option value="50" <?php echo ($data['fields']['cantidadUsers'] == 50 ) ? 'selected': ''; ?> >50 Usuarios</option>
                                                            <option value="100" <?php echo ($data['fields']['cantidadUsers'] == 100 ) ? 'selected': ''; ?> >100 Usuarios</option>
                                                            <option value="150" <?php echo ($data['fields']['cantidadUsers'] == 150 ) ? 'selected': ''; ?> >150 Usuarios</option>
                                                            <option value="200" <?php echo ($data['fields']['cantidadUsers'] == 200 ) ? 'selected': ''; ?> >200 Usuarios</option>
                                                            <option value="250" <?php echo ($data['fields']['cantidadUsers'] == 250 ) ? 'selected': ''; ?> >250 Usuarios</option>
                                                            <option value="300" <?php echo ($data['fields']['cantidadUsers'] == 300 ) ? 'selected': ''; ?> >300 Usuarios</option>
                                                            <option value="500" <?php echo ($data['fields']['cantidadUsers'] == 500 ) ? 'selected': ''; ?> >500 Usuarios</option>
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
        <script src="<?php echo URLROOT; ?>/js/usuariosHotspot/generador.js"></script> <!-- Contiene el script para aplicar validaciones -->
    </body>
</html>