

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

function saveUserHotspot() {
    id = document.getElementById("idUserHotspot").value ;
    username = document.getElementById("username").value ;
    password = document.getElementById("password").value;
    profile = $("#grupoLimiteAnchosBanda :selected").val();
    comment = document.getElementById("informacion").value;

    //creo el objeto user con los datos recogidos
    user = { id, username, password, profile, comment }
    
    $.ajax({
        url: "usuarioshotspot/saveUserHotspot", 
        type: "POST",
        dataType:"json",
        data: {
            user,
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