<?php
    //Verifico el inicio de sesión del administrador
    session_start();
    if($_SESSION['logueado'] == 0) echo '<meta http-equiv="refresh" content="0; url=login.php">';
    //Cargo los datos necesarios de la base de datos
    require('db/conexion.php');
    
    //COMPETIDORES
    $cargarCompetidor = " SELECT * FROM competidores ORDER BY apellido ";
    $resultadoBD = $con->query($cargarCompetidor);

    $competidores = array();
    while($competidoresObtenidos = $resultadoBD->fetch_assoc()) {
        array_push($competidores, $competidoresObtenidos);
    }
    //TORNEOS
    $cargarTorneo = " SELECT * FROM torneos ORDER BY nombre ";
    $resultadoBD = $con->query($cargarTorneo);

    $torneos = array();
    while($competidoresTorneos = $resultadoBD->fetch_assoc()) {
        array_push($torneos, $competidoresTorneos);
    }
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
                <section id="descripcion-administrar-elemento" class="text-center">
                    <h1>ADMINISTRAR COMPETIDORES</h1>
                    <p>
                        Se han encontrado un total de <?php echo count($competidores); ?> competidores registrados
                    </p>
                </section>

                <hr>
                <!-- Tabla de Competidores -->
                <section id="tabla-de-administracion" class="text-center" style="min-height:55vh; overflow:scroll; width:95%; margin: 0 auto;">
                    <table id="tabla-administrar">
                        <thead>
                            <th width="33%">COMPETIDOR</th>
                            <th width="33%">DNI</th>
                            <th width="33%">ACCIONES</th>
                        </thead>
                        <tbody>
                            <?php 
                                foreach ($competidores as $competidor){
                            ?>
                                    <tr>
                                        <td width="33%"><?php echo $competidor['apellido'] . ', ' . $competidor['nombre']; ?></td>
                                        <td width="33%"><?php echo $competidor['dni']; ?></td>
                                        <td width="33%">
                                            <a id="sumar-puntos" data-competidor="<?php echo $competidor['dni']; ?>" href="#sumar-puntos-competidor" class="col-md-4 text-success" title="Actualizar Puntos" data-toggle="modal" data-target="#modal-puntos-<?php echo $competidor['dni']; ?>"><i class="fas fa-sort-numeric-up"></i></a>
                                            <a href="editar-competidor.php?id=<?php echo $competidor['dni']; ?>" class="col-md-4 text-warning" title="Editar"><i class="fas fa-pen-square"></i></a>
                                            <a id="eliminar-competidor" data-competidor="<?php echo $competidor['dni']; ?>" href="#eliminar-competidor" class="col-md-4 text-danger" title="Eliminar"><i class="fas fa-minus-square"></i></a>
                                        </td>
                                    </tr>
                            <?php 
                                }
                            ?>
                        </tbody>
                    </table>
                </section>
            </main>
        </div>
        <!-- Footer -->
        <?php include 'templates/footer.php'; ?>

        <!-- Modal Sumar Puntos -->
        <?php 
            foreach($competidores as $competidor){
                $dniUsuario = $competidor['dni'];
        ?>
                <div id="modal-puntos-<?php echo $competidor['dni']; ?>" class="modal fade bd-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="SumarPuntos" aria-hidden="true">
                    <!-- Cargo los puntajes del usuario -->
                    <?php 
                        $cargarPuntos = " SELECT * FROM `puntos-competidor` WHERE usuario = $dniUsuario ";
                        $resultadoBD = $con->query($cargarPuntos);

                        $puntosCompetidor = array();
                        while($puntosObtenidos = $resultadoBD->fetch_assoc()) {
                            array_push($puntosCompetidor, $puntosObtenidos);
                        }
                    ?>
                    
                    <!-- Contenido del Modal -->
                    <div id="modal-puntos" class="modal-dialog modal-lg">
                        <div class="modal-content" style="padding:2rem;">
                            <div class="informacion_puntos">
                                <button type="button" class="close text-danger" data-dismiss="modal" aria-label="Close" style="font-size:4rem;">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                                <!-- Descripción -->
                                <section id="descripcion-administrar-elemento" class="text-center">
                                    <h1>ADMINISTRAR PUNTOS</h1>
                                    <p>
                                        A continuación podrá actualizar los puntos del 
                                        participante seleccionado. Puede ver los puntos que el competidor 
                                        tiene en cada torneo en el <a href="../ranking.php" target="_blank">siguiente link</a>
                                        buscándolo y haciendo click sobre el mismo
                                    </p>

                                    <hr>
                                </section>

                                <!-- Formulario -->
                                <section id="formulario-creacion">
                                    <form id="actualizar-puntos-competidor" class="container text-center" data-usuario="<?php echo $dniUsuario; ?>" action="#">
                                        <!-- Seleccionar Torneo -->
                                        <div class="seleccionar-torneo">
                                            <select id="torneo-seleccionado" class="text-white text-center" required>
                                                <option disabled>SELECCIONE UN TORNEO</option>
                                                <?php 
                                                    foreach($torneos as $torneo){
                                                ?>  
                                                        <option value="<?php echo $torneo['id']; ?>"><?php echo $torneo['nombre']; ?></option>
                                                <?php 
                                                    }
                                                ?>
                                            </select>
                                        </div>
                                        <!-- Puntos Senior -->
                                        <h3 class="text-left">PUNTOS EN LA CATEGORÍA SENIOR</h3>
                                        <div class="puntos-senior">
                                            <input id="puntos-senior" class="text-white text-center with-error" type="number" required>
                                            <small>
                                                * Para sumar puntos, ingrese un número entero <br>
                                                * Para restar puntos, ingrese el símbolo '-' seguido de un número entero
                                            </small>
                                        </div>
                                        <!-- Puntos Cadete -->
                                        <h3 class="text-left">PUNTOS EN LA CATEGORÍA CADETE</h3>
                                        <div class="puntos-cadete">
                                            <input id="puntos-cadete" class="text-white text-center with-error" type="number" required>
                                            <small>
                                                * Para sumar puntos, ingrese un número entero <br>
                                                * Para restar puntos, ingrese el símbolo '-' seguido de un número entero
                                            </small>
                                        </div>
                                        <!-- Puntos Kyu Graduado -->
                                        <h3 class="text-left">PUNTOS EN LA CATEGORÍA KYU GRADUADO</h3>
                                        <div class="puntos-kyuGraduado">
                                            <input id="puntos-kyuGraduado" class="text-white text-center with-error" type="number" required>
                                            <small>
                                                * Para sumar puntos, ingrese un número entero <br>
                                                * Para restar puntos, ingrese el símbolo '-' seguido de un número entero
                                            </small>
                                        </div>
                                        <!-- Puntos Kyu Novicio -->
                                        <h3 class="text-left">PUNTOS EN LA CATEGORÍA KYU NOVICIO</h3>
                                        <div class="puntos-kyuNovicio">
                                            <input id="puntos-kyuNovicio" class="text-white text-center with-error" type="number" required>
                                            <small>
                                                * Para sumar puntos, ingrese un número entero <br>
                                                * Para restar puntos, ingrese el símbolo '-' seguido de un número entero
                                            </small>
                                        </div>
                                        <!-- Puntos Infantil B -->
                                        <h3 class="text-left">PUNTOS EN LA CATEGORÍA INFANTIL B</h3>
                                        <div class="puntos-infantilB">
                                            <input id="puntos-infantilB" class="text-white text-center with-error" type="number" required>
                                            <small>
                                                * Para sumar puntos, ingrese un número entero <br>
                                                * Para restar puntos, ingrese el símbolo '-' seguido de un número entero
                                            </small>
                                        </div>

                                        <hr>
                                        <!-- Enviar formulario -->
                                        <input class="text text-center" type="submit" value="ACTUALIZAR">
                                    </form>
                                </section>
                            </div>
                        </div>
                    </div>
                </div>
        <?php 
            }
        ?>
    </body>

    <?php include 'templates/scripts.php'; ?>
</html>