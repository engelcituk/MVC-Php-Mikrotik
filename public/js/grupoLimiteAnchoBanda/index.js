const token = document.getElementById("tokenCSRF").value; //obtengo el token, que está en campo oculto del modal hotspotUserProfile

// para validar campos acepten solo numeros enteros
$(function(){
    $(".validarEntero").keydown(function(event){
        //alert(event.keyCode);
        if((event.keyCode < 48 || event.keyCode > 57) && (event.keyCode < 96 || event.keyCode > 105) && event.keyCode !==190  && event.keyCode !==110 && event.keyCode !==8 && event.keyCode !==9  ){
            return false;
        }
    });
});

let tablaUsers = $('#tablaUsersProfile').DataTable({
    responsive: true,
    //bDestroy: true,
    language: {
    "decimal": "",
    "emptyTable": "No hay información",
    "info": "Mostrando _START_ a _END_ de _TOTAL_ Entradas",
    "infoEmpty": "Mostrando 0 to 0 of 0 Entradas",
    "infoFiltered": "(Filtrado de _MAX_ total entradas)",
    "infoPostFix": "",
    "thousands": ",",
    "lengthMenu": "Mostrar _MENU_ Entradas",
    "loadingRecords": "Cargando...",
    "processing": "Procesando...",
    "search": "Buscar:",
    "zeroRecords": "Sin resultados encontrados"
    },
});

function showHotspotsUserProfile(id) {

    $.ajax({
        url: "grupolimiteanchobanda/getInfoHotspotUserProfile", 
        type: "POST",
        dataType:"json",
        data: {
            idProfile:id,
            tokenCsrf: token
        },
        success: function(respuesta) { //respuesta es un json
            ok = respuesta.ok;
            if(ok){
                userProfile = respuesta.userProfile[0]; //regresa un array, se ocupa el de la posición 1
                //si esos valores no existen, se mandan vacíos
                idUser = userProfile['.id'];
                name = userProfile.name || '';
                sharedUSers = userProfile['shared-users'] || '';
                velocidad = userProfile['rate-limit'] || '';
                //los separo por slash "2048k/2048k" --> regresa un array de 2048k , 2048k
                velocidad = velocidad.split("/"); 
                comment = userProfile.comment || '';
                //se pinta en los campos los valores obtenidos
                document.getElementById("idHotspotUserProfile").value = idUser;
                document.getElementById("name").value = name;
                document.getElementById("sharedUsers").value = sharedUSers;
                 //tomo el primer valor del array {2048k , 2048k} y tomo solo el valor numerico
                document.getElementById("limite").value = velocidad[0].replace(/[^\d]/, '');
                 //tomo el primer valor del array {2048k , 2048k} y tomo solo el string, k o m
                document.getElementById("tipoUnidad").value = velocidad[0].replace(/[0-9]/g, '');//
                $('#hotspotUserProfile').modal('show');//muestro el modal con los datos cargados
                activeButton(); //se llama la funcion para activar/desactivar el botón de actualizar del modal
            }            
        },
        error: function(respuesta) {
            console.log('error')
        }
    })
}

function activeButton() {
    
    name = document.getElementById("name").value ;
    sharedUsers = document.getElementById("sharedUsers").value;
    tipoUnidad = $("#tipoUnidad :selected").val();
    limite = document.getElementById("limite").value;
    
    let disabled = (name == '' || sharedUsers == '' || tipoUnidad == ''  || limite == '' ) ? true : false ;   

    $('#btnSavehotspotUserProfile').prop("disabled", disabled);
}

function updateHotspotUserProfile() {

    id = document.getElementById("idHotspotUserProfile").value ;
    name = document.getElementById("name").value ;
    sharedUsers = document.getElementById("sharedUsers").value;
    limite = document.getElementById("limite").value;
    tipoUnidad = $("#tipoUnidad :selected").val();
    //creo el objeto user con los datos recogidos
    user = { id, name, sharedUsers, limite, tipoUnidad };

    $.ajax({
        url: "grupolimiteanchobanda/updateHotspotUserProfile", 
        type: "POST",
        dataType:"json",
        data: {
            user,
            tokenCsrf: token
        },
        success: function(respuesta) { //respuesta es un json
            ok = respuesta.ok;
            if(ok){
                mensaje= respuesta.mensaje;
                showMessageNotify(mensaje, 'info', 2500); //muestro alerta
                $('#hotspotUserProfile').modal('hide');
                setTimeout(() => {
                    location.reload();
                }, 3000);
            }
                           
        },
        error: function(respuesta) {
            console.log('error')
        }
    })

}

function deleteHotspotsUserProfile(id, name) {
    Swal.fire({
        title: `¿Estás seguro de eliminar a ${name}?`,
        text: "¡No podrás revertir esto!",
        type: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        cancelButtonText: '¡Cancelar!',
        confirmButtonText: 'Sí, borrarlo!'
        }).then((result) => {
        if (result.value) {
            $.ajax({
                url: "grupolimiteanchobanda/deleteHotspotsUserProfile", 
                type: "POST",
                dataType:"json",
                data: {
                    id,
                    tokenCsrf: token
                },
                success: function(respuesta) { //respuesta es un json
                    ok = respuesta.ok;
                    if(ok){
                        mensaje = respuesta.mensaje+': '+name;
                        showMessageNotify(mensaje, 'success', 2000); //muestro alerta
                        setTimeout(() => {
                            location.reload();
                        }, 2500);
                    }              
                },
                error: function(respuesta) {
                    console.log('error')
                }
            })
        }
    })
}

// funcion exclusiva para mostrar mensajes como notificaciones
function showMessageNotify(mensaje, tipo, duracion) {
    $.notify({							
      message: `<i class="fa fa-sun"></i><strong> ${mensaje}</strong>`
      },{								
          type: tipo,
          delay: duracion,
          z_index: 3000,
    });
} 