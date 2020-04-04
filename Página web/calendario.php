<?php
    //Cargo los datos necesarios de la base de datos
    require('administracion/db/conexion.php');
    
    //TORNEOS
    $torneoEspecifico = $_GET['torneo'];

    if($torneoEspecifico){
        $cargarTorneos = " SELECT * FROM `torneos` WHERE id = $torneoEspecifico ";
        $resultadoBD = $con->query($cargarTorneos);
        $torneos = array($resultadoBD->fetch_assoc());
    }
    else{
        $cargarTorneos = " SELECT * FROM `torneos` ";
        $resultadoBD = $con->query($cargarTorneos);

        $torneos = array();
        while($torneosObtenidos = $resultadoBD->fetch_assoc()) {
            array_push($torneos, $torneosObtenidos);
        }
    }
?>

<!DOCTYPE html>
<html lang="en">
    <!-- HEAD -->
    <?php include 'templates/head.php' ?>

    <body>
        <!-- HEADER -->
        <?php include 'templates/header.php' ?>
        <!-- SECCION CALENDARIO -->
        <section class="calendario">
            <!-- TITULO -->
            <h2 class="titulo-body">Calendario</h2>
            <p class="container text-center">
                * Si el calendario se encuentra vacio puede deberse a 
                que el torneo seleccionado es inexistente o que ya hayan 
                finalizado todas las fechas de los torneos existentes hasta 
                el momento.
            </p>
            <br>
            <!-- CONTENIDO -->
            <div class="container">
                <!-- CALENDARIO -->
                <div class="fechas-torneos">
                    <?php 
                        foreach($torneos as $torneo){
                            $idTorneo = $torneo['id'];
                            
                            //Cargo las fechas del torneo
                            $cargarFechas = " SELECT * FROM `fechas-torneo` WHERE torneo = $idTorneo ";
                            $resultadoBD = $con->query($cargarFechas);

                            $fechas = array();
                            $fechaActual = date('d-m-Y');
                            $diaFecha = null;

                            while($fechasObtenidas = $resultadoBD->fetch_assoc()) {
                                $diaFecha = date($fechasObtenidas['fecha']);
                                if($diaFecha >= $fechaActual) array_push($fechas, $fechasObtenidas);
                            }

                            if(count($fechas) > 0){
                    ?>
                                <div class="torneo-actual">
                                    <!-- TORNEO -->
                                    <div class="torneo-calendario">
                                        <h2><i class="fas fa-trophy"></i> <?php echo $torneo['nombre']; ?></h2>
                                    </div>
                                    <!-- DESCRIPCIÓN TORNEO -->
                                    <div class="fechas row">
                                        <?php 
                                            foreach($fechas as $fecha){
                                        ?>
                                                <div class="torneo card col-md-4">
                                                    <div class="info fecha-torneo">
                                                        <i class="fas fa-calendar-day"></i>
                                                        <p><?php echo $fecha['fecha']; ?></p>
                                                    </div>
                                                    <div class="info hora-torneo">
                                                        <i class="far fa-clock"></i>
                                                        <p><?php echo $fecha['hora']; ?> hrs.</p>
                                                    </div>
                                                    <div class="info direccion-torneo">
                                                        <i class="fas fa-map-marker-alt"></i>
                                                        <p><?php echo $fecha['direccion']; ?></p>
                                                    </div>
                                                </div>
                                        <?php 
                                            }
                                        ?>
                                    </div>
                                </div>
                    <?php
                            }
                        }
                    ?>
                </div>
            </div>
        </section>
        <!-- FOOTER -->
        <?php include 'templates/footer.php' ?>
        <!-- SCRIPTS -->
        <?php include 'templates/scripts.php' ?>
    </body>
</html>