<?php
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
                <div class="text-center">
                    <div class="competidores">
                        <!-- Descripción -->
                        <section id="descripcion-administrar-elemento" class="text-center">
                            <h1>COMPETIDORES</h1>
                            <p>
                                Se han encontrado un total de <?php echo count($competidores); ?> competidores registrados
                            </p>
                        </section>

                        <hr>
                        <!-- Tabla de Competidores -->
                        <section id="tabla-de-administracion" class="tabla-index-1 text-center" style="overflow:scroll; width:95%; margin: 0 auto;">
                            <table id="tabla-administrar">
                                <tbody>
                                    <?php 
                                        foreach ($competidores as $competidor){
                                    ?>
                                            <tr>
                                                <td width="100%"><?php echo $competidor['apellido'] . ', ' . $competidor['nombre']; ?></td>
                                            </tr>
                                    <?php 
                                        }
                                    ?>
                                </tbody>
                            </table>
                        </section>
                    </div>
                    
                    <hr>

                    <div class="torneos">
                        <!-- Descripción -->
                        <section id="descripcion-administrar-elemento" class="text-center">
                            <h1>TORNEOS</h1>
                            <p>
                                Se han encontrado un total de <?php echo count($torneos); ?> torneos creados
                            </p>
                        </section>

                        <hr>
                        <!-- Tabla de Torneos -->
                        <section id="tabla-de-administracion" class="tabla-index-2 text-center" style="overflow:scroll; width:95%; margin: 0 auto;">
                            <table id="tabla-administrar">
                                <tbody>
                                    <?php 
                                        foreach ($torneos as $torneo){
                                    ?>
                                            <tr>
                                                <td width="100%"><?php echo $torneo['nombre']; ?></td>
                                            </tr>
                                    <?php 
                                        }
                                    ?>
                                </tbody>
                            </table>
                        </section>
                    </div>
                </div>
            </main>
        </div>
        <!-- Footer -->
        <?php include 'templates/footer.php'; ?>
    </body>

    <?php include 'templates/scripts.php'; ?>
</html>