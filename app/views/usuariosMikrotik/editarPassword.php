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
                            <a href="<?php echo URLROOT; ?>/usuariosmikrotik" class="btn btn-warning mr-auto" > <i class="fas fa-arrow-left"></i> Volver</a>
                            
                            <?php flashMensaje('messageApi'); ?>

                            <div class="card ">
                            <div class="card-header card-header-success card-header-icon">
                                <div class="card-icon">
                                <i class="fa fa-lock"></i>
                                </div>
                                <h4 class="card-title">Actualizar contraseña del Mikrotik</h4>
                                
                            </div>
                            <div class="card-body ">
                                <div class="row">
                                    <div class="col-md-6">
                                
                                        <form action="<?php echo URLROOT.'/usuariosmikrotik/editarpassword'; ?>" method="post">
                                        
                                            <div class="form-group d-none">
                                                <input type="text" class="form-control" value="<?php echo $_SESSION["tokencsrf"]; ?>">
                                            </div>
                                            
                                            <div class="form-group">
                                                <label for="oldPassword" class="form-label"> Contraseña anterior</label> 
                                                <input type="password" class="form-control"  aria-required="true" aria-invalid="false" name="oldPassword" value="<?php echo $data['fields']['oldPassword'];?>">
                                                <span class="error" for="oldPassword"><?php echo $data['fields']['oldPassword_err'];?></span>
                                            </div>

                                            <div class="form-group">
                                                <label for="newPassword" class="form-label"> Nueva contraseña  *</label> 
                                                <input type="password" class="form-control"  aria-required="true" aria-invalid="false" name="newPassword" value="<?php echo $data['fields']['newPassword'];?>">
                                                <span class="error" for="newPassword"><?php echo $data['fields']['newPassword_err'];?></span>
                                            </div>
                                            
                                            <button class="btn btn-primary"> <i class="fas fa-save"></i> Guardar </button>

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