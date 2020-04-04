<!DOCTYPE html>
<html lang="en">

    <?php include 'templates/head.php' ?>

    <body>
        <!-- HEADER -->
        <?php include 'templates/header.php' ?>
        <!-- INSCRIPCIÓN -->
        <section class="inscripcion">
            <!-- DESCRIPCIÓN -->
            <div class="descripcion">
                <h2 class="titulo-body">Inscripciones</h2>
                <p class="container text-center">
                    Deberas rellenar los siguientes campos para poder 
                    enviar una solicitud a los administradores del sitio, quienes 
                    validarán la información que has ingresado y determinarán si 
                    serás agregado al sitio.
                </p>

                <br>
            </div>

            <hr>
            <!-- FORMULARIO -->
            <div id="formulario-inscripcion">
                <form id="enviar-inscripcion" class="container text-center" action="#">
                    <h3 class="text-left">INFORMACIÓN PERSONAL</h3>
                    <!-- Nombre -->
                    <div class="nombre">
                        <input id="nombre-competidor" class="text-white text-center with-error" type="text" placeholder="NOMBRE">
                        <small>
                            El campo debe contener entre 3 y 60 caracteres <br>
                            No deben incluirse caracteres especiales o números
                        </small>
                    </div>
                    <!-- Apellido -->
                    <div class="apellido">
                        <input id="apellido-competidor" class="text-white text-center with-error" type="text" placeholder="APELLIDO">
                        <small>
                            El campo debe contener entre 3 y 60 caracteres <br>
                            No deben incluirse caracteres especiales o números
                        </small>
                    </div>
                    <!-- DNI -->
                    <div class="dni">
                        <input id="dni-competidor" class="text-white text-center with-error" type="number" placeholder="NÚMERO DE DNI">
                        <small>
                            No deben incluirse puntos ni caracteres especiales, solo números <br>
                        </small>
                    </div>
                    <!-- Email -->
                    <div class="email">
                        <input id="email-competidor" class="text-white text-center with-error" type="email" placeholder="DIRECCIÓN DE CORREO ELECTRÓNICO">
                        <small>
                            Debe cumplirse el siguiente formato: "direccion@empresa.extensiones"
                        </small>
                    </div>
                    <!-- Telefono -->
                    <div class="telefono">
                        <input id="telefono-competidor" class="text-white text-center with-error" type="tel" placeholder="NÚMERO DE TELEFONO">
                        <small>
                            Debe cumplirse el siguiente formato: "(AAAA) NNNNNNNN" <br>
                            * AAAA representa el código de area (no deben ser exactamente 4 caracteres) <br>
                            * NNNNNNNN representa el número telefónico (no deben ser exactamente 8 caracteres) <br>
                            * Los parentesis deben ubicarse igual que en el ejemplo <br>
                            * El espacio luego del cierre de parentesis debe respetarse
                        </small>
                    </div>
                    <!-- Género -->
                    <div class="genero">
                        <div class="row etiqueta">
                            <label for="genero-competidor" class="col-md-12">GÉNERO</label>
                        </div>
                        <fieldset id="genero-competidor" class="row radio-button" value="GÉNERO">
                            <div class="col-6 radio-button">
                                <input id="genero-masculino" type="radio" value="MASCULINO" name="genero-competidor"> 
                                <label for="genero-masculino">
                                    <div class="icono"></div>
                                    <span>MASCULINO</span>
                                </label>
                            </div>
                            <div class="col-6 radio-button">
                                <input id="genero-femenino" type="radio" value="FEMENINO" name="genero-competidor"> 
                                <label for="genero-femenino">
                                    <div class="icono"></div>
                                    <span>FEMENINO</span>
                                </label>
                            </div>
                        </fieldset>
                    </div>
                    <!-- Nacimiento -->
                    <div class="nacimiento">
                        <input id="nacimiento-competidor" class="datepicker-nacimiento text-white text-center" placeholder="FECHA DE NACIMIENTO">
                    </div>
                    <!-- Foto -->
                    <div class="foto">
                        <div class="foto-competidor"><input id="foto-competidor" class="text text-center" type="file" placeholder="FOTO"></div>
                        <label for="foto-competidor" class="file text-center col-md-12"><div>SUBIR FOTO</div></label>
                    </div>

                    <h3 class="text-left">INFORMACIÓN DEPORTIVA</h3>
                    <!-- Federación -->
                    <div class="federacion">
                        <input id="federacion-competidor" class="text-white text-center with-error" type="text" placeholder="FEDERACIÓN">
                        <small>
                            El campo debe contener entre 3 y 30 caracteres <br>
                            No deben incluirse caracteres especiales o números
                        </small>
                    </div>
                    <!-- Club -->
                    <div class="club">
                        <input id="club-competidor" class="text-white text-center with-error" type="text" placeholder="CLUB">
                        <small>
                            El campo debe contener entre 3 y 30 caracteres <br>
                            No deben incluirse caracteres especiales o números
                        </small>
                    </div>
                    <!-- Peso Actual -->
                    <div class="peso">
                        <input id="peso-competidor" class="text-white text-center with-error" type="number" placeholder="PESO (KG)">
                        <small>
                            No deben incluirse puntos ni caracteres especiales, solo números <br>
                        </small>
                    </div>
                    <!-- Categoría -->
                    <div class="categoria">
                        <div class="row etiqueta">
                            <label for="categoria-competidor" class="col-md-12">CATEGORÍA</label>
                        </div>
                        <fieldset id="categoria-competidor" class="row radio-button" value="CATEGORÍA">
                            <div class="col-md-4 radio-button">
                                <input id="categoria-senior" type="radio" value="SENIOR" name="categoria-competidor"> 
                                <label for="categoria-senior">
                                    <div class="icono"></div>
                                    <span>SENIOR</span>
                                </label>
                            </div>
                            <div class="col-md-4 radio-button">
                                <input id="categoria-cadete" type="radio" value="CADETE" name="categoria-competidor"> 
                                <label for="categoria-cadete">
                                    <div class="icono"></div>
                                    <span>CADETE</span>
                                </label>
                            </div>
                            <div class="col-md-4 radio-button">
                                <input id="categoria-kyuGraduado" type="radio" value="KYU GRADUADO" name="categoria-competidor"> 
                                <label for="categoria-kyuGraduado">
                                    <div class="icono"></div>
                                    <span>KYU GRADUADO</span>
                                </label>
                            </div>
                            <div class="col-md-6 radio-button">
                                <input id="categoria-kyuNovicio" type="radio" value="KYU NOVICIO" name="categoria-competidor"> 
                                <label for="categoria-kyuNovicio">
                                    <div class="icono"></div>
                                    <span>KYU NOVICIO</span>
                                </label>
                            </div>
                            <div class="col-md-6 radio-button">
                                <input id="categoria-infantilB" type="radio" value="INFANTIL B" name="categoria-competidor"> 
                                <label for="categoria-infantilB">
                                    <div class="icono"></div>
                                    <span>INTANTIL B</span>
                                </label>
                            </div>
                        </fieldset>
                    </div>

                    <hr>
                    <!-- Enviar formulario -->
                    <input class="text text-center" type="submit" value="CREAR">
                </form>
            </div>
        </section>
        <!-- FOOTER -->
        <?php include 'templates/footer.php' ?>
        <!-- SCRIPTS -->
        <?php include 'templates/scripts.php' ?>
    </body>
</html>