<?php
    //Verifico el inicio de sesión del administrador
    session_start();
    if($_SESSION['logueado'] == 0) echo '<meta http-equiv="refresh" content="0; url=login.php">';
    //Cargo los datos necesarios de la base de datos
    require('db/conexion.php');
    
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
                    <h1>ADMINISTRAR TORNEOS</h1>
                    <p>
                        Se han encontrado un total de <?php echo count($torneos); ?> torneos creados
                    </p>
                </section>

                <hr>
                <!-- Tabla de Torneos -->
                <section id="tabla-de-administracion" class="text-center" style="min-height:55vh; overflow:scroll; width:95%; margin: 0 auto;">
                    <table id="tabla-administrar">
                        <thead>
                            <th width="50%">NOMBRE</th>
                            <th width="50%">ACCIONES</th>
                        </thead>
                        <tbody>
                            <?php 
                                foreach ($torneos as $torneo){
                            ?>
                                    <tr>
                                        <td width="50%"><?php echo $torneo['nombre']; ?></td>
                                        <td width="50%">
                                            <a id="sumar-fechas" data-torneo="<?php echo $torneo['id']; ?>" href="#sumar-puntos-torneo" class="col-md-4 text-success" title="Agregar Fechas" data-toggle="modal" data-target="#modal-fechas-<?php echo $torneo['id']; ?>"><i class="fas fa-calendar"></i></a>
                                            <a href="editar-torneo.php?id=<?php echo $torneo['id']; ?>" class="col-md-4 text-warning" title="Editar"><i class="fas fa-pen-square"></i></a>
                                            <a id="eliminar-torneo" data-torneo="<?php echo $torneo['id']; ?>" href="#eliminar-torneo" class="col-md-4 text-danger" title="Eliminar"><i class="fas fa-minus-square"></i></a>
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

        <!-- Modal Fechas -->
        <?php 
            foreach($torneos as $torneo){
                $idTorneo = $torneo['id'];
        ?>
                <div id="modal-fechas-<?php echo $torneo['id']; ?>" class="modal-nueva-fecha modal fade bd-example-modal-lg" data-torneo="<?php echo $torneo['id']; ?>" tabindex="-1" role="dialog" aria-labelledby="Fechas" aria-hidden="true">
                    <!-- Cargo los puntajes del usuario -->
                    <?php 
                        $cargarFechas = " SELECT * FROM `fechas-torneo` WHERE torneo = $idTorneo ORDER BY fecha, hora ";
                        $resultadoBD = $con->query($cargarFechas);
                        
                        $fechasTorneo = array();
                        while($fechasObtenidas = $resultadoBD->fetch_assoc()){
                            array_push($fechasTorneo, $fechasObtenidas);
                        }
                    ?>
                    
                    <!-- Contenido del Modal -->
                    <div id="modal-fecha" class="modal-dialog modal-lg">
                        <div class="modal-content" style="padding:2rem;">
                            <div class="informacion_fechas">
                                <button type="button" class="close text-danger" data-dismiss="modal" aria-label="Close" style="font-size:4rem;">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                                <!-- Descripción -->
                                <section id="descripcion-administrar-elemento" class="text-center">
                                    <h1>ADMINISTRAR FECHAS</h1>
                                    <p>
                                        A continuación podrá añadir nuevas fechas al campeonato. 
                                        Preste atención al realizar la misma, ya que estas no pueden 
                                        eliminarse a no ser que se contacte con un programador
                                    </p>

                                    <hr>
                                </section>
                                <!-- Fechas actuales -->
                                <?php
                                    $contador = 0; 
                                    foreach ($fechasTorneo as $fecha){
                                ?>
                                        <section id="descripcion-administrar-elemento" class="text-center">
                                            <?php 
                                                if($contador == 0){
                                            ?>
                                                    <h1>FECHAS YA GENERADAS</h1>
                                            <?php 
                                                }
                                            ?>
                                            <hr>

                                            <p>
                                                <?php echo date('d/m/Y', strtotime($fecha['fecha'])); ?> --> <?php echo $fecha['hora']; ?> hrs.
                                            </p>

                                            <hr>
                                        </section> 
                                <?php
                                        $contador++; 
                                    }
                                ?>
                                <!-- Formulario -->
                                <section id="formulario-creacion">
                                    <form id="añadir-fecha" class="container text-center" data-torneo="<?php echo $idTorneo; ?>" action="#">
                                        <!-- Fecha -->
                                        <h3 class="text-left">DÍA DE CONCURRENCIA</h3>
                                        <div class="fecha">
                                            <input id="fecha-torneo" class="datepicker-fechas text-white text-center">
                                        </div>
                                        <!-- Hora -->
                                        <h3 class="text-left">HORARIO DE CONCURRENCIA</h3>
                                        <div class="hora">
                                            <input id="hora-torneo" class="text-white text-center with-error" type="text">
                                            <small>
                                                Se deberá respetar el siguiente formato: "HH:MM" <br>
                                                * HH representa a las horas <br>
                                                * MM representa a los minutos
                                            </small>
                                        </div>
                                        <!-- Dirección -->
                                        <h3 class="text-left">DIRECCIÓN</h3>
                                        <div class="direccion">
                                            <input id="direccion-torneo" class="text-white text-center with-error" type="text">
                                            <small>
                                                El campo debe contener entre 5 y 60 caracteres <br>
                                            </small>
                                        </div>

                                        <hr>
                                        <!-- Enviar formulario -->
                                        <input class="text text-center" type="submit" value="AÑADIR">
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