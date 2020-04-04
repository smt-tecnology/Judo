<?php
    //Cargo los datos necesarios de la base de datos
    require('administracion/db/conexion.php');
    
    //TORNEOS
    $cargarTorneos = " SELECT * FROM `torneos` ";
    $resultadoBD = $con->query($cargarTorneos);

    $torneos = array();
    while($torneosObtenidos = $resultadoBD->fetch_assoc()) {
        array_push($torneos, $torneosObtenidos);
    }
?>

<!DOCTYPE html>
<html lang="en">

    <?php include 'templates/head.php' ?>

    <body>
        <!-- HEADER -->
        <?php include 'templates/header.php' ?>
        <!-- TORNEOS -->
        <section class="torneos">
            <!-- TITULO -->
            <h2 class="titulo-body">Torneos</h2>
            <!-- SLIDER -->
            <div id="carousel-torneos" class="carousel slide" data-ride="carousel">
                <!-- INDICADORES -->
                <ul class="carousel-indicators" style="margin-bottom:0">
                    <?php
                        $contador = 0; 
                        foreach($torneos as $torneo){
                    ?>
                            <li data-target="#carousel-torneos" data-slide-to="<?php echo $contador; ?>" class="<?php if($contador == 0) echo "active"; ?>"></li>
                    <?php
                            $contador++; 
                        }
                    ?>
                </ul>
                <!-- SLIDES -->
                <div class="Torneos carousel-inner">
                    <?php
                        $contador = 0; 
                        foreach($torneos as $torneo){
                            $torneo['categorias'] = str_replace('{', '', $torneo['categorias']);
                            $torneo['categorias'] = str_replace('}', '', $torneo['categorias']);
                            $torneo['reglas'] = str_replace('*', '<br><br>*', $torneo['reglas']);
                    ?>
                            <!-- SLIDE -->
                            <div class="carousel-item <?php if($contador == 0) echo "active"; ?>">
                                <div class="torneo">
                                    <h3><?php echo $torneo['nombre']; ?></h3>

                                    <br>
                                    <h5>CATEGORÍAS PARTICIPANTES</h5>
                                    <p><?php echo $torneo['categorias']; ?></p>

                                    <ul class="listabotones">
                                        <li><a href="calendario.php?torneo=<?php echo $torneo['id']; ?>">Calendario</a></li>
                                        <li><a href="#reglas-torneo" data-toggle="modal" data-target="#modal-torneo-<?php echo $torneo['id']; ?>">Ver Reglas</a></li>
                                    </ul>
                                </div>
                            </div>
                            <!-- MODAL TORNEO -->
                            <div id="modal-torneo-<?php echo $torneo['id']; ?>" class="modal fade bd-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="Torneos" aria-hidden="true">
                                <!-- Contenido del Modal -->
                                <div class="modal-dialog modal-lg">
                                    <div class="modal-content" style="padding:2rem;">
                                        <div class="reglas-torneo">
                                            <button type="button" class="close text-danger" data-dismiss="modal" aria-label="Close" style="font-size:4rem;">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                            <!-- DESCRIPCION -->
                                            <section class="descripcion text-center">
                                                <h1>REGLAS DEL TORNEO</h1>

                                                <hr>
                                            </section>
                                            <!-- REGLAS -->
                                            <section class="reglas text-left">
                                                <?php echo $torneo['reglas']; ?>
                                            </section>
                                        </div>
                                    </div>
                                </div>
                            </div>
                    <?php
                            $contador++; 
                        }
                    ?>
                </div>
                <!-- CONTROLES -->
                <a class="carousel-control-prev " href="#carousel-torneos" data-slide="prev">
                    <span class="carousel-control-prev-icon prev"></span>
                </a>
                <a class="carousel-control-next " href="#carousel-torneos" data-slide="next">
                    <span class="carousel-control-next-icon next"></span>
                </a>
            </div>
        </section>
        <!-- SECCION  INSCRIPCIONES -->
        <section class="inscripciones">
            <div class="container">
                <h2 class="titulo-body">Inscripciones</h2>
                <p class="inscripciones-parrafo">¿Deseas participar en uno de nuestros torneos? Haz click en el siguiente botón y completa el formulario para que podamos evaluar tu solicitud.</p>
                <div class="text-center boton-inscripcion">
                    <a href="inscripciones.php">Inscripción</a>
                </div>
            </div>

            <br><br><br>
        </section>
        <!-- FOOTER -->
        <?php include 'templates/footer.php' ?>
        <!-- SCRIPTS -->
        <?php include 'templates/scripts.php' ?>
    </body>

</html>