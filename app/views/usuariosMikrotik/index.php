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
                                
                                <a href="<?php echo URLROOT; ?>/usuariosmikrotik/agregar" class="btn btn-info mr-auto" > <i class="fa fa-user"></i> Agregar usuario MK</a> 
                                    
                                <input type="hidden" class="form-control " id="tokenCSRF" value="<?php echo $_SESSION["tokencsrf"]; ?>">
                                
                                <div class="card ">
                                    <div class="card-header card-header-success card-header-icon">
                                        <div class="card-icon">
                                            <i class="fa fa-users"></i>
                                        </div>
                                        <h4 class="card-title">Usuarios del mikrotik</h4>
                                    </div>
                                   
                                    <div class="card-body ">
                                        <div class="material-datatables">
                                            <table id="usersMikrotik" class="table table-striped table-no-bordered table-hover" cellspacing="0" width="100%" style="width:100%">
                                                <thead>
                                                    <tr>
                                                    <th>No.</th>
                                                    <th>Nombre</th>
                                                    <th>Grupo</th>
                                                    <th>Información</th>
                                                    <th class="disabled-sorting text-right">Acciones</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php 
                                                        if(count($data)>0){ //si los datos son mayores a cero
                                                            $contador = 1;
                                                            foreach ($data['users'] as  $item) {
                                                                $id = "'".$item[".id"]."'";// pongo el id entre comillas
                                                                $name = "'".$item["name"]."'";
                                                                echo '<tr>';
                                                                echo '<td>'.$contador .'</td>';
                                                                echo '<td>'.$item["name"].'</td>';
                                                                echo '<td>'.$item["group"] .'</td>';
                                                                echo '<td>'.$password = !empty($item['comment']) ? $item["comment"] : "".'</td>';
                                                                echo '
                                                                    <td class="text-right">
                                                                        <button class="btn btn-sm btn-danger" onclick="deleteUserMikrotik('.$id.','.$name.')"><i class="fas fa-trash"></i></button>
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
        <script src="<?php echo URLROOT; ?>/js/usuariosMikrotik/index.js"></script> <!-- Contiene el script para aplicar datatables -->
    </body>
</html> 