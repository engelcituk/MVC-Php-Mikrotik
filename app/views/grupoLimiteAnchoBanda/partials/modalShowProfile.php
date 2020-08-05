
<div class="modal fade" id="hotspotUserProfile" tabindex="-1" role="dialog" aria-labelledby="hotspotUserProfileLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="hotspotUserProfileLabel">Actualizar información del perfil hotspot</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
      <form>
        <div class="card-body ">
            <div class="form-group d-none">
              <input type="text" class="form-control " id="tokenCSRF" value="<?php echo $_SESSION["tokencsrf"]; ?>">
              <input type="text" class="form-control " id="idHotspotUserProfile">
            </div>
            
            <div class="form-group">
              <label for="name" class="form-label"> Nombre del perfil *</label> 
              <input type="text" class="form-control " id="name" required="true" aria-required="true" aria-invalid="false" onkeyup="activeButton()">
              <label id="name-error" class="error" for="name"></label>
            </div>

            <div class="form-group">
               <label for="sharedUsers" class="form-label"> Número de usuarios (Usuario compartido)*</label> 
              <input type="number" min="1" class="form-control validarEntero " id="sharedUsers" required="true" aria-required="true" aria-invalid="false" onkeyup="activeButton()">
              <label id="sharedUsers-error" class="error" for="sharedUsers"></label>
            </div>
            
            <div class="form-group">
               <label for="limite" class="form-label"> Limite de ancho de banda (valores númericos)</label> 
              <input type="number" min="1" class="form-control validarEntero " id="limite" required="true" aria-required="true" aria-invalid="false" onkeyup="activeButton()">
              <label id="limite-error" class="error" for="limite"></label>
            </div> 

            

            <div class="form-group">
              <label for="unidadLimit" class="form-label"> En unidades de </label>
              <select class="custom-select custom-select-sm" name="unidadLimit" id="tipoUnidad" onchange="activeButton()">
                  <option value='' >Elija unidad</option>
                  <option value='k' >Kilobyte</option>
                  <option value='m' >Megabyte</option>
                  
              </select> 
              <label id="unidadLimit-error" class="error" for="unidadLimit"></label>
          </div>
            
                        
          </div>          
      </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-warning mr-auto" data-dismiss="modal"> <i class="fas fa-window-close"></i> Cerrar</button>
        <button type="button" class="btn btn-primary" id="btnSavehotspotUserProfile" onclick="updateHotspotUserProfile()" disabled> <i class="fas fa-save"></i> Guardar cambios</button>
      </div>
    </div>
  </div>
</div>