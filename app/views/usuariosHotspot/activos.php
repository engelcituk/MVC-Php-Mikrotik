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
                                            <i class="fa fa-users"></i>
                                        </div>
                                        <h4 class="card-title">Usuarios hotspot en activo</h4>
                                    </div>
                                   
                                    <div class="card-body ">
                                        <div class="material-datatables">
                                            <table id="tablaUsersActive" class="table table-striped table-no-bordered table-hover" cellspacing="0" width="100%" style="width:100%">
                                                <thead>
                                                    <tr>
                                                        <th>No.</th>
                                                        <th>Usuario</th>
                                                        <th>Dirección</th>
                                                        <th>Tiempo Límite</th>
                                                        <th>Dirección Mac</th>
                                                        <th>T en uso</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php 
                                                        if(count($data)>0){ //si los datos son mayores a cero
                                                            $contador = 1;
                                                            foreach ($data['users'] as  $item) {
                                                                
                                                                echo '<tr>';
                                                                    echo '<td>'.$contador .'</td>';
                                                                    echo '<td>'.$item["user"].'</td>';
                                                                    echo '<td>'.$item["address"].'</td>';
                                                                    echo '<td>'.$item["uptime"].'</td>';
                                                                    echo '<td>'.$item["mac-address"].'</td>';
                                                                    echo '<td>'.$item["login-by"].'</td>';

                                                                echo '</tr>';
                                                                $contador++;
                                                            }
                                                        }
                                                    ?>
                                                    
                                                </tbody>
                                            </table>
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
        <script src="<?php echo URLROOT; ?>/js/usuariosHotspot/activos.js"></script> <!-- Contiene el script para aplicar datatables -->
    </body>
</html> 