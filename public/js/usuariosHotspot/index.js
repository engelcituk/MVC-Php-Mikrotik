

$(document).ready(function(){
    $('#datatables').dataTable({
        responsive: true,
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
});

const token = document.getElementById("tokenCSRF").value; //obtengo el token, que está en campo oculto del modal showUserHotspot

function showUserHotspot(id) {

    $.ajax({
        url: "usuarioshotspot/getInfoUserHotspot", 
        type: "POST",
        dataType:"json",
        data: {
            idUser:id,
            tokenCsrf: token
        },
        success: function(respuesta) { //respuesta es un json
            ok = respuesta.ok;
            if(ok){
                usuario = respuesta.user[0]; //regresa un array, se ocupa el de la posición 1
                //si esos valores no existen, se mandan vacíos
                idUser = usuario['.id'];
                name = usuario.name || '';
                password = usuario.password || '';
                profile = usuario.profile || '';
                comment = usuario.comment || '';
                //se pinta en los campos los valores obtenidos
                document.getElementById("idUserHotspot").value = idUser;
                document.getElementById("username").value = name;
                document.getElementById("password").value = password;
                document.getElementById("grupoLimiteAnchosBanda").value = profile;
                document.getElementById("informacion").value = comment;
                $('#showUserHotspot').modal('show');//muestro el modal con los datos cargados
            }            
        },
        error: function(respuesta) {
            console.log('error')
        }
    })
}
function activeButton() {
    id = document.getElementById("idUserHotspot").value ;
    username = document.getElementById("username").value ;
    password = document.getElementById("password").value;
    profile = $("#grupoLimiteAnchosBanda :selected").val();
    comment = document.getElementById("informacion").value;
    
    let disabled = (username == '' || password == '' || profile == ''  || comment == '' ) ? true : false ;   

    $('#btnSaveUserHotspot').prop("disabled", disabled);
}
function saveUserHotspot() {
    id = document.getElementById("idUserHotspot").value ;
    username = document.getElementById("username").value ;
    password = document.getElementById("password").value;
    profile = $("#grupoLimiteAnchosBanda :selected").val();
    comment = document.getElementById("informacion").value;
    //creo el objeto user con los datos recogidos
    user = { id, username, password, profile, comment };

    let disabled = (username == '' || password == '' || profile == ''  || comment == '' ) ? true : false ;

    
    $.ajax({
        url: "usuarioshotspot/saveUserHotspot", 
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
                $('#showUserHotspot').modal('hide');
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

function deleteUserHotspot(id, username) {
    Swal.fire({
        title: `¿Estás seguro de eliminar al usuario  ${username}?`,
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
                url: "usuarioshotspot/deleteUserHotspot", 
                type: "POST",
                dataType:"json",
                data: {
                    id,
                    tokenCsrf: token
                },
                success: function(respuesta) { //respuesta es un json
                    ok = respuesta.ok;
                    if(ok){
                        mensaje = respuesta.mensaje+': '+username;
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

function resetCounterUserHotspot(id, username) {
    Swal.fire({
        title: `Reiniciar el contador del usuario ${username}?`,
        text: "¡Si elimina el contador, el usuario puede iniciar sesión nuevamente si el límite de tiempo se ha agotado!",
        type: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        cancelButtonText: '¡Cancelar!',
        confirmButtonText: 'Sí, borrarlo!'
        }).then((result) => {
        if (result.value) {
            $.ajax({
                url: "usuarioshotspot/resetCounterUserHotspot", 
                type: "POST",
                dataType:"json",
                data: {
                    id,
                    tokenCsrf: token
                },
                success: function(respuesta) { //respuesta es un json
                    console.log(respuesta);               
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