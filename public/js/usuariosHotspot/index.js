const token = document.getElementById("tokenCSRF").value; //obtengo el token, que está en campo oculto del modal showUserHotspot


let tablaUsers = $('#tablaUsers').DataTable({
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

    //para marcar como seleccionado una fila
    $('#tablaUsers tbody').on('click', 'tr', function () {
        $(this).toggleClass('selected');
    });

//tablaUsers.rows({search: 'applied'}).select();
//para seleccionar todos los rows del datatable
$(".selectAll").on( "click", function(e) {
    if ($(this).is( ":checked" )) {
        tablaUsers.rows().select();        
    } else {
        tablaUsers.rows().deselect(); 
    }
});

function verTickets() {

    let users = $.map(tablaUsers.rows('.selected').data(), function (item) {
        return {'name':item[2], 'password':item[3], 'limitUptime':item[4],'profile':item[5],'comment':item[6]};
    });

    if(users.length > 0){
        localStorage.setItem('listaTicketsMK',JSON.stringify(users));        
        window.location.href = 'usuarioshotspot/vervouchers'; // redirijo        
    } else {
        users = [];
        localStorage.setItem('listaTicketsMK',JSON.stringify(users));
        showMessageNotify('Debes seleccionar un elemento de la tabla primero', 'danger', 2000); //muestro alerta

    }       
}


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
                activeButton(); //se llama la funcion para activar/desactivar el botón de actualizar del modal

            }            
        },
        error: function(respuesta) {
            console.log('error')
        }
    })
}

function activeButton() {
    username = document.getElementById("username").value ;
    password = document.getElementById("password").value;
    profile = $("#grupoLimiteAnchosBanda :selected").val();
    comment = document.getElementById("informacion").value;
    
    let disabled = (username == '' || password == '' || profile == ''  || comment == '' ) ? true : false ;   

    $('#btnSaveUserHotspot').prop("disabled", disabled);
}

function updateUserHotspot() {
    id = document.getElementById("idUserHotspot").value ;
    username = document.getElementById("username").value ;
    password = document.getElementById("password").value;
    profile = $("#grupoLimiteAnchosBanda :selected").val();
    comment = document.getElementById("informacion").value;
    //creo el objeto user con los datos recogidos
    user = { id, username, password, profile, comment };

    $.ajax({
        url: "usuarioshotspot/updateUserHotspot", 
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
        confirmButtonText: 'Sí, resetear!'
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