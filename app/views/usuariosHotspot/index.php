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
                                    <div class="card-header card-header-success card-header-icon">
                                        <div class="card-icon">
                                            <i class="fa fa-users"></i>
                                        </div>
                                        <h4 class="card-title">Usuarios hotspot</h4>
                                    </div>
                                    
                                    <div class="card-body ">
                                        <div class="material-datatables">
                                            <table id="datatables" class="table table-striped table-no-bordered table-hover" cellspacing="0" width="100%" style="width:100%">
                                                <thead>
                                                    <tr>
                                                    <th>No.</th>
                                                    <th>Usuario</th>
                                                    <th>Contraseña</th>
                                                    <th>Tiempo</th>
                                                    <th>AnchoBandaLG</th>
                                                    <th>Información</th>
                                                    <th>TActividad</th>
                                                    <th class="disabled-sorting text-right">Acciones</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php 
                                                        if(count($data)>0){ //si los datos son mayores a cero
                                                            $contador = 1;
                                                            foreach ($data as $item) {
                                                                echo '<tr>';
                                                                echo '<td>'.$contador .'</td>';
                                                                echo '<td>'.$item["name"].'</td>';
                                                                echo '<td>'.$password = !empty($item['password']) ? $item["password"] : "".'</td>';
                                                                echo '<td>'.$limitUptime = !empty($item['limit-uptime']) ? $item["limit-uptime"] : "".'</td>';
                                                                echo '<td>'.$profile = !empty($item['profile']) ? $item["profile"] : "".'</td>';
                                                                echo '<td>'.$comment = !empty($item['comment']) ? $item["comment"] : "".'</td>';
                                                                echo '<td>'.$item["uptime"].'</td>';
                                                                echo '
                                                                    <td class="text-right">
                                                                        <a href="#" class="btn btn-sm btn-info  "><i class="fas fa-edit"></i></a>
                                                                        <a href="#" class="btn btn-sm btn-danger "><i class="fas fa-trash"></i></a>
                                                                        <a href="#" class="btn btn-sm btn-warning "><i class="fab fa-creative-commons-zero"></i></a>
                                                                    </td>
                                                                ';
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
        <script src="<?php echo URLROOT; ?>/js/usuariosHotspot/index.js"></script> <!-- Contiene el script para aplicar datatables -->
    </body>
</html>