<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"      "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
 <html xmlns="http://www.w3.org/1999/xhtml"> 

 <head> <meta charset="utf-8"> 
     <title>Vouchers</title> 
    <link rel="icon" type="image/png" href="<?php echo URLROOT; ?>/img/favicon.png">
     
 	<style> @media print {   .noprint { 
 	                                      display: none;  
 	                                    }  
 	                         .pagebreak {  page-break-after: always;  
 	                                   }
 	                      }
    </style> 
</head> 
    <body> 
        <input type="hidden" id="encabezado" value="<?php echo ENCABEZADO;?>">
        <input type="hidden" id="pie" value="<?php  echo PIE;?>">
        
        <div id="vouchers">

        </div>
        <script src="<?php echo URLROOT; ?>/js/jquery.min.js"></script>
        <script src="<?php echo URLROOT; ?>/js/usuariosHotspot/verVouchers.js"></script> <!-- Contiene el script para aplicar datatables -->    
    </body>
</html>
<p class="noprint" style="font-size: 10px">
    <a href="<?php echo URLROOT; ?>/usuarioshotspot" class="btn btn-warning mr-auto" > <i class="fas fa-arrow-left"></i> Volver</a>
</p>
<p class="pagebreak">&nbsp;</p>