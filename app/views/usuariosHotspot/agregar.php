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
                                        <i class="fas fa-user"></i>
                                    </div>
                                    <h4 class="card-title">Agregar un solo usuario hotspot</h4>
                                </div>
                                <div class="card-body ">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <form action="<?php echo URLROOT.'/usuarioshotspot/agregar'; ?>" method="post">
                                                <div class="form-group d-none">
                                                    <input type="text" class="form-control" name="tokenCSRF" value="<?php echo $_SESSION["tokencsrf"]; ?>">
                                                </div>
                                                <div class="form-group">
                                                    <label for="username" class="form-label"> Nombre de usuario *</label> 
                                                    <input type="text" class="form-control" name="username"  aria-required="true" value="<?php echo $data['fields']['username'];?>">
                                                    <span class="error" for="username"><?php echo $data['fields']['username_err'];?></span>
                                                </div>
    
                                                <div class="form-group">
                                                    <label for="password" class="form-label"> Contraseña *</label> 
                                                    <input type="password" class="form-control" name="password" aria-required="true" value="<?php echo $data['fields']['password'];?>">
                                                    <span class="error"><?php echo $data['fields']['password_err'];?></span>
                                                </div>
    
                                                <div class="form-group">
                                                    <label for="GLAB" class="form-label"> Grupo Limitación Ancho Banda *</label>
                                                    <select class="custom-select custom-select-sm" name="grupoLimiteAnchosBanda">
                                                        <?php $selected = ($data['fields']['grupoLimiteAnchosBanda'] == '') ? 'selected': '';?>
                                                        <option value='' <?php echo $selected; ?> >Elija</option>
                                                        <?php 

                                                            foreach ($data["anchosBanda"] as $item) {
                                                                $selected = ($data['fields']['grupoLimiteAnchosBanda'] == $item["name"]) ? 'selected': '';
                                                                $dash = !empty($item['rate-limit']) ? '--' : ''; //dash es un guion
                                                                echo '<option value="'.$item["name"].'" '.$selected.'>'.$item["name"].$dash.$item["rate-limit"].'</option>';
                                                        }
                                                        ?>
                                                    </select> 
                                                    <span class="error"><?php echo $data['fields']['grupoLimiteAnchosBanda_err'];?></span>
                                                </div>
    
                                                <div class="form-group">
                                                    <label for="información" class="form-label"> Precio *</label>
                                                    <textarea class="form-control" name="informacion" rows="2" aria-required="true"> <?php echo $data['fields']['informacion'];?></textarea>
                                                    <span class="error"><?php echo $data['fields']['informacion_err'];?></span>
                                                </div> 
                                                <button class="btn btn-primary"> <i class="fas fa-save"></i> Guardar usuario</button>
                                            </form>
                                        </div>
                                    </div>
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