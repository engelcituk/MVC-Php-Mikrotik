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
                            <a href="<?php echo URLROOT; ?>/grupolimiteanchobanda" class="btn btn-warning mr-auto" > <i class="fas fa-arrow-left"></i> Volver</a>
                            
                            <?php flashMensaje('messageApi'); ?>

                            <div class="card ">
                                <div class="card-header card-header-success card-header-icon">
                                    <div class="card-icon">
                                        <i class="fas fa-user"></i>
                                    </div>
                                    <h4 class="card-title">Agregar grupo límite de ancho de banda Hotspot</h4>
                                </div>
                                <div class="card-body ">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <form action="<?php echo URLROOT.'/grupolimiteanchobanda/generador'; ?>" method="post">
                                                <div class="form-group d-none">
                                                    <input type="text" class="form-control" name="tokenCSRF" value="<?php echo $_SESSION["tokencsrf"]; ?>">
                                                </div>
                                                <div class="form-group">
                                                    <label for="nameGroup" class="form-label"> Nombre del grupo </label> 
                                                    <input type="text" class="form-control" name="nameGroup"  aria-required="true" value="<?php echo $data['fields']['nameGroup'];?>">
                                                    <span class="error" for="nameGroup"><?php echo $data['fields']['nameGroup_err'];?></span>
                                                </div>
    
                                                <div class="form-group">
                                                    <label for="numberSharedUsers" class="form-label"> Número de usuarios (Usuarios compartidos) </label> 
                                                    <input type="number" min="1" class="form-control" name="numberSharedUsers" aria-required="true" value="<?php echo $data['fields']['numberSharedUsers'];?>" placeholder="Mínimo 1">
                                                    <span class="error"><?php echo $data['fields']['numberSharedUsers_err'];?></span>
                                                </div>

                                                <div class="form-group">
                                                    <label for="limit" class="form-label"> Límite de ancho de banda </label> 
                                                    <input type="number" min="128" class="form-control" name="limit" aria-required="true" value="<?php echo $data['fields']['limit'];?>" placeholder="por ejemplo: 128/256/512/1024">
                                                    <span class="error"><?php echo $data['fields']['limit_err'];?></span>
                                                </div>
    
                                                <div class="form-group">
                                                    <label for="unidadLimit" class="form-label"> En unidades de </label>
                                                    <select class="custom-select custom-select-sm" name="unidadLimit">
                                                        <option value='' <?php echo ($data['fields']['unidadLimit'] == '') ? 'selected': ''; ?> >Elija unidad</option>
                                                        <option value='k' <?php echo ($data['fields']['unidadLimit'] == 'k') ? 'selected': '';  ?> >Kilobyte</option>
                                                        <option value='m' <?php echo ($data['fields']['unidadLimit'] == 'm') ? 'selected': '';  ?> >Megabyte</option>
                                                       
                                                    </select> 
                                                    <span class="error"><?php echo $data['fields']['unidadLimit_err'];?></span>
                                                </div>
    
                                                
                                                <button class="btn btn-primary"> <i class="fas fa-save"></i> Guardar</button>
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