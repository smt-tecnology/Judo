<?php
    $rankingSeleccionado = $_GET['ranking'];
    $categoriaSeleccionada = $_GET['categoria'];
    require('administracion/db/conexion.php');

    if(!$rankingSeleccionado){
        //COMPETIDORES
        $cargarCompetidor = " SELECT * FROM competidores ";
        $resultadoBD = $con->query($cargarCompetidor);

        $competidores = array();
        while($competidoresObtenidos = $resultadoBD->fetch_assoc()) {
            array_push($competidores, $competidoresObtenidos);
        }
        //TORNEOS
        $cargarTorneo = " SELECT * FROM torneos ";
        $resultadoBD = $con->query($cargarTorneo);

        $torneos = array();
        while($competidoresTorneos = $resultadoBD->fetch_assoc()) {
            array_push($torneos, $competidoresTorneos);
        }
    }
    else if($rankingSeleccionado == "club"){
        //COMPETIDORES
        $cargarCompetidor = " SELECT dni, club FROM competidores ";
        $resultadoBD = $con->query($cargarCompetidor);

        $competidores = array();
        while($competidoresObtenidos = $resultadoBD->fetch_assoc()) {
            array_push($competidores, $competidoresObtenidos);
        }

        //CLUBES
        $cargarClub = " SELECT club FROM competidores GROUP BY club ";
        $resultadoBD = $con->query($cargarClub);

        $clubes = array();
        while($clubesObtenidos = $resultadoBD->fetch_assoc()) {
            array_push($clubes, $clubesObtenidos);
        }
    }
    else if($rankingSeleccionado == "federacion"){
        //COMPETIDORES
        $cargarCompetidor = " SELECT dni, federacion FROM competidores ";
        $resultadoBD = $con->query($cargarCompetidor);

        $competidores = array();
        while($competidoresObtenidos = $resultadoBD->fetch_assoc()) {
            array_push($competidores, $competidoresObtenidos);
        }

        //CLUBES
        $cargarFederacion = " SELECT federacion FROM competidores GROUP BY federacion ";
        $resultadoBD = $con->query($cargarFederacion);

        $federaciones = array();
        while($federacionesObtenidas = $resultadoBD->fetch_assoc()) {
            array_push($federaciones, $federacionesObtenidas);
        }
    }
?>

<!DOCTYPE html>
<html lang="en">
    <?php include 'templates/head.php' ?>

    <body>
        <!-- HEADER -->
        <?php include 'templates/header.php' ?>

        <br>
        <!-- RANKING -->
        <section class="seleccionar-tabla">
            <div class="categorias container text-center">                
                <div class="row text-center">
                    <a href="ranking.php" class="col-md-4 botonCategoria <?php if(!$rankingSeleccionado) echo "active"; ?>">Ranking de competidores</a>
                    <a href="ranking.php?ranking=club" class="col-md-4 botonCategoria <?php if($rankingSeleccionado == "club") echo "active"; ?>">Ranking de clubes</a>
                    <a href="ranking.php?ranking=federacion" class="col-md-4 botonCategoria <?php if($rankingSeleccionado == "federacion") echo "active"; ?>">Ranking de federaciones</a>
                </div>
            </div>
        </section>

        <hr>

        <?php 
            if(!$rankingSeleccionado){ 
        ?>
                <section class="ranking-section ranking-competidores">
                    <!-- DESCRIPCIÓN -->
                    <h2 class="titulo-body">Ranking</h2>
                    <!-- CATEGORIAS -->
                    <div class="categorias container text-center">
                        <div class="row text-center">
                            <a href="ranking.php" class="col-md-12 botonCategoria <?php if(!$categoriaSeleccionada) echo "active"; ?>">Todas las categorías</a>
                        </div>

                        <br>
                        
                        <div class="row text-center">
                            <a href="ranking.php?categoria=senior" class="col-md-2 botonCategoria <?php if($categoriaSeleccionada == "senior") echo "active"; ?>">Senior</a>
                            <a href="ranking.php?categoria=cadete" class="col-md-2 botonCategoria <?php if($categoriaSeleccionada == "cadete") echo "active"; ?>">Cadete</a>
                            <a href="ranking.php?categoria=kyuGraduado" class="col-md-2 botonCategoria <?php if($categoriaSeleccionada == "kyuGraduado") echo "active"; ?>">Kyu Graduado</a>
                            <a href="ranking.php?categoria=kyuNovicio" class="col-md-2 botonCategoria <?php if($categoriaSeleccionada == "kyuNovicio") echo "active"; ?>">Kyu Novicio</a>
                            <a href="ranking.php?categoria=infantilB" class="col-md-2 botonCategoria <?php if($categoriaSeleccionada == "infantilB") echo "active"; ?>">Infantil B</a>
                        </div>
                    </div>

                    <br><br><br>

                    <!-- PESOS Y RANKING -->
                    <div id="tablas-ranking" class="container row text-center">
                        <!-- PESOS -->
                        <div class="tabla-pesos text-center col-md-2">
                            <table id="pesos">
                                <!-- HEADER -->
                                <thead>
                                    <th style="width: 50%;">M</th>
                                    <th style="width: 50%;">F</th>
                                </thead>
                                <!-- BODYS -->
                                <?php 
                                    if($categoriaSeleccionada == "senior"){
                                ?>
                                        <tbody class="pesos-senior">
                                            <tr data-position="1">
                                                <td style="width: 50%;">-60</td>
                                                <td style="width: 50%;">-48</td>
                                            </tr>
                                            <tr data-position="2">
                                                <td style="width: 50%;">-66</td>
                                                <td style="width: 50%;">-52</td>
                                            </tr>
                                            <tr data-position="3">
                                                <td style="width: 50%;">-73</td>
                                                <td style="width: 50%;">-57</td>
                                            </tr>
                                            <tr data-position="4">
                                                <td style="width: 50%;">-81</td>
                                                <td style="width: 50%;">-63</td>
                                            </tr>
                                            <tr data-position="5">
                                                <td style="width: 50%;">-90</td>
                                                <td style="width: 50%;">-70</td>
                                            </tr>
                                            <tr data-position="6">
                                                <td style="width: 50%;">-100</td>
                                                <td style="width: 50%;">-78</td>
                                            </tr>
                                            <tr data-position="7">
                                                <td style="width: 50%;">+100</td>
                                                <td style="width: 50%;">+78</td>
                                            </tr>
                                        </tbody>
                                <?php 
                                    }
                                    else if($categoriaSeleccionada == "cadete"){
                                ?>
                                        <tbody class="pesos-cadete">
                                            <tr data-position="1">
                                                <td style="width: 50%;">-50</td>
                                                <td style="width: 50%;">-40</td>
                                            </tr>
                                            <tr data-position="2">
                                                <td style="width: 50%;">-55</td>
                                                <td style="width: 50%;">-44</td>
                                            </tr>
                                            <tr data-position="3">
                                                <td style="width: 50%;">-60</td>
                                                <td style="width: 50%;">-48</td>
                                            </tr>
                                            <tr data-position="4">
                                                <td style="width: 50%;">-66</td>
                                                <td style="width: 50%;">-52</td>
                                            </tr>
                                            <tr data-position="5">
                                                <td style="width: 50%;">-73</td>
                                                <td style="width: 50%;">-57</td>
                                            </tr>
                                            <tr data-position="6">
                                                <td style="width: 50%;">-81</td>
                                                <td style="width: 50%;">-63</td>
                                            </tr>
                                            <tr data-position="7">
                                                <td style="width: 50%;">-90</td>
                                                <td style="width: 50%;">-70</td>
                                            </tr>
                                            <tr data-position="8">
                                                <td style="width: 50%;">+90</td>
                                                <td style="width: 50%;">+70</td>
                                            </tr>
                                        </tbody>
                                <?php 
                                    }
                                    else if($categoriaSeleccionada == "kyuGraduado" || $categoriaSeleccionada == "kyuNovicio"){
                                ?>
                                        <tbody class="pesos-kyu-graduado">
                                            <tr data-position="1">
                                                <td style="width: 50%;">-55</td>
                                                <td style="width: 50%;">-48</td>
                                            </tr>
                                            <tr data-position="2">
                                                <td style="width: 50%;">-60</td>
                                                <td style="width: 50%;">-52</td>
                                            </tr>
                                            <tr data-position="3">
                                                <td style="width: 50%;">-66</td>
                                                <td style="width: 50%;">-57</td>
                                            </tr>
                                            <tr data-position="4">
                                                <td style="width: 50%;">-73</td>
                                                <td style="width: 50%;">-63</td>
                                            </tr>
                                            <tr data-position="5">
                                                <td style="width: 50%;">-81</td>
                                                <td style="width: 50%;">-70</td>
                                            </tr>
                                            <tr data-position="6">
                                                <td style="width: 50%;">-90</td>
                                                <td style="width: 50%;">-78</td>
                                            </tr>
                                            <tr data-position="7">
                                                <td style="width: 50%;">-100</td>
                                                <td style="width: 50%;">+78</td>
                                            </tr>
                                            <tr data-position="8">
                                                <td style="width: 50%;">+100</td>
                                            </tr>
                                        </tbody>   
                                <?php 
                                    }
                                    else if($categoriaSeleccionada == "infantilB"){
                                ?>
                                        <tbody class="pesos-infantil-b">
                                            <tr data-position="1">
                                                <td style="width: 50%;">-36</td>
                                                <td style="width: 50%;">-36</td>
                                            </tr>
                                            <tr data-position="2">
                                                <td style="width: 50%;">-40</td>
                                                <td style="width: 50%;">-40</td>
                                            </tr>
                                            <tr data-position="3">
                                                <td style="width: 50%;">-44</td>
                                                <td style="width: 50%;">-44</td>
                                            </tr>
                                            <tr data-position="4">
                                                <td style="width: 50%;">-48</td>
                                                <td style="width: 50%;">-48</td>
                                            </tr>
                                            <tr data-position="5">
                                                <td style="width: 50%;">-53</td>
                                                <td style="width: 50%;">-53</td>
                                            </tr>
                                            <tr data-position="6">
                                                <td style="width: 50%;">-58</td>
                                                <td style="width: 50%;">-58</td>
                                            </tr>
                                            <tr data-position="7">
                                                <td style="width: 50%;">-64</td>
                                                <td style="width: 50%;">-64</td>
                                            </tr>
                                            <tr data-position="8">
                                                <td style="width: 50%;">+64</td>
                                                <td style="width: 50%;">+64</td>
                                            </tr>
                                        </tbody>
                                <?php 
                                    }
                                    else{
                                ?>
                                        <tbody class="pesos-general">
                                            <tr data-position="1">
                                                <td style="width: 50%;">-36</td>
                                                <td style="width: 50%;">-36</td>
                                            </tr>
                                            <tr data-position="2">
                                                <td style="width: 50%;">-40</td>
                                                <td style="width: 50%;">-40</td>
                                            </tr>
                                            <tr data-position="3">
                                                <td style="width: 50%;">-44</td>
                                                <td style="width: 50%;">-44</td>
                                            </tr>
                                            <tr data-position="4">
                                                <td style="width: 50%;">-48</td>
                                                <td style="width: 50%;">-48</td>
                                            </tr>
                                            <tr data-position="5">
                                                <td style="width: 50%;">-50</td>
                                                <td style="width: 50%;">-52</td>
                                            </tr>
                                            <tr data-position="6">
                                                <td style="width: 50%;">-53</td>
                                                <td style="width: 50%;">-53</td>
                                            </tr>
                                            <tr data-position="7">
                                                <td style="width: 50%;">-55</td>
                                                <td style="width: 50%;">-57</td>
                                            </tr>
                                            <tr data-position="8">
                                                <td style="width: 50%;">-58</td>
                                                <td style="width: 50%;">-58</td>
                                            </tr>
                                            <tr data-position="9">
                                                <td style="width: 50%;">-60</td>
                                                <td style="width: 50%;">-63</td>
                                            </tr>
                                            <tr data-position="10">
                                                <td style="width: 50%;">-64</td>
                                                <td style="width: 50%;">-64</td>
                                            </tr>
                                            <tr data-position="11">
                                                <td style="width: 50%;">-66</td>
                                                <td style="width: 50%;">-70</td>
                                            </tr>
                                            <tr data-position="12">
                                                <td style="width: 50%;">-73</td>
                                                <td style="width: 50%;">-78</td>
                                            </tr>
                                            <tr data-position="13">
                                                <td style="width: 50%;">-81</td>
                                                <td style="width: 50%;">-70</td>
                                            </tr>
                                            <tr data-position="14">
                                                <td style="width: 50%;">-90</td>
                                                <td style="width: 50%;">-78</td>
                                            </tr>
                                            <tr data-position="15">
                                                <td style="width: 50%;">-100</td>
                                                <td style="width: 50%;">+78</td>
                                            </tr>
                                            <tr data-position="16">
                                                <td style="width: 50%;">+100</td>
                                            </tr>
                                        </tbody>
                                <?php
                                    }
                                ?>
                            </table>
                        </div>
                        <!-- RANKING -->
                        <div class="tabla-competidores text-center col-md-10">
                            <table id="ranking" ranking="competidor">
                                <!-- HEADER -->
                                <thead>
                                    <th style="width: 10%;">Puesto</th>
                                    <th style="width: 30%;">
                                        Competidor
                                        <input id="buscador-competidor" type="search" placeholder="Ingresa tu nombre..." class="tablesorter-filter" data-column="1" aria-label="Filter &quot;Last Name&quot; column by..." data-lastsearchtime="1585992560956">
                                    </th>
                                    <th style="width: 25%;">Club</th>
                                    <th style="width: 25%;">Federación</th>
                                    <th style="width: 10%;">Puntos</th>
                                </thead>
                                <!-- BODY -->
                                <tbody>
                                    <?php
                                        $contador = 1; 
                                        foreach($competidores as $competidor){
                                            //Cargo los puntos del competidor
                                            $dniUsuario = $competidor['dni'];
                                            $cargarPuntos = " SELECT * FROM `puntos-competidor` WHERE usuario = $dniUsuario ";
                                            $resultadoBD = $con->query($cargarPuntos);
                                            
                                            $puntosCompetidor = array();
                                            $puntosCategoria = 0;
                                            while($puntosObtenidos = $resultadoBD->fetch_assoc()){
                                                //Asigno los puntos según la categoría seleccionada
                                                if($categoriaSeleccionada == "senior") $puntosCategoria += $puntosObtenidos['puntos_senior'];
                                                else if($categoriaSeleccionada == "cadete") $puntosCategoria += $puntosObtenidos['puntos_cadete'];
                                                else if($categoriaSeleccionada == "kyuGraduado") $puntosCategoria += $puntosObtenidos['puntos_kyu_graduado'];
                                                else if($categoriaSeleccionada == "kyuNovicio") $puntosCategoria += $puntosObtenidos['puntos_kyu_novicio'];
                                                else if($categoriaSeleccionada == "infantilB") $puntosCategoria += $puntosObtenidos['puntos_infantil_b'];
                                                else $puntosCategoria += ($puntosObtenidos['puntos_senior'] + $puntosObtenidos['puntos_cadete'] + $puntosObtenidos['puntos_kyu_graduado'] + $puntosObtenidos['puntos_kyu_novicio'] + $puntosObtenidos['puntos_infantil_b']);
                                                //Agrego a los puntos obtenidos por el competidor, para detallar en el modal
                                                array_push($puntosCompetidor, $puntosObtenidos);
                                            }
                                            //Analizo los puntos, si tiene mas de 0, los incluyo
                                            if($puntosCategoria > 0){
                                    ?>
                                                <!-- Columa de la tabla -->
                                                <tr dni="<?php echo $competidor['dni']; ?>" genero="<?php echo $competidor['genero']; ?>" peso="<?php echo $competidor['peso']; ?>" class="disponible">
                                                    <td style="width: 10%;" class="posicion"><?php echo $contador; ?></td>
                                                    <td style="width: 30%;" class="competidor"><img src="<?php echo $competidor['foto']; ?>" alt="Competidor"> <?php echo $competidor['apellido'] . ',' . $competidor['nombre']; ?></td>
                                                    <td style="width: 25%;" class="club"><?php echo $competidor['club']; ?></td>
                                                    <td style="width: 25%;" class="federacion"><?php echo $competidor['federacion']; ?></td>
                                                    <td style="width: 10%;" class="puntos"><?php echo $puntosCategoria; ?></td>
                                                </tr>
                                                <!-- Modal del usuario -->
                                                <div id="modal-puntos-<?php echo $competidor['dni']; ?>" class="modal-nueva-fecha modal fade bd-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="Competidor" aria-hidden="true">
                                                    <div class="modal-dialog modal-dialog-centered modal-lg">
                                                        <div class="modal-content" style="padding:2rem;">
                                                            <div class="informacion_puntos">
                                                                <button type="button" class="close text-danger" data-dismiss="modal" aria-label="Close" style="font-size:4rem;">
                                                                    <span aria-hidden="true">&times;</span>
                                                                </button>
                                                                <!-- Descripción -->
                                                                <section id="descripcion-administrar-elemento" class="text-center">
                                                                    <h1>PUNTOS DEL USUARIO</h1>
                                                                    <p>
                                                                        A continuación encontrará el detalle de los puntos 
                                                                        que el usuario obtuvo
                                                                    </p>

                                                                    <hr>
                                                                </section>

                                                                <!-- Detalle -->
                                                                <?php 
                                                                    foreach($puntosCompetidor as $puntos){
                                                                        $torneoSeleccionado = null;
                                                                        foreach($torneos as $torneo){
                                                                            if($torneo['id'] == $puntos['torneo']) $torneoSeleccionado = $torneo['nombre'];
                                                                        }
                                                                        if($categoriaSeleccionada == "senior"){
                                                                ?>
                                                                            <li><?php echo $torneoSeleccionado ?>: <?php echo $puntos['puntos_senior']; ?> pts.</li>
                                                                <?php
                                                                        }
                                                                        else if($categoriaSeleccionada == "cadete"){
                                                                ?>
                                                                            <li><?php echo $torneoSeleccionado ?>: <?php echo $puntos['puntos_cadete']; ?> pts.</li>
                                                                <?php
                                                                        }
                                                                        else if($categoriaSeleccionada == "kyuGraduado"){
                                                                ?>
                                                                            <li><?php echo $torneoSeleccionado ?>: <?php echo $puntos['puntos_kyu_graduado']; ?> pts.</li>
                                                                <?php
                                                                        }
                                                                        else if($categoriaSeleccionada == "kyuNovicio"){
                                                                ?>
                                                                            <li><?php echo $torneoSeleccionado ?>: <?php echo $puntos['puntos_kyu_novicio']; ?> pts.</li>
                                                                <?php
                                                                        }
                                                                        else if($categoriaSeleccionada == "infantilB"){
                                                                ?>
                                                                            <li><?php echo $torneoSeleccionado ?>: <?php echo $puntos['puntos_infantil_b']; ?> pts.</li>
                                                                <?php            
                                                                        }
                                                                        else{
                                                                ?>
                                                                            <li><?php echo $torneoSeleccionado ?>: <?php echo $puntos['puntos_senior'] + $puntos['puntos_cadete'] + $puntos['puntos_kyu_graduado'] + $puntos['puntos_kyu_novicio'] + $puntos['puntos_infantil_b'] ?> pts.</li>
                                                                <?php
                                                                        } 
                                                                    }
                                                                ?>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                    <?php
                                            }
                                            $contador++; 
                                        }
                                    ?>
                                </tbody>
                            </table>
                        </div>
                    </div>

                    <br><br><br>
                </section>
        <?php 
            }
            else if($rankingSeleccionado == "club"){ 
        ?>
                <section class="ranking-section ranking-clubes">
                    <!-- DESCRIPCIÓN -->
                    <h2 class="titulo-body">Ranking</h2>
                    <!-- CATEGORIAS -->
                    <div class="categorias container text-center">
                        <div class="row text-center">
                            <a href="ranking.php?ranking=club" class="col-md-12 botonCategoria <?php if(!$categoriaSeleccionada) echo "active"; ?>">Todas las categorías</a>
                        </div>

                        <br>
                        
                        <div class="row text-center">
                            <a href="ranking.php?ranking=club&categoria=senior" class="col-md-2 botonCategoria <?php if($categoriaSeleccionada == "senior") echo "active"; ?>">Senior</a>
                            <a href="ranking.php?ranking=club&categoria=cadete" class="col-md-2 botonCategoria <?php if($categoriaSeleccionada == "cadete") echo "active"; ?>">Cadete</a>
                            <a href="ranking.php?ranking=club&categoria=kyuGraduado" class="col-md-2 botonCategoria <?php if($categoriaSeleccionada == "kyuGraduado") echo "active"; ?>">Kyu Graduado</a>
                            <a href="ranking.php?ranking=club&categoria=kyuNovicio" class="col-md-2 botonCategoria <?php if($categoriaSeleccionada == "kyuNovicio") echo "active"; ?>">Kyu Novicio</a>
                            <a href="ranking.php?ranking=club&categoria=infantilB" class="col-md-2 botonCategoria <?php if($categoriaSeleccionada == "infantilB") echo "active"; ?>">Infantil B</a>
                        </div>
                    </div>

                    <br><br><br>

                    <!-- PESOS Y RANKING -->
                    <div id="tablas-ranking" class="container row text-center">
                        <!-- RANKING -->
                        <div class="tabla-competidores text-center col-md-12">
                            <table id="ranking" ranking="club">
                                <!-- HEADER -->
                                <thead>
                                    <th style="width: 25%;">Puesto</th>
                                    <th style="width: 50%;">
                                        Club <br>
                                        <input id="buscador-competidor" type="search" placeholder="Ingresa el nombre del club..." class="tablesorter-filter" data-column="1" aria-label="Filter &quot;Last Name&quot; column by..." data-lastsearchtime="1585992560956">
                                    </th>
                                    <th style="width: 25%;">Puntos</th>
                                </thead>
                                <!-- BODY -->
                                <tbody>
                                    <?php
                                        $contador = 1;

                                        foreach($clubes as $club){
                                            $nombreClub = $club['club'];
                                            $puntosCategoria = 0;
                                            //Analizo los competidores
                                            foreach($competidores as $posicion => $competidor){
                                                if($competidor['club'] == $club['club']){
                                                    //Cargo los puntos del competidor
                                                    $dniUsuario = $competidor['dni'];
                                                    $cargarPuntos = " SELECT * FROM `puntos-competidor` WHERE usuario = $dniUsuario ";
                                                    $resultadoBD = $con->query($cargarPuntos);
                                                    while($puntosObtenidos = $resultadoBD->fetch_assoc()){
                                                        //Asigno los puntos según la categoría seleccionada
                                                        if($categoriaSeleccionada == "senior") $puntosCategoria += $puntosObtenidos['puntos_senior'];
                                                        else if($categoriaSeleccionada == "cadete") $puntosCategoria += $puntosObtenidos['puntos_cadete'];
                                                        else if($categoriaSeleccionada == "kyuGraduado") $puntosCategoria += $puntosObtenidos['puntos_kyu_graduado'];
                                                        else if($categoriaSeleccionada == "kyuNovicio") $puntosCategoria += $puntosObtenidos['puntos_kyu_novicio'];
                                                        else if($categoriaSeleccionada == "infantilB") $puntosCategoria += $puntosObtenidos['puntos_infantil_b'];
                                                        else $puntosCategoria += ($puntosObtenidos['puntos_senior'] + $puntosObtenidos['puntos_cadete'] + $puntosObtenidos['puntos_kyu_graduado'] + $puntosObtenidos['puntos_kyu_novicio'] + $puntosObtenidos['puntos_infantil_b']);
                                                    }
                                                    unset($competidores[$posicion]);
                                                }    
                                            }
                                            //Analizo los puntos, si tiene mas de 0, los incluyo
                                            if($puntosCategoria > 0){   
                                    ?>
                                                <!-- Columa de la tabla -->
                                                <tr class="disponible">
                                                    <td style="width: 25%;" class="posicion"><?php echo $contador; ?></td>
                                                    <td style="width: 50%;" class="club"><?php echo $nombreClub; ?></td>
                                                    <td style="width: 25%;" class="puntos"><?php echo $puntosCategoria; ?></td>
                                                </tr>
                                    <?php
                                                $contador++; 
                                            }
                                        }
                                    ?>
                                </tbody>
                            </table>
                        </div>
                    </div>

                    <br><br><br>
                </section>
        <?php 
            }
            else if($rankingSeleccionado == "federacion"){
        ?>
                <section class="ranking-section ranking-federaciones">
                    <!-- DESCRIPCIÓN -->
                    <h2 class="titulo-body">Ranking</h2>
                    <!-- CATEGORIAS -->
                    <div class="categorias container text-center">
                        <div class="row text-center">
                            <a href="ranking.php?ranking=federacion" class="col-md-12 botonCategoria <?php if(!$categoriaSeleccionada) echo "active"; ?>">Todas las categorías</a>
                        </div>

                        <br>
                        
                        <div class="row text-center">
                            <a href="ranking.php?ranking=federacion&categoria=senior" class="col-md-2 botonCategoria <?php if($categoriaSeleccionada == "senior") echo "active"; ?>">Senior</a>
                            <a href="ranking.php?ranking=federacion&categoria=cadete" class="col-md-2 botonCategoria <?php if($categoriaSeleccionada == "cadete") echo "active"; ?>">Cadete</a>
                            <a href="ranking.php?ranking=federacion&categoria=kyuGraduado" class="col-md-2 botonCategoria <?php if($categoriaSeleccionada == "kyuGraduado") echo "active"; ?>">Kyu Graduado</a>
                            <a href="ranking.php?ranking=federacion&categoria=kyuNovicio" class="col-md-2 botonCategoria <?php if($categoriaSeleccionada == "kyuNovicio") echo "active"; ?>">Kyu Novicio</a>
                            <a href="ranking.php?ranking=federacion&categoria=infantilB" class="col-md-2 botonCategoria <?php if($categoriaSeleccionada == "infantilB") echo "active"; ?>">Infantil B</a>
                        </div>
                    </div>

                    <br><br><br>

                    <!-- PESOS Y RANKING -->
                    <div id="tablas-ranking" class="container row text-center">
                        <!-- RANKING -->
                        <div class="tabla-competidores text-center col-md-12">
                            <table id="ranking" ranking="federacion">
                                <!-- HEADER -->
                                <thead>
                                    <th style="width: 25%;">Puesto</th>
                                    <th style="width: 50%;">
                                        Federación <br>
                                        <input id="buscador-competidor" type="search" placeholder="Ingresa el nombre de la federación..." data-column="1" aria-label="Filter &quot;Last Name&quot; column by..." data-lastsearchtime="1585992560956">
                                    </th>
                                    <th style="width: 25%;">Puntos</th>
                                </thead>
                                <!-- BODY -->
                                <tbody>
                                    <?php
                                        $contador = 1;

                                        foreach($federaciones as $federacion){
                                            $nombreFederacion = $federacion['federacion'];
                                            $puntosCategoria = 0;
                                            //Analizo los competidores
                                            foreach($competidores as $posicion => $competidor){
                                                if($competidor['federacion'] == $federacion['federacion']){
                                                    //Cargo los puntos del competidor
                                                    $dniUsuario = $competidor['dni'];
                                                    $cargarPuntos = " SELECT * FROM `puntos-competidor` WHERE usuario = $dniUsuario ";
                                                    $resultadoBD = $con->query($cargarPuntos);
                                                    while($puntosObtenidos = $resultadoBD->fetch_assoc()){
                                                        //Asigno los puntos según la categoría seleccionada
                                                        if($categoriaSeleccionada == "senior") $puntosCategoria += $puntosObtenidos['puntos_senior'];
                                                        else if($categoriaSeleccionada == "cadete") $puntosCategoria += $puntosObtenidos['puntos_cadete'];
                                                        else if($categoriaSeleccionada == "kyuGraduado") $puntosCategoria += $puntosObtenidos['puntos_kyu_graduado'];
                                                        else if($categoriaSeleccionada == "kyuNovicio") $puntosCategoria += $puntosObtenidos['puntos_kyu_novicio'];
                                                        else if($categoriaSeleccionada == "infantilB") $puntosCategoria += $puntosObtenidos['puntos_infantil_b'];
                                                        else $puntosCategoria += ($puntosObtenidos['puntos_senior'] + $puntosObtenidos['puntos_cadete'] + $puntosObtenidos['puntos_kyu_graduado'] + $puntosObtenidos['puntos_kyu_novicio'] + $puntosObtenidos['puntos_infantil_b']);
                                                    }
                                                    unset($competidores[$posicion]);
                                                }    
                                            }
                                            //Analizo los puntos, si tiene mas de 0, los incluyo
                                            //if($puntosCategoria > 0){   
                                    ?>
                                                <!-- Columa de la tabla -->
                                                <tr class="disponible">
                                                    <td style="width: 25%;" class="posicion"><?php echo $contador; ?></td>
                                                    <td style="width: 50%;" class="club"><?php echo $nombreFederacion; ?></td>
                                                    <td style="width: 25%;" class="puntos"><?php echo $puntosCategoria; ?></td>
                                                </tr>
                                    <?php
                                                $contador++; 
                                            //}
                                        }
                                    ?>
                                </tbody>
                            </table>
                        </div>
                    </div>

                    <br><br><br>
                </section>
        <?php        
            }
        ?>
        <!-- FOOTER -->
        <?php include 'templates/footer.php' ?>
        <!-- SCRIPTS -->
        <?php include 'templates/scripts.php' ?>
    </body>

</html>