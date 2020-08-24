const token = document.getElementById("tokenCSRF").value; //obtengo el token, que está en campo oculto
const mikrotik = document.getElementById("mikrotik").value; //obtengo el mikrotik, que está en campo oculto
const urlRoot = document.getElementById("urlRoot").value; //obtengo el urlRoot, que está en campo oculto
  

function reboot() {
    Swal.fire({
        title: `¿Estás seguro de reiniciar el equipo ${mikrotik}?`,
        text: "¡Saldrás de la aplicación!",
        type: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        cancelButtonText: '¡Cancelar!',
        confirmButtonText: 'Sí, Reiniciar!'
        }).then((result) => {
        if (result.value) {
            $.ajax({
                url: "reiniciarmikrotik", 
                type: "POST",
                dataType:"json",
                data: {
                    tokenCsrf: token
                },
                success: function(respuesta) { //respuesta es un json
                    ok = respuesta.ok;
                    if(ok){
                        mensaje = respuesta.mensaje;
                        showMessageNotify(mensaje, 'success', 2000); //muestro alerta
                        setTimeout(() => {
                            document.location.href = urlRoot;
                        }, 2500);
                       
                    }              
                },
                error: function(respuesta) {
                    console.log('error')
                }
            })
        }
    });
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