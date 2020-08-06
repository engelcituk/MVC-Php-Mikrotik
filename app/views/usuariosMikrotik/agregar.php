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
                                <i class="fa fa-user"></i>
                                </div>
                                <h4 class="card-title">Agregar usuario mikrotik</h4>
                            </div>
                            <div class="card-body ">
                                <div class="row">
                                    <div class="col-md-6">
                                        <form action="<?php echo URLROOT.'/usuariosmikrotik/agregar'; ?>" method="post">
                                        
                                            <div class="form-group d-none">
                                                <input type="text" class="form-control" value="<?php echo $_SESSION["tokencsrf"]; ?>">
                                            </div>
                                            
                                            <div class="form-group">
                                                <label for="name" class="form-label"> Nombre de usuario *</label> 
                                                <input type="text" class="form-control"  aria-required="true" aria-invalid="false" name="name" value="<?php echo $data['fields']['name'];?>">
                                                <span class="error" for="name"><?php echo $data['fields']['name_err'];?></span>
                                            </div>

                                            <div class="form-group">
                                                <label for="groupUser" class="form-label"> Grupo </label>
                                                <select class="custom-select custom-select-sm" name="groupUser">
                                                <?php $selected = ($data['fields']['groupUser'] == '') ? 'selected': '';?>
                                                    <option value='' <?php echo $selected; ?> >Elija grupo</option>
                                                    <?php 
                                                        foreach ($data["groupUsers"] as $item) {
                                                            $selected = ($data['fields']['groupUser'] == $item["name"]) ? 'selected': '';
                                                            echo '<option value="'.$item["name"].'" '.$selected.'>'.$item["name"].'</option>';
                                                        }
                                                    ?>
                                                </select> 
                                                <span class="error" for="groupUser"><?php echo $data['fields']['groupUser_err'];?></span>
                                            </div>


                                            <div class="form-group">
                                                <label for="password" class="form-label"> Contraseña</label> 
                                                <input type="password" class="form-control" aria-required="true" name="password" aria-invalid="false" value="<?php echo $data['fields']['password'];?>">
                                                <span class="error" for="password"><?php echo $data['fields']['password_err'];?></span>
                                            </div>
                                            
                                            <div class="form-group">
                                                <label for="informacion" class="form-label"> Información *</label>
                                                <textarea class="form-control" name="informacion" rows="2" aria-required="true" aria-invalid="false" > <?php echo $data['fields']['informacion'];?></textarea>
                                                <span class="error"><?php echo $data['fields']['informacion_err'];?></span>

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