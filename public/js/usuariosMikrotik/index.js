const token = document.getElementById("tokenCSRF").value; //obtengo el token, que está en campo oculto del modal showUserHotspot

let usersMikrotik = $('#usersMikrotik').DataTable({
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

function deleteUserMikrotik(id, username) {
    Swal.fire({
        title: `¿Estás seguro de eliminar a  ${username}?`,
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
                url: "usuariosmikrotik/deleteUserMikrotik", 
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