<!-- Cargo los datos de la sesión -->
<?php 
    $torneoSeleccionado = $_GET['id'];
    $categoria = $_GET['tipo'];

    //Cargo los datos necesarios de la base de datos
    require('administracion/db/conexion.php');
    
    //TORNEOS
    $cargarTorneos = " SELECT * FROM torneos WHERE id = $torneoSeleccionado ";
    $resultadoBD = $con->query($cargarTorneos);
    $torneo = $resultadoBD->fetch_assoc();
?>

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
                    Deberas rellenar los siguientes campos para anotarte al 
                    torneo seleccionado previamente.
                </p>

                <br>
            </div>

            <hr>

            <?php 
                if($torneo){
            ?>
                    <!-- SELECCIONAR FORMULARIO -->
                    <section class="seleccionar-formulario">
                        <div class="categorias container text-center">                
                            <div class="row text-center">
                                <a href="inscripcion-torneo.php?id=<?php echo $torneo['id']; ?>&tipo=competidor" class="col-md-4 botonCategoria <?php if($categoria == "competidor") echo "active"; ?>">Soy un competidor</a>
                                <a href="inscripcion-torneo.php?id=<?php echo $torneo['id']; ?>&tipo=club" class="col-md-4 botonCategoria <?php if($categoria == "club") echo "active"; ?>">Soy un club</a>
                            </div>
                        </div>
                    </section>

                    <hr>

                    <!-- FORMULARIO -->
                    <?php 
                        if($categoria == "competidor"){
                    ?>
                            <div id="formulario-inscripcion">
                                <form id="inscribir-torneo-competidor" class="container text-center" action="#">
                                    <h3 class="text-center">SI PERTENECES AL RANKING...</h3>
                                    <!-- DNI -->
                                    <div class="dni">
                                        <input id="dni-competidor" class="text-white text-center with-error" type="number" placeholder="NÚMERO DE DNI">
                                        <small>
                                            No deben incluirse puntos ni caracteres especiales, solo números <br>
                                        </small>
                                    </div>
                                    <h3 class="text-center">SI NO PERTENECES AL RANKING...</h3>
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
                                        <div id="categoria-competidor" class="radio-button" value="CATEGORÍA">
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
                                        </div>
                                    </div>

                                    <hr>
                                    <!-- Enviar formulario -->
                                    <p>* Al enviar tus datos confirmás que aceptas los <a href="terminosycondiciones.php">Terminos y condiciones</a></p>
                                    <input class="text text-center" type="submit" value="ENVIAR">
                                    <input id="nombre-torneo" type="hidden" value="<?php echo $torneo['nombre']; ?>">
                                    <input id="id-torneo" type="hidden" value="<?php echo $torneo['id']; ?>">
                                </form>
                            </div>      
                    <?php        
                        }
                        else if($categoria == "club"){
                    ?>
                            <div id="formulario-inscripcion">
                                <form id="inscribir-torneo-club" class="container text-center" action="#">
                                    <h3 class="text-center">INFORMACIÓN DEL CLUB</h3>
                                    <p class="text-center">A continuación deberá detallar nombre del club y una dirección de correo y un número de telefono de quién realiza la inscripción.</p>
                                    <!-- Nombre -->
                                    <div class="nombre">
                                        <input id="nombre-club" class="text-white text-center with-error" type="text" placeholder="NOMBRE">
                                        <small>
                                            El campo debe contener entre 3 y 60 caracteres <br>
                                            No deben incluirse caracteres especiales o números
                                        </small>
                                    </div>
                                    <!-- Email -->
                                    <div class="email">
                                        <input id="email-club" class="text-white text-center with-error" type="email" placeholder="DIRECCIÓN DE CORREO ELECTRÓNICO">
                                        <small>
                                            Debe cumplirse el siguiente formato: "direccion@empresa.extensiones"
                                        </small>
                                    </div>
                                    <!-- Telefono -->
                                    <div class="telefono">
                                        <input id="telefono-club" class="text-white text-center with-error" type="tel" placeholder="NÚMERO DE TELEFONO">
                                        <small>
                                            Debe cumplirse el siguiente formato: "(AAAA) NNNNNNNN" <br>
                                            * AAAA representa el código de area (no deben ser exactamente 4 caracteres) <br>
                                            * NNNNNNNN representa el número telefónico (no deben ser exactamente 8 caracteres) <br>
                                            * Los parentesis deben ubicarse igual que en el ejemplo <br>
                                            * El espacio luego del cierre de parentesis debe respetarse
                                        </small>
                                    </div>
                                    <h3 class="text-center">INFORMACIÓN DE LOS PARTICIPANTES</h3>
                                    <p class="text-center">A continuación deberá detallar la información de los participantes del club. Para pasar al siguiente participante deberá clickear el botón "ENVIAR" una vez rellenados los datos del actual.</p>
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
                                        <div id="categoria-competidor" class="radio-button" value="CATEGORÍA">
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
                                        </div>
                                    </div>

                                    <hr>
                                    <!-- Enviar formulario -->
                                    <p>* Al enviar tus datos confirmás que aceptas los <a href="terminosycondiciones.php">Terminos y condiciones</a></p>
                                    <input id="id-torneo" type="hidden" value="<?php echo $torneo['id']; ?>">
                                    <input id="nombre-torneo" type="hidden" value="<?php echo $torneo['nombre']; ?>">
                                    <input class="text text-center" type="submit" value="ENVIAR">
                                </form>
                            </div>  
                    <?php
                        }
                        else{
                    ?>
                            <br> <br> <br>
                    <?php
                        }
                    ?>
            <?php 
                }
                else{
            ?>
                    <br> <br> <br>
                    <p class="text-center">
                        El torneo seleccionado es inexistente, por favor, vuelva a ingresar a la sección de torneos e indique uno válido.
                    </p>
                    <br> <br> <br>
            <?php
                }
            ?>
        </section>
        <!-- FOOTER -->
        <?php include 'templates/footer.php' ?>
        <!-- SCRIPTS -->
        <?php include 'templates/scripts.php' ?>
    </body>
</html>