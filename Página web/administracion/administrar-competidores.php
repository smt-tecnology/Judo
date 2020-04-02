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

                $puntosSenior = 0;
                $puntosCadete = 0;
                $puntosKyuGraduado = 0;
                $puntosKyuNovicio = 0;
                $puntosInfantilB = 0;
        ?>
                <div id="modal-puntos-<?php echo $competidor['dni']; ?>" class="modal fade bd-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="SumarPuntos" aria-hidden="true">
                    <!-- Cargo los puntajes del usuario -->
                    <?php 
                        $cargarPuntos = " SELECT * FROM `puntos-competidor` WHERE usuario = $dniUsuario ";
                        $resultadoBD = $con->query($cargarPuntos);
                        $puntosObtenidos = $resultadoBD->fetch_assoc();

                        if($puntosObtenidos){
                            $puntosSenior = $puntosObtenidos['puntos_senior'];
                            $puntosCadete = $puntosObtenidos['puntos_cadete'];
                            $puntosKyuGraduado = $puntosObtenidos['puntos_kyu_graduado'];
                            $puntosKyuNovicio = $puntosObtenidos['puntos_kyu_novicio'];
                            $puntosInfantilB = $puntosObtenidos['puntos_infantil_b'];
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
                                        participante seleccionado.
                                    </p>

                                    <hr>
                                </section>

                                <!-- Formulario -->
                                <section id="formulario-creacion">
                                    <form id="actualizar-puntos-competidor" class="container text-center" data-usuario="<?php echo $dniUsuario; ?>" action="#">
                                        <!-- Puntos Senior -->
                                        <h3 class="text-left">PUNTOS EN LA CATEGORÍA SENIOR</h3>
                                        <div class="puntos-senior">
                                            <p>Actualmente el competidor tiene <?php echo $puntosSenior; ?> puntos</p>
                                            <input id="puntos-senior" class="text-white text-center with-error" type="number" data-valor-inicial="<?php echo $puntosSenior; ?>" required>
                                            <small>
                                                * Para sumar puntos, ingrese un número entero <br>
                                                * Para restar puntos, ingrese el símbolo '-' seguido de un número entero
                                            </small>
                                        </div>
                                        <!-- Puntos Cadete -->
                                        <h3 class="text-left">PUNTOS EN LA CATEGORÍA CADETE</h3>
                                        <div class="puntos-cadete">
                                            <p>Actualmente el competidor tiene <?php echo $puntosCadete; ?> puntos</p>
                                            <input id="puntos-cadete" class="text-white text-center with-error" type="number" data-valor-inicial="<?php echo $puntosCadete; ?>" required>
                                            <small>
                                                * Para sumar puntos, ingrese un número entero <br>
                                                * Para restar puntos, ingrese el símbolo '-' seguido de un número entero
                                            </small>
                                        </div>
                                        <!-- Puntos Kyu Graduado -->
                                        <h3 class="text-left">PUNTOS EN LA CATEGORÍA KYU GRADUADO</h3>
                                        <div class="puntos-kyuGraduado">
                                            <p>Actualmente el competidor tiene <?php echo $puntosKyuGraduado; ?> puntos</p>
                                            <input id="puntos-kyuGraduado" class="text-white text-center with-error" type="number" data-valor-inicial="<?php echo $puntosKyuGraduado; ?>" required>
                                            <small>
                                                * Para sumar puntos, ingrese un número entero <br>
                                                * Para restar puntos, ingrese el símbolo '-' seguido de un número entero
                                            </small>
                                        </div>
                                        <!-- Puntos Kyu Novicio -->
                                        <h3 class="text-left">PUNTOS EN LA CATEGORÍA KYU NOVICIO</h3>
                                        <div class="puntos-kyuNovicio">
                                            <p>Actualmente el competidor tiene <?php echo $puntosKyuNovicio; ?> puntos</p>
                                            <input id="puntos-kyuNovicio" class="text-white text-center with-error" type="number" data-valor-inicial="<?php echo $puntosKyuNovicio; ?>" required>
                                            <small>
                                                * Para sumar puntos, ingrese un número entero <br>
                                                * Para restar puntos, ingrese el símbolo '-' seguido de un número entero
                                            </small>
                                        </div>
                                        <!-- Puntos Infantil B -->
                                        <h3 class="text-left">PUNTOS EN LA CATEGORÍA INFANTIL B</h3>
                                        <div class="puntos-infantilB">
                                            <p>Actualmente el competidor tiene <?php echo $puntosInfantilB; ?> puntos</p>
                                            <input id="puntos-infantilB" class="text-white text-center with-error" type="number" data-valor-inicial="<?php echo $puntosInfantilB; ?>" required>
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