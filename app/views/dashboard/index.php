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
                        <div class="col-md-9">
                            <div class="card ">
                            <div class="card-header card-header-success card-header-icon">
                                
                                <h4 class="card-title">Pagina de inicio <?php //echo $data['info']; ?> </h4>
                                <!-- <button class="btn btn-primary" onclick="miclick()">click</button> -->
                                <img class="img-fluid" src="<?php echo URLROOT; ?>/img/mikrotik-logo.jpg" height="300px" alt="logo mikrotik"/>
                                
                            </div>
                            <div class="card-body ">
                                <div class="row">
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
        <script src="<?php echo URLROOT; ?>/js/main.js"></script>

    </body>
</html>