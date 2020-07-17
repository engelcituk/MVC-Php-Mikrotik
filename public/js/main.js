//alert('hola desde javascript');

function miclick() {
    /* let idCliente = document.getElementById("idClienteModalEdit").value;
    let nombreCliente = document.getElementById("nombreClienteModalEdit").value;
    let idTvServicio = document.getElementById("televisionsSelectIdEdit").value;
    let referenciaCliente = document.getElementById("referenciaClienteModalEdit").value;
    $.ajaxSetup({
        headers: {
          'X-CSRF-TOKEN': csrf_token
        }
      }); */
     $.ajax({
		url: "dashboard/click", 
        type: "POST",
		dataType:"json",
        data: {
          info:'Esto es una prueba',
        },
        success: function(respuesta) {
            
            console.log(respuesta)
            
        },
        error: function(respuesta) {
            console.log('error')
        }
    }) 
  }