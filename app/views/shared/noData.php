<?php require APPROOT . '/views/shared/head.php'; ?>
    <body class="">
        <div class="wrapper ">
            <!-- sidebar -->
            <?php require APPROOT.'/views/shared/sidebar.php'; ?> 
            <!-- sidebar -->
            <div class="main-panel">
            <!-- Navbar -->
                <?php require APPROOT.'/views/shared/navbar.php'; ?> 
            <!-- End Navbar -->
            <div class="content">
                <div class="content">
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-md-12">
                             <a href="<?php echo URLROOT; ?>/usuarioshotspot" class="btn btn-warning mr-auto" > <i class="fas fa-arrow-left"></i> Volver</a> 
                                
                                <?php flashMensaje('messageApi'); ?>

                                <div class="card ">
                                    <div class="card-header card-header-danger card-header-icon">
                                        <div class="card-icon">
                                            <i class="fas fa-folder-open"></i>
                                        </div>
                                        <h4 class="card-title">No se recibe informacion a mostrar</h4>

                                        
                                    </div>
                                    <div class="card-body ">
                                       
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- footer -->
            <?php require APPROOT.'/views/shared/footer.php'; ?> 
            <!-- footer -->
            </div>
        </div>
        <?php require APPROOT.'/views/shared/scriptjs.php'; ?> 
        <script src="<?php echo URLROOT; ?>/js/usuariosHotspot/generador.js"></script> <!-- Contiene el script para aplicar validaciones -->
    </body>
</html>