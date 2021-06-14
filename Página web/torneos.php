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
                        if (count($torneos) == 0) { ?>
                            <li data-target="#carousel-torneos" data-slide-to="0" class="active"></li>
                        <?php }
                        foreach($torneos as $torneo){
                    ?>
                            <li data-target="#carousel-torneos" data-slide-to="<?php echo $contador; ?>" class="<?php if($contador == 0) echo "active"; ?>"></li>
                    <?php
                            $contador++; 
                        }
                    ?>
                </ul>
                <!-- SLIDES -->
                <div class="Torneos carousel-inner" <?php if(count($torneos)==0){ ?> style="
                            background-image: linear-gradient(rgba(0, 0, 0, 0.6), rgba(0, 0, 0, 0.6)), url(../img/Slides-Index/1.png);" >
                    <?php
                }
                        if (count($torneos) == 0) { ?>
                        <!-- SLIDE POR DEFECTO -->
                            <div class="carousel-item active">
                                <div class="torneo">
                                    <h3>No hay torneos cargados por el momento</h3>

                                    <br>
                                    
                                </div>
                            </div>
                    <?php
                        }
                        $contador = 0; 
                        foreach($torneos as $torneo){
                            $torneo['categorias'] = str_replace('{', '', $torneo['categorias']);
                            $torneo['categorias'] = str_replace('}', '', $torneo['categorias']);
                            $torneo['reglas'] = str_replace('*', '<br><br>*', $torneo['reglas']);
                    ?>
                            
                            <!-- SLIDE -->
                            <div class="carousel-item <?php if($contador == 0) echo "active"; ?>" style="
                            background-image: linear-gradient(rgba(0, 0, 0, 0.6), rgba(0, 0, 0, 0.6)), url('<?php echo $torneo['imagen'] ?>');
                            background-position: center;
                            background-repeat: no-repeat;
                            background-size: 100% 100%;
                            text-align: center;
                            padding: 10px;">
                                <div class="torneo">
                                    <h3><?php echo $torneo['nombre']; ?></h3>

                                    <br>
                                    <h5>CATEGORÍAS PARTICIPANTES</h5>
                                    <p><?php echo $torneo['categorias']; ?></p>

                                    <ul class="listabotones">
                                        <li><a href="calendario.php?torneo=<?php echo $torneo['id']; ?>">Calendario</a></li>
                                        <li><a href="<?php echo $torneo['reglas']; ?>" target="_blank">Ver Reglas</a></li>
                                        <li><a href="inscripcion-torneo.php?id=<?php echo $torneo['id']; ?>">Inscribirse</a></li>
                                    </ul>
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
        
        <!-- FOOTER -->
        <?php include 'templates/footer.php' ?>
        <!-- SCRIPTS -->
        <?php include 'templates/scripts.php' ?>
    </body>

</html>