<?php
    session_start();
    if($_SESSION['logueado'] == 0) echo '<meta http-equiv="refresh" content="0; url=login.php">';

    require('db/conexion.php');
    $idTorneo = $_GET['id'];
    $cargarTorneo = " SELECT * FROM torneos WHERE id = $idTorneo ";
    $resultadoBD = $con->query($cargarTorneo);
    $torneoObtenido = $resultadoBD->fetch_assoc();

    if(!$torneoObtenido) echo '<meta http-equiv="refresh" content="0; url=administrar-torneos.php">';
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
                    <h1>EDITAR TORNEO</h1>
                    <p>
                        Deberá rellenar los siguientes campos para poder 
                        editar al torneo
                    </p>
                </section>

                <hr>
                <!-- Formulario -->
                <section id="formulario-creacion">
                    <form id="editar-torneo" class="container text-center" action="#">
                        <h3 class="text-left">INFORMACIÓN PRINCIPAL</h3>
                        <!-- Nombre -->
                        <div class="nombre">
                            <input id="nombre-torneo" class="text-white text-center with-error" type="text" value="<?php echo $torneoObtenido['nombre']; ?>">
                            <small>
                                El campo debe contener entre 5 y 30 caracteres <br>
                                No deben incluirse caracteres especiales
                            </small>
                        </div>
                        <!-- Categorías -->
                        <div class="categoria">
                            <div class="row etiqueta">
                                <label for="categorias-torneo" class="col-md-12">CATEGORÍAS PARTICIPANTES</label>
                            </div>
                            <fieldset id="categorias-torneo" class="row checkbox-button" value="CATEGORÍAS PARTICIPANTES">
                                <div class="col-md-4 checkbox-button">
                                    <input id="categoria-senior" type="checkbox" name="categorias-torneo" value="SENIOR" <?php if(strpos($torneoObtenido['categorias'], "SENIOR") !== false) echo "checked"; ?>> 
                                    <label for="categoria-senior">
                                        <div class="icono"></div>
                                        <span>SENIOR</span>
                                    </label>
                                </div>
                                <div class="col-md-4 checkbox-button">
                                    <input id="categoria-cadete" type="checkbox" name="categorias-torneo" value="CADETE" <?php if(strpos($torneoObtenido['categorias'], "CADETE") !== false) echo "checked"; ?>> 
                                    <label for="categoria-cadete">
                                        <div class="icono"></div>
                                        <span>CADETE</span>
                                    </label>
                                </div>
                                <div class="col-md-4 checkbox-button">
                                    <input id="categoria-kyuGraduado" type="checkbox" name="categorias-torneo" value="KYU GRADUADO" <?php if(strpos($torneoObtenido['categorias'], "KYU GRADUADO") !== false) echo "checked"; ?>> 
                                    <label for="categoria-kyuGraduado">
                                        <div class="icono"></div>
                                        <span>KYU GRADUADO</span>
                                    </label>
                                </div>
                                <div class="col-md-6 checkbox-button">
                                    <input id="categoria-kyuNovicio" type="checkbox" name="categorias-torneo" value="KYU NOVICIO" <?php if(strpos($torneoObtenido['categorias'], "KYU NOVICIO") !== false) echo "checked"; ?>> 
                                    <label for="categoria-kyuNovicio">
                                        <div class="icono"></div>
                                        <span>KYU NOVICIO</span>
                                    </label>
                                </div>
                                <div class="col-md-6 checkbox-button">
                                    <input id="categoria-infantilB" type="checkbox" name="categorias-torneo" value="INFANTIL B" <?php if(strpos($torneoObtenido['categorias'], "INFANTIL B") !== false) echo "checked"; ?>> 
                                    <label for="categoria-infantilB">
                                        <div class="icono"></div>
                                        <span>INTANTIL B</span>
                                    </label>
                                </div>
                            </fieldset>
                        </div>

                        <h3 class="text-left">REGLAS</h3>
                        <!-- Reglas -->
                        <div class="reglas">
                            <textarea id="reglas-torneo" class="text-white text-center with-error" rows="5"><?php echo $torneoObtenido['reglas']; ?></textarea>
                            <small>
                                El campo debe contener entre 10 y 5000 caracteres <br>
                                El campo deberá respetar el siguiente formato: <br>
                                * Regla 1 <br>
                                * Regla 2 <br>
                                * Regla ...
                            </small>
                        </div>
                        
                        <hr>
                        <!-- Enviar formulario -->
                        <input type="hidden" id="id-torneo" value="<?php echo $idTorneo; ?>">
                        <input class="text text-center" type="submit" value="EDITAR">
                    </form>
                </section>
            </main>
        </div>
        <!-- Footer -->
        <?php include 'templates/footer.php'; ?>
    </body>

    <?php include 'templates/scripts.php'; ?>
</html>