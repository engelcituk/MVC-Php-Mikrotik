
<div class="modal fade" id="showUserHotspot" tabindex="-1" role="dialog" aria-labelledby="showUserHotspotLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="showUserHotspotLabel">Actualizar información del usuario hotspot</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
      <form>
        <div class="card-body ">
            <div class="form-group d-none">
              <input type="text" class="form-control " id="tokenCSRF" value="<?php echo $_SESSION["tokencsrf"]; ?>">
              <input type="text" class="form-control " id="idUserHotspot">
            </div>
            
            <div class="form-group">
              <label for="username" class="form-label"> Nombre de usuario *</label> 
              <input type="text" class="form-control " id="username" required="true" aria-required="true" aria-invalid="false" onkeyup="activeButton()">
              <label id="username-error" class="error" for="username"></label>
            </div>
            <div class="form-group">
               <label for="password" class="form-label"> Contraseña *</label> 
              <input type="Contraseña" class="form-control " id="password" required="true" aria-required="true" aria-invalid="false" onkeyup="activeButton()">
              <label id="password-error" class="error" for="password"></label>
            </div> 

            <div class="form-group">
              <label for="GLAB" class="form-label"> Perfiles*</label>
              <select class="custom-select custom-select-sm" id="grupoLimiteAnchosBanda" onchange="activeButton()">
                <option value=''>Elija</option>
                <?php 
                  foreach ($data["anchosBanda"] as $item) {
                    $dash = !empty($item['rate-limit']) ? '--' : ''; //dash es un guion
                    echo '<option value="'.$item["name"].'">'.$item["name"].$dash.$item["rate-limit"].'</option>';
                  }
                ?>
              </select> 
            </div> 

            <div class="form-group">
              <label for="información" class="form-label"> Información *</label>
              <textarea class="form-control" id="informacion" rows="2" onkeyup="activeButton()" required="true" aria-required="true" aria-invalid="false" ></textarea>
            </div> 
                        
          </div>          
      </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-warning mr-auto" data-dismiss="modal"> <i class="fas fa-window-close"></i> Cerrar</button>
        <button type="button" class="btn btn-primary" id="btnSaveUserHotspot" onclick="updateUserHotspot()" disabled> <i class="fas fa-save"></i> Guardar cambios</button>
      </div>
    </div>
  </div>
</div>