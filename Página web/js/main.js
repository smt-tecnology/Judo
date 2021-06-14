/************* Expresiones Regulares **************/
const formulario_cNombre = /^([A-Za-z]|ñ|Ñ|á|Á|é|É|í|Í|ó|Ó|ú|Ú)+( ([A-Za-z]|ñ|Ñ|á|Á|é|É|í|Í|ó|Ó|ú|Ú)+)*$/;
const formulario_cNumero = /^([0-9])+$/;
const formulario_cEmail = /^[a-zA-Z0-9!#$%&'*+/=?^_`{|}~-]+(?:\.[a-zA-Z0-9!#$%&'*+/=?^_`{|}~-]+)*@(?:[a-zA-Z0-9](?:[a-zA-Z0-9-]*[a-zA-Z0-9])?\.)+[a-zA-Z0-9](?:[a-zA-Z0-9-]*[a-zA-Z0-9])?$/;
const formulario_cTelefono = /^(\(([0-9])+\) )([0-9])+$/;
const formulario_cNacimiento = /^([0-9][0-9])\/([0-9][0-9])\/([0-9][0-9][0-9][0-9])$/;
/************* Expresiones Regulares **************/


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
            if(tipoOperacion.respuesta == "inscripcion_realizada"){
                notificacionExito("OPERACIÓN EXITOSA", `¡Te has inscripto correctamente! El administrador del sitio será notificado.`);
            }
            //Operaciones erroneas
            else if(tipoOperacion.respuesta == "usuario_no_registrado"){
                notificacionError("HA OCURRIDO UN ERROR", `Lo sentimos, no te encuentras registrado en nuestro ranking.`);
                setTimeout(() => {
                    location.reload();
                }, 5000);
            }
            else if(tipoOperacion.respuesta == "competidor_fallido"){
                notificacionError("HA OCURRIDO UN ERROR", `La operación ha fracasado, esto puede ocurrir en caso de que ya estes inscripto a este torneo.`);
            }
            else if(tipoOperacion.respuesta == "club_fallido"){
                notificacionError("HA OCURRIDO UN ERROR", `La operación ha fracasado, esto puede ocurrir en caso de que este participante ya este inscripto a este torneo.`);
            }
        },
        error: function (XMLHttpRequest, textStatus, errorThrown) {
            mostrarFallaTecnica();
            console.log(textStatus + ": " + errorThrown);
        }
    });
}
//Enviar correos electrónicos
function enviarMail(datos) {
    $.ajax({
        url: "php/enviar-mails.php",
        type: "POST",
        data: datos,
        dataType: "json",
        processData: false,
        contentType: false,
        async: true,
        cache: false,
        success: function (respuesta) {
            const tipoOperacion = respuesta;
            if(tipoOperacion.email != "inscripcion-torneo"){
                notificacionExito('OPERACIÓN EXITOSA', 'Has realizado correctamente la solicitud y llegará a manos de un administrador en breve');
            }
        },
        error: function (XMLHttpRequest, textStatus, errorThrown) {
            mostrarFallaTecnica();
            console.log(textStatus + ": " + errorThrown);
        }
    });
}
//Leer los formularios y enviarlos a la base de datos
function leerFormulario(formulario, accion) {
    if(formulario == "inscripcion"){
        //Obtengo los valores
        /* Input Text */
        const nombreCompetidor = $('#nombre-competidor');
        const apellidoCompetidor = $('#apellido-competidor');
        const dniCompetidor = $('#dni-competidor');
        const emailCompetidor = $('#email-competidor');
        const telefonoCompetidor = $('#telefono-competidor');
        const nacimientoCompetidor = $('#nacimiento-competidor');
        const federacionCompetidor = $('#federacion-competidor');
        const clubCompetidor = $('#club-competidor');
        const pesoCompetidor = $('#peso-competidor');
        /* Radio Buttons */
        const generoCompetidor = $('#genero-competidor input');
        const categoriaCompetidor = $('#categoria-competidor input');
        /* Image Files */
        const fotoCompetidor = $('#foto-competidor');
        //Realizo las validaciones correspondientes para los campos (Aquellos que no requieran longitud se establecen en '0' y '9999')
        /* Nombre */
        if(!validarCampo(nombreCompetidor, 3, 60, formulario_cNombre)) return false;
        /* Apellido */
        if(!validarCampo(apellidoCompetidor, 3, 60, formulario_cNombre)) return false;
        /* DNI */
        if(!validarCampo(dniCompetidor, 0, 9999, formulario_cNumero)) return false;
        /* Email */
        if(!validarCampo(emailCompetidor, 0, 9999, formulario_cEmail)) return false;
        /* Telefono */
        if(!validarCampo(telefonoCompetidor, 0, 9999, formulario_cTelefono)) return false;
        /* Género */
        if(!validarRadioButton(generoCompetidor)) return false;
        /* Nacimiento */
        if(!validarCampo(nacimientoCompetidor, 0, 9999, formulario_cNacimiento)) return false;
        /* Foto */
        if(!validarFoto(fotoCompetidor)) return false;
        /* Federación */
        if(!validarCampo(federacionCompetidor, 3, 30, formulario_cNombre)) return false;
        /* Club */
        if(!validarCampo(clubCompetidor, 3, 30, formulario_cNombre)) return false;
        /* Peso */
        if(!validarCampo(pesoCompetidor, 0, 9999, formulario_cNumero)) return false;
        /* Categoría */
        if(!validarRadioButton(categoriaCompetidor)) return false;

        //Envio los datos hacia PHP Mailer
        const datos = new FormData();
        datos.append('nombre', nombreCompetidor.val().toUpperCase());
        datos.append('apellido', apellidoCompetidor.val().toUpperCase());
        datos.append('dni', dniCompetidor.val());
        datos.append('email', emailCompetidor.val().toUpperCase());
        datos.append('telefono', telefonoCompetidor.val());
        datos.append('genero', $('#genero-competidor input:checked').val().toUpperCase());
        datos.append('nacimiento', nacimientoCompetidor.val());
        datos.append('foto', fotoCompetidor.prop("files")[0]);
        datos.append('federacion', federacionCompetidor.val().toUpperCase());
        datos.append('club', clubCompetidor.val().toUpperCase());
        datos.append('peso', pesoCompetidor.val().toUpperCase());
        datos.append('categoria', $('#categoria-competidor input:checked').val().toUpperCase());
        datos.append('tipoMail', 'solicitar-inscripcion');
        enviarMail(datos);
    }
    else if(formulario == "inscripcion-torneo-competidor"){
        //Obtengo los valores
        /* Input Text */
        const dniCompetidor = $('#dni-competidor');
        const nombreCompetidor = $('#nombre-competidor');
        const apellidoCompetidor = $('#apellido-competidor');
        const clubCompetidor = $('#club-competidor');
        const pesoCompetidor = $('#peso-competidor');
        /* Radio Buttons */
        const categoriaCompetidor = $('#categoria-competidor input');
        /* Input hidden */
        const idTorneo = $('#id-torneo').val();
        const nombreTorneo = $('#nombre-torneo').val();
        //Realizo las validaciones correspondientes para los campos (Aquellos que no requieran longitud se establecen en '0' y '9999')
        /* DNI */
        if(dniCompetidor.val().length){
            if(!validarCampo(dniCompetidor, 0, 9999, formulario_cNumero)) return false;
            //Envio los datos hacia PHP Mailer
            const datos = new FormData();
            datos.append('dni', dniCompetidor.val());
            datos.append('tipo-inscripcion', 'competidor-registrado');
            datos.append('torneo', idTorneo);
            datos.append('accion', accion);
            actualizarBD('torneos', datos);
            datos.append('nombre-torneo', nombreTorneo);
            datos.append('tipoMail', 'inscripcion-competidor');
            enviarMail(datos);
        }
        else{
            /* Nombre */
            if(!validarCampo(nombreCompetidor, 3, 60, formulario_cNombre)) return false;
            /* Apellido */
            if(!validarCampo(apellidoCompetidor, 3, 60, formulario_cNombre)) return false;
            /* Club */
            if(!validarCampo(clubCompetidor, 3, 30, formulario_cNombre)) return false;
            /* Peso */
            if(!validarCampo(pesoCompetidor, 0, 9999, formulario_cNumero)) return false;
            /* Categoría */
            if(!validarRadioButton(categoriaCompetidor)) return false;

            //Envio los datos hacia la base de datos
            const datos = new FormData();
            datos.append('nombre', nombreCompetidor.val().toUpperCase());
            datos.append('apellido', apellidoCompetidor.val().toUpperCase());
            datos.append('club', clubCompetidor.val().toUpperCase());
            datos.append('peso', pesoCompetidor.val().toUpperCase());
            datos.append('categoria', $('#categoria-competidor input:checked').val().toUpperCase());
            datos.append('tipo-inscripcion', 'competidor-no-registrado');
            datos.append('torneo', idTorneo);
            datos.append('accion', accion);
            actualizarBD('torneos', datos);
            datos.append('nombre-torneo', nombreTorneo);
            datos.append('tipoMail', 'inscripcion-competidor');
            enviarMail(datos);
        }
    }
    else if(formulario == "inscripcion-torneo-club"){
        //Obtengo los valores
        /* Input Text */
        const nombreClub = $('#nombre-club');
        const emailClub = $('#email-club');
        const telefonoClub = $('#telefono-club');

        const nombreCompetidor = $('#nombre-competidor');
        const apellidoCompetidor = $('#apellido-competidor');
        const pesoCompetidor = $('#peso-competidor');
        /* Radio Buttons */
        const categoriaCompetidor = $('#categoria-competidor input');
        /* Input hidden */
        const idTorneo = $('#id-torneo').val();
        const nombreTorneo = $('#nombre-torneo').val();
        //Realizo las validaciones correspondientes para los campos (Aquellos que no requieran longitud se establecen en '0' y '9999')
        /* Nombre */
        if(!validarCampo(nombreClub, 3, 60, formulario_cNombre)) return false;
        /* Email */
        if(!validarCampo(emailClub, 0, 9999, formulario_cEmail)) return false;
        /* Telefono */
        if(!validarCampo(telefonoClub, 0, 9999, formulario_cTelefono)) return false;

        /* Nombre */
        if(!validarCampo(nombreCompetidor, 3, 60, formulario_cNombre)) return false;
        /* Apellido */
        if(!validarCampo(apellidoCompetidor, 3, 60, formulario_cNombre)) return false;
        /* Peso */
        if(!validarCampo(pesoCompetidor, 0, 9999, formulario_cNumero)) return false;
        /* Categoría */
        if(!validarRadioButton(categoriaCompetidor)) return false;

        //Envio los datos hacia PHP Mailer
        const datos = new FormData();
        datos.append('nombre-club', nombreClub.val().toUpperCase());
        datos.append('email-club', emailClub.val().toUpperCase());
        datos.append('telefono-club', telefonoClub.val());
        datos.append('nombre', nombreCompetidor.val().toUpperCase());
        datos.append('apellido', apellidoCompetidor.val().toUpperCase());
        datos.append('peso', pesoCompetidor.val().toUpperCase());
        datos.append('categoria', $('#categoria-competidor input:checked').val().toUpperCase());
        datos.append('tipo-inscripcion', 'club');
        datos.append('torneo', idTorneo);
        datos.append('accion', accion);
        actualizarBD('torneos', datos);
        datos.append('nombre-torneo', nombreTorneo);
        datos.append('tipoMail', 'inscripcion-club');
        enviarMail(datos);
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
//Validación de formularios
function validarCampo(campo, lMinima, lMaxima, formato) {
    if(validarCampoObligadorio(campo) && validarLongitudCampo(campo, lMinima, lMaxima) && validarFormatoCampo(campo, formato)){
        return true;    
    }
    notificacionError('¡ERROR!', 'El último campo de texto que se ha puesto en rojo no cumple con los requisitos especificados, por favor, corríjalo');
    return false;
}
function validarCampoObligadorio(campo) {
    if(campo.val().length > 0){
        $(campo).css('border', 'solid .2rem #009975');
        return true
    }
    $(campo).css('border', 'solid .2rem var(--colorRojo)');
    return false;
}
function validarLongitudCampo(campo, lMinima, lMaxima) {
    if((campo.val().length >= lMinima) && (campo.val().length <= lMaxima)){
        $(campo).css('border', 'solid .2rem #009975');
        return true;
    }
    $(campo).css('border', 'solid .2rem var(--colorRojo)');
    return false;
}
function validarFormatoCampo(campo, formato) {
    if(formato == "libre" || formato.test(campo.val())){
        $(campo).css('border', 'solid .2rem #009975');
        return true;
    }
    $(campo).css('border', 'solid .2rem var(--colorRojo)');
    return false;
}
function validarRadioButton(radioButton) {
    if(!radioButton.is(':checked')) {
        let campoError = radioButton.parent().parent().parent()[0];
            campoError = $(campoError).attr('value');
        notificacionError('¡ERROR!', 'Debes seleccionar una opción en el campo ' + campoError);
        return false;
    }
    return true;
}
function validarCheckboxButton(checkboxButton) {
    let contador = 0;
    let campoError = checkboxButton.parent().parent().parent()[0];
        campoError = $(campoError).attr('value');
    $(checkboxButton).each(function (index, element) {
        if($(this).is(':checked')){
            contador++;
        }
    });
    if(contador > 0) return true;
    notificacionError('¡ERROR!', 'Debes seleccionar una opción en el campo ' + campoError);
    return false;
}
function validarFoto(archivo) {
    if(!archivo[0].files.length){
        notificacionError('¡ERROR!', 'No has subido una foto de forma correcta, verifica que el nombre del archivo figure en el campo foto para asegurarte de que se subió correctamente');
        return false;
    }
    return true;
}
/************* Funciones **************/


/************* Códigos Adicionales/Plugins **************/
jQuery('#foto-competidor').change(function(){
    let archivoSubido = this["files"][0];
    if((archivoSubido['size'] > 10000000)){
        var idname = jQuery(this).attr('id');
        jQuery('div.'+idname).next().find('div').html("ARCHIVO PESADO. MAX: 10MB");
        this.value = '';
    }
    else if((archivoSubido['type'] != 'image/png') && (archivoSubido['type'] != 'image/jpg') && (archivoSubido['type'] != 'image/jpeg')){
        var idname = jQuery(this).attr('id');
        jQuery('div.'+idname).next().find('div').html("TIPO DE ARCHIVO NO SOPORTADO");
        this.value = '';
    }
    else{
        var filename = jQuery(this).val().split('\\').pop();
        var idname = jQuery(this).attr('id');
        jQuery('div.'+idname).next().find('div').html(filename);
    }
});
$('#nacimiento-competidor').on('input', function () {
    let valorActual = $(this).val();
    let longitud = valorActual.length;
    //Ingreso los elementos y evito que se ingresen mas caracteres de lo deseado
    if(valorActual.includes('Z') || valorActual.includes('z')) $(this).val('');
    else if(longitud == 2 || longitud == 5) $(this).val(valorActual + '/');
    else if(longitud == 11) $(this).val(valorActual.slice(0,-1));
});
/************* Códigos Adicionales/Plugins **************/


$(document).ready(function () {
    /************* Nabvar Responsive **************/
    let contadorNavbar = 0;
    $('.menuicono').click(function() {
        if(contadorNavbar == 0) {
            $('.listanavmobile').slideDown(1000);
            $('.listanavmobile').toggleClass('opening');
            contadorNavbar++;
        }
        else{
            $('.listanavmobile').slideUp(1000);
            $('.listanavmobile').toggleClass('opening');
            contadorNavbar = 0;
        }
    });
    /************* Nabvar Responsive **************/


    /************* Inscripciones **************/
    //Formulario
    let formularioInscripcion = $('#enviar-inscripcion');
    if(formularioInscripcion.length){
        $('#nombre-competidor').val('');
        $('#apellido-competidor').val('');
        $('#dni-competidor').val('');
        $('#email-competidor').val('');
        $('#telefono-competidor').val('');
        $('#nacimiento-competidor').val('');
        $('#federacion-competidor').val('');
        $('#club-competidor').val('');
        $('#peso-competidor').val('');

        $(formularioInscripcion).on('submit', function () {
            leerFormulario('inscripcion', 'solicitar');
            return false;
        });
    }
    /************* Inscripciones **************/


    /************* Inscripciones a Torneos **************/
    //Formulario
    let inscripcionCompetidorTorneo = $('#inscribir-torneo-competidor');
    if(inscripcionCompetidorTorneo.length){
        $('#nombre-competidor').val('');
        $('#apellido-competidor').val('');
        $('#dni-competidor').val('');
        $('#club-competidor').val('');
        $('#peso-competidor').val('');

        $(inscripcionCompetidorTorneo).on('submit', function () {
            leerFormulario('inscripcion-torneo-competidor', 'inscribir-torneo');
            return false;
        });
    }

    let inscripcionClubTorneo = $('#inscribir-torneo-club');
    if(inscripcionClubTorneo.length){
        $('#nombre-club').val('');
        $('#email-club').val('');
        $('#telefono-club').val('');

        $('#nombre-competidor').val('');
        $('#apellido-competidor').val('');
        $('#peso-competidor').val('');

        $(inscripcionClubTorneo).on('submit', function () {
            leerFormulario('inscripcion-torneo-club', 'inscribir-torneo');
            return false;
        });
    }
    /************* Inscripciones a Torneos **************/


    /************* Ranking **************/
    //Funcionalidad de tabla de pesos
    let botonPesosM = $('#pesos td:nth-child(1)');
    $(botonPesosM).on('click', function () {
        //Obtengo el peso anterior
        const positionInTable = $($(this).parent()).attr('data-position');
        let pesoAnterior = $(`#pesos tr:nth-child(${positionInTable - 1}) td:nth-child(1)`).html();
            pesoAnterior = parseInt(pesoAnterior) * -1;
        //Obtengo el simbolo y el peso que se mostrará
        let peso = $(this).html();
        let signo = null;
        if(peso.includes('-')){
            signo = "negativo";
            peso = parseInt(peso) * -1;
        }
        else {
            signo = "positivo";
            peso = peso = parseInt(peso);
        }
        //Obtengo el genero seleccionado
        let genero = "MASCULINO";
        //Obtengo la tabla a modificar
        let competidoresRanking = $('#ranking tbody tr');
        //Oculto los elementos que no se utilizen
        let elementosQueCumplen = 0;
        for(let i=0; i<competidoresRanking.length; i++){
            let competidor = competidoresRanking[i];
            let generoActual = $(competidor).attr('genero');
            let pesoActual = $(competidor).attr('peso');

            if((generoActual != genero) || (signo == "positivo" && peso > pesoActual) || (signo == "negativo" && ((pesoAnterior >= pesoActual) || (peso < pesoActual)))){
                $(competidor).hide();
                $(competidor).removeClass('disponible');
            }
            else{
                $(competidor).show();
                $(competidor).addClass('disponible');
                elementosQueCumplen++;
                let posicionActual = $(competidor).find('.posicion');
                $(posicionActual).html(elementosQueCumplen);
            }
        }
        //Seteo las clases de la tabla de pesos
        $(botonPesosM).removeClass('active');
        $(botonPesosF).removeClass('active');
        $(this).addClass('active');
    });

    let botonPesosF = $('#pesos td:nth-child(2)');
    $(botonPesosF).on('click', function () {
        //Obtengo el peso anterior
        const positionInTable = $($(this).parent()).attr('data-position');
        let pesoAnterior = $(`#pesos tr:nth-child(${positionInTable - 1}) td:nth-child(1)`).html();
            pesoAnterior = parseInt(pesoAnterior) * -1;
        //Obtengo el simbolo y el peso que se mostrará
        let peso = $(this).html();
        let signo = null;
        if(peso.includes('-')){
            signo = "negativo";
            peso = parseInt(peso) * -1;
        }
        else {
            signo = "positivo";
            peso = peso = parseInt(peso);
        }
        //Obtengo el genero seleccionado
        let genero = "FEMENINO";
        //Obtengo la tabla a modificar
        let competidoresRanking = $('#ranking tbody tr');
        //Oculto los elementos que no se utilizen
        let elementosQueCumplen = 0;
        for(let i=0; i<competidoresRanking.length; i++){
            let competidor = competidoresRanking[i];
            let generoActual = $(competidor).attr('genero');
            let pesoActual = $(competidor).attr('peso');

            if((generoActual != genero) || (signo == "positivo" && peso > pesoActual) || (signo == "negativo" && ((pesoAnterior >= pesoActual) || (peso < pesoActual)))){
                $(competidor).hide();
                $(competidor).removeClass('disponible');
            }
            else{
                $(competidor).show();
                $(competidor).addClass('disponible');
                elementosQueCumplen++;
                let posicionActual = $(competidor).find('.posicion');
                $(posicionActual).html(elementosQueCumplen);
            }
        }
        //Seteo las clases de la tabla de pesos
        $(botonPesosM).removeClass('active');
        $(botonPesosF).removeClass('active');
        $(this).addClass('active');
    });

    //Funcionalidad de ordenado de tabla
    $.tablesorter.addWidget({
        // give the widget a id
        id: "puestoCompetidor",
        // format is called when the on init and when a sorting has finished
        format: function(table) {               
            // loop all tr elements and set the value for the first column  
            for(var i=0; i < table.tBodies[0].rows.length; i++) {
                $("tbody tr:eq(" + i + ") td:first",table).html(i+1);
            }                                   
        }
    });

    const tablaRanking = $('#ranking');
    const tipoRanking = $(tablaRanking).attr('ranking');
    if(tipoRanking == "competidor"){
        $('#ranking').tablesorter({
            widgets: ['puestoCompetidor'],
            headers: { 
                0: { sorter: false},
                1: { sorter: false},
                2: { sorter: false},
                3: { sorter: false},
                4: { sorter: false}
            },
            sortList: [[4,1]]
        });
    }
    else if(tipoRanking == "club" || tipoRanking == "federacion"){
        $('#ranking').tablesorter({
            widgets: ['puestoCompetidor'],
            headers: { 
                0: { sorter: false},
                1: { sorter: false},
                2: { sorter: false}
            },
            sortList: [[2,1]]
        });
    }

    //Buscador de competidores
    const buscadorCompetidor = $('#buscador-competidor');
    $(buscadorCompetidor).on('input', function (e) {
        const expresion = new RegExp(e.target.value, "i"),
              registros = document.querySelectorAll("#ranking tbody tr.disponible");
        for(let i=0; i<registros.length; i++){
            registros[i].style.display = "none";
            if(registros[i].childNodes[3].textContent.replace(/\s/g, " ").search(expresion) != -1){
                registros[i].style.display = "table-row";
            }
        }
    });

    //Modal de competidores
    const competidor = $('#ranking tbody tr');
    $(competidor).on('click', function () {
        let dniUsuario = $(this).attr('dni');
        console.log(dniUsuario);
        $(`#modal-puntos-${dniUsuario}`).modal('toggle');
    });
    /************* Ranking **************/
});