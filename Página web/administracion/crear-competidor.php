<?php
    session_start();
    if($_SESSION['logueado'] == 0) echo '<meta http-equiv="refresh" content="0; url=login.php">';
?>

<!DOCTYPE html>
<html lang="es">
    <?php include 'templates/head.php'; ?>

    <body id="admin-index">
        <!-- Header -->
        <?php include 'templates/header.php'; ?>
        <div class="row">
            <!-- Sidebar -->
            <?php include 'templates/sidebar.php'; ?>
            <!-- Contenido principal -->
            <main id="contenido-principal" class="text-center">
                <!-- Descripción -->
                <section id="descripcion-nuevo-elemento" class="text-center">
                    <h1>NUEVO COMPETIDOR</h1>
                    <p>
                        Deberá rellenar los siguientes campos para poder 
                        generar un competidor
                    </p>
                </section>

                <hr>
                <!-- Formulario -->
                <section id="formulario-creacion">
                    <form id="crear-competidor" class="container text-center" action="#">
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
                            <fieldset id="genero-competidor" class="radio-button" value="GÉNERO">
                                <div class="row">
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
                                </div>
                            </fieldset>
                        </div>
                        <!-- Nacimiento -->
                        <div class="nacimiento">
                            <input id="nacimiento-competidor" class="text-white text-center with-error" type="text" placeholder="FECHA DE NACIMIENTO">
                            <small>
                                Debe cumplirse el siguiente formato: "DIA/MES/AÑO" <br>
                                * Si desea resetear el campo porque se equivocó en algún valor presione la tecla "Z"
                            </small>
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
                            <fieldset id="categoria-competidor" class="radio-button" value="CATEGORÍA">
                                <div class="row">
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
                                </div>
                                <div class="row">
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
                                </div>
                            </fieldset>
                        </div>

                        <hr>
                        <!-- Enviar formulario -->
                        <input class="text text-center" type="submit" value="CREAR">
                    </form>
                </section>
            </main>
        </div>
        <!-- Footer -->
        <?php include 'templates/footer.php'; ?>
    </body>

    <?php include 'templates/scripts.php'; ?>
</html>