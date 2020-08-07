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
                                        <i class="fa fa-info"></i>
                                        </div>
                                        <h4 class="card-title">Actualizar identidad del Mikrotik</h4>
                                        
                                    </div>
                                    <div class="card-body ">
                                   

                                        <div class="row">
                                            <div class="col-md-6">
                                                <form action="<?php echo URLROOT.'/usuariosmikrotik/editarIdentidad'; ?>" method="post">
                                                    <div class="form-group d-none">
                                                        <input type="text" class="form-control" value="<?php echo $_SESSION["tokencsrf"]; ?>">
                                                    </div>
                                                    
                                                    <div class="form-group">
                                                        <label for="identidad" class="form-label"> Identidad </label> 
                                                        <input type="text" class="form-control"  aria-required="true" aria-invalid="false" name="identidad" value="<?php echo $data['fields']['identidad'];?>">
                                                        <span class="error" for="identidad"><?php echo $data['fields']['identidad_err'];?></span>
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