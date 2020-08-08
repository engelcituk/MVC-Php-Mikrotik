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
                            
                            <?php flashMensaje('datosTicket'); ?>

                            <div class="card ">
                            <div class="card-header card-header-success card-header-icon">
                                <div class="card-icon">
                                <i class="fa fa-lock"></i>
                                </div>
                                <h4 class="card-title">Algunos datos a mostrar cuando se generan los tickets</h4>
                                
                            </div>
                            <div class="card-body ">
                                <div class="row">
                                    <div class="col-md-6">
                                
                                        <form action="<?php echo URLROOT.'/usuariosmikrotik/datosticket'; ?>" method="post">
                                        
                                            <div class="form-group d-none">
                                                <input type="text" class="form-control" value="<?php echo $_SESSION["tokencsrf"]; ?>">
                                            </div>
                                            
                                            <div class="form-group">
                                                <label for="encabezado" class="form-label"> Encabezado para los tickets (max 25)</label> 
                                                <input type="text" minlength="5" maxlength="25" class="form-control"  aria-required="true" aria-invalid="false" name="encabezado" value="<?php echo $data['fields']['encabezado'];?>">
                                                <span class="error" for="encabezado"><?php echo $data['fields']['encabezado_err'];?></span>
                                            </div>

                                            <div class="form-group">
                                                <label for="pie" class="form-label"> Pie de página para el ticket (max 40)</label> 
                                                <input type="text"  minlength="5" maxlength="40" class="form-control"  aria-required="true" aria-invalid="false" name="pie" value="<?php echo $data['fields']['pie'];?>">
                                                <span class="error" for="pie"><?php echo $data['fields']['pie_err'];?></span>
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

