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
                            <div class="card ">
                            <div class="card-header card-header-danger card-header-icon">
                                <div class="card-icon">
                                    <i class="fas fa-power-off"></i>
                                </div>
                                <h4 class="card-title">Reiniciar el equipo</h4>
                            </div>
                            <div class="card-body ">
                                <div class="row">
                                <input type="hidden" class="form-control " id="tokenCSRF" value="<?php echo $_SESSION["tokencsrf"]; ?>">
                                <input type="hidden" class="form-control " id="mikrotik" value="<?php echo $_SESSION['usuario']; ?>">
                                <input type="hidden" class="form-control " id="urlRoot" value="<?php echo URLROOT; ?>">

                                    
                                    <button class="btn btn-danger mt-5 btn-block" onclick="reboot()"> <i class="fas fa-power-off"></i> Reiniciar YA</button>
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
        <script src="<?php echo URLROOT; ?>/js/usuariosMikrotik/reiniciarMikrotik.js"></script> <!-- Contiene el script para aplicar datatables -->

    </body>
</html>