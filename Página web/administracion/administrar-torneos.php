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
                                            <a id="sumar-fechas" data-torneo="<?php echo $torneo['id']; ?>" href="#sumar-puntos-torneo" class="col-md-4 text-success" title="Agregar Fechas"><i class="fas fa-calendar"></i></a>
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
    </body>

    <?php include 'templates/scripts.php'; ?>
</html>