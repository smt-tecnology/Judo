/************* Funciones **************/
//Realizar operaciones sobre la base de datos
function actualizarBD(tabla, datos) {
    //Obtengo los datos necesarios para enviar el AJAX
    const $archivo = "db/operaciones/" + tabla + ".php";
    $.ajax({
        url: $archivo,
        type: "POST",
        data: datos,
        dataType: "json",
        processData: false,
        contentType: false,
        async: true,
        cache: false,
        success: function (respuesta) {
            const tipoOperacion = respuesta;
            //Operaciones exitosas
            if(tipoOperacion.respuesta == "sesion_iniciada"){
                notificacionExito("OPERACIÓN EXITOSA", `¡Has iniciado sesión correctamente, ${tipoOperacion.usuario}! Aguarda unos segundos y serás redirigido.`);
                setTimeout(() => {
                    location.href = "index.php";
                }, 5000);
            }
            //Operaciones erroneas
            else if(tipoOperacion.respuesta == "sesion_fallida"){
                notificacionError("HA OCURRIDO UN ERROR", `El nombre de usuario o la contraseña son incorrectos.`);
                setTimeout(() => {
                    location.reload();
                }, 5000);
            }
        },
        error: function (respuesta) {
            mostrarFallaTecnica();
            setTimeout(() => {
                location.reload();
            }, 5000);
        }
    });
}
//Leer los formularios y enviarlos a la base de datos
function leerFormulario(formulario, accion) {
    if(formulario == "administrador"){
        //Obtengo los campos
        const nombreUsuario = $('#username').val();
        const password = $('#password').val();
        //Realizo las validaciones correspondientes
        //Envio los datos hacia la base de datos
        const datos = new FormData();
        datos.append('usuario', nombreUsuario);
        datos.append('password', password);
        datos.append('accion', 'loguear');
        actualizarBD('administrador', datos);
    }
}
//Envíos de mensajes
function mostrarFallaTecnica(){
    Swal.fire({
        type: 'error',
        title: `<p style="font-size: 30px;">¡Error!</p>`,
        html: `<p style="font-size: 15px;">Ha ocurrido una falla técnica. Solicite a un administrador que revise el asunto.</p>`,
        showConfirmButton: false,
        timer: 4500
    });
}
function notificacionExito(titulo, mensaje){
    Swal.fire({
        type: 'success',
        title: `<p style="font-size: 30px;">${titulo}</p>`,
        html: `<p style="font-size: 15px;">${mensaje}</p>`,
        showConfirmButton: false,
        timer: 4500
    });
}
function notificacionError(titulo, mensaje){
    Swal.fire({
        type: 'error',
        title: `<p style="font-size: 30px;">${titulo}</p>`,
        html: `<p style="font-size: 15px;">${mensaje}</p>`,
        showConfirmButton: false,
        timer: 4500
    });
}
/************* Funciones **************/

$(document).ready(function () {
    /************* Login **************/
    //Formulario
    $('#username').val('');
    $('#password').val('');
    let formularioLogin = $('#formulario-login');

    $(formularioLogin).on('submit', function () {
        leerFormulario('administrador', '');
        return false;
    });
    /************* Login **************/
});