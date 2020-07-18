<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="csrf-token" content="<?php echo estaLogueado() ? $_SESSION['tokencsrf'] : ''; ?>">

    <title><?php echo SITENAME; ?></title>
    <link rel="stylesheet" href="<?php echo URLROOT; ?>/css/style.css">
    <!--     Fonts and icons     -->
    <link rel="stylesheet" type="text/css" href="<?php echo URLROOT; ?>/fontawesome/css/all.css" />
    <!-- CSS Files -->
    <link href="<?php echo URLROOT; ?>/css/material-dashboard.minf066.css" rel="stylesheet" />
</head>
