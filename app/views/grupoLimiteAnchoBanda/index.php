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
                               
                                <a href="<?php echo URLROOT; ?>/grupolimiteanchobanda/generador" class="btn btn-info mr-auto" ><i class="fas fa-wifi"></i> Agregar perfil</a> 
                                    
                                <div class="card ">
                                    <div class="card-header card-header-success card-header-icon">
                                        <div class="card-icon">
                                            <i class="fas fa-wifi"></i>
                                        </div>
                                        <h4 class="card-title">Usuarios Perfil hotspot</h4>    
                                    </div>
                                   
                                    <div class="card-body ">
                                        <div class="material-datatables">
                                            <table id="tablaUsersProfile" class="table table-striped table-no-bordered table-hover" cellspacing="0" width="100%" style="width:100%">
                                                <thead>
                                                    <tr>
                                                        <th>No.</th>
                                                        <th>Nombre</th>
                                                        <th>Núm. usuarios (usuarios compartidos)</th>
                                                        <th>Límite velocidad (Rx/Tx)</th>   
                                                        <th class="disabled-sorting text-right">Acciones</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php 
                                                        if(count( $data['usersProfile'] ) >0){ //si los datos son mayores a cero
                                                            $contador = 1;
                                                            foreach ($data['usersProfile'] as  $item) {
                                                                $id = "'".$item[".id"]."'";// pongo el id entre comillas
                                                                $name = "'".$item["name"]."'";
                                                                echo '<tr>';
                                                                echo '<td>'.$contador .'</td>';
                                                                echo '<td>'.$item["name"] .'</td>';
                                                                echo '<td>'.$item["shared-users"].'</td>';
                                                                echo '<td>'.$rateLimit = !empty($item['rate-limit']) ? $item["rate-limit"] : "".'</td>';
                                                                
                                                                echo '
                                                                    <td class="text-right">
                                                                        <button class="btn btn-sm btn-info" onclick="showHotspotsUserProfile('.$id.')"><i class="fas fa-edit"></i></button>
                                                                        
                                                                        <button class="btn btn-sm btn-danger" onclick="deleteHotspotsUserProfile('.$id.','.$name.')"><i class="fas fa-trash"></i></button>
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
            <!-- modal modalShowUser-->
            <?php require APPROOT .'/views/grupoLimiteAnchoBanda/partials/modalShowProfile.php'; ?> 
            <!-- modal modalShowUser-->
            <!-- footer -->
            <?php require APPROOT . '/views/shared/footer.php'; ?> 
            <!-- footer -->
            </div>
        </div>
        <?php require APPROOT . '/views/shared/scriptjs.php'; ?> 
        <script src="<?php echo URLROOT; ?>/js/grupoLimiteAnchoBanda/index.js"></script> <!-- Contiene el script para aplicar datatables y más-->
    </body>
</html> 