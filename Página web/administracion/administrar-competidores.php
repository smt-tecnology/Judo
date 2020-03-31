<?php
    //Verifico el inicio de sesión del administrador
    session_start();
    if($_SESSION['logueado'] == 0) echo '<meta http-equiv="refresh" content="0; url=login.php">';
    //Cargo los datos necesarios de la base de datos
    require('db/conexion.php');
    
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
                                            <a id="sumar-puntos" data-competidor="<?php echo $competidor['dni']; ?>" href="#sumar-puntos-competidor" class="col-md-4 text-success" title="Actualizar Puntos"><i class="fas fa-sort-numeric-up"></i></a>
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
    </body>

    <?php include 'templates/scripts.php'; ?>
</html>