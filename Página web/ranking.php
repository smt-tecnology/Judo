<?php 
    $categoriaSeleccionada = $_GET['categoria'];
    $pesoSeleccionado = $_GET['peso'];
    $generoSeleccionado = $_GET['genero'];

    require('administracion/db/conexion.php');
    //COMPETIDORES
    if($pesoSeleccionado){
        $cargarCompetidor = " SELECT * FROM competidores WHERE peso <= $pesoSeleccionado AND genero = '$generoSeleccionado' ";
        $resultadoBD = $con->query($cargarCompetidor);
    }
    else{
        $cargarCompetidor = " SELECT * FROM competidores ";
        $resultadoBD = $con->query($cargarCompetidor);
    }

    $competidores = array();
    while($competidoresObtenidos = $resultadoBD->fetch_assoc()) {
        array_push($competidores, $competidoresObtenidos);
    }
?>

<!DOCTYPE html>
<html lang="en">

    <?php include 'templates/head.php' ?>

    <body>
        <!-- HEADER -->
        <?php include 'templates/header.php' ?>
        <!-- RANKING -->
        <section class="ranking-section">
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
                                    <tr>
                                        <td style="width: 50%;">-60</td>
                                        <td style="width: 50%;">-48</td>
                                    </tr>
                                    <tr>
                                        <td style="width: 50%;">-66</td>
                                        <td style="width: 50%;">-52</td>
                                    </tr>
                                    <tr>
                                        <td style="width: 50%;">-73</td>
                                        <td style="width: 50%;">-57</td>
                                    </tr>
                                    <tr>
                                        <td style="width: 50%;">-81</td>
                                        <td style="width: 50%;">-63</td>
                                    </tr>
                                    <tr>
                                        <td style="width: 50%;">-90</td>
                                        <td style="width: 50%;">-70</td>
                                    </tr>
                                    <tr>
                                        <td style="width: 50%;">-100</td>
                                        <td style="width: 50%;">-78</td>
                                    </tr>
                                    <tr>
                                        <td style="width: 50%;">+100</td>
                                        <td style="width: 50%;">+78</td>
                                    </tr>
                                </tbody>
                        <?php 
                            }
                            else if($categoriaSeleccionada == "cadete"){
                        ?>
                                <tbody class="pesos-cadete">
                                    <tr>
                                        <td style="width: 50%;">-50</td>
                                        <td style="width: 50%;">-40</td>
                                    </tr>
                                    <tr>
                                        <td style="width: 50%;">-55</td>
                                        <td style="width: 50%;">-44</td>
                                    </tr>
                                    <tr>
                                        <td style="width: 50%;">-60</td>
                                        <td style="width: 50%;">-48</td>
                                    </tr>
                                    <tr>
                                        <td style="width: 50%;">-66</td>
                                        <td style="width: 50%;">-52</td>
                                    </tr>
                                    <tr>
                                        <td style="width: 50%;">-73</td>
                                        <td style="width: 50%;">-57</td>
                                    </tr>
                                    <tr>
                                        <td style="width: 50%;">-81</td>
                                        <td style="width: 50%;">-63</td>
                                    </tr>
                                    <tr>
                                        <td style="width: 50%;">-90</td>
                                        <td style="width: 50%;">-70</td>
                                    </tr>
                                    <tr>
                                        <td style="width: 50%;">+90</td>
                                        <td style="width: 50%;">+70</td>
                                    </tr>
                                </tbody>
                        <?php 
                            }
                            else if($categoriaSeleccionada == "kyuGraduado" || $categoriaSeleccionada == "kyuNovicio"){
                        ?>
                                <tbody class="pesos-kyu-graduado">
                                    <tr>
                                        <td style="width: 50%;">-55</td>
                                        <td style="width: 50%;">-48</td>
                                    </tr>
                                    <tr>
                                        <td style="width: 50%;">-60</td>
                                        <td style="width: 50%;">-52</td>
                                    </tr>
                                    <tr>
                                        <td style="width: 50%;">-66</td>
                                        <td style="width: 50%;">-57</td>
                                    </tr>
                                    <tr>
                                        <td style="width: 50%;">-73</td>
                                        <td style="width: 50%;">-63</td>
                                    </tr>
                                    <tr>
                                        <td style="width: 50%;">-81</td>
                                        <td style="width: 50%;">-70</td>
                                    </tr>
                                    <tr>
                                        <td style="width: 50%;">-90</td>
                                        <td style="width: 50%;">-78</td>
                                    </tr>
                                    <tr>
                                        <td style="width: 50%;">-100</td>
                                    </tr>
                                    <tr>
                                        <td style="width: 50%;">+100</td>
                                    </tr>
                                </tbody>   
                        <?php 
                            }
                            else if($categoriaSeleccionada == "infantilB"){
                        ?>
                                <tbody class="pesos-infantil-b">
                                    <tr>
                                        <td style="width: 50%;">-36</td>
                                        <td style="width: 50%;">-36</td>
                                    </tr>
                                    <tr>
                                        <td style="width: 50%;">-40</td>
                                        <td style="width: 50%;">-40</td>
                                    </tr>
                                    <tr>
                                        <td style="width: 50%;">-44</td>
                                        <td style="width: 50%;">-44</td>
                                    </tr>
                                    <tr>
                                        <td style="width: 50%;">-48</td>
                                        <td style="width: 50%;">-48</td>
                                    </tr>
                                    <tr>
                                        <td style="width: 50%;">-53</td>
                                        <td style="width: 50%;">-53</td>
                                    </tr>
                                    <tr>
                                        <td style="width: 50%;">-58</td>
                                        <td style="width: 50%;">-58</td>
                                    </tr>
                                    <tr>
                                        <td style="width: 50%;">-64</td>
                                        <td style="width: 50%;">-64</td>
                                    </tr>
                                    <tr>
                                        <td style="width: 50%;">+64</td>
                                        <td style="width: 50%;">+64</td>
                                    </tr>
                                </tbody>
                        <?php 
                            }
                            else{
                        ?>
                                <tbody class="pesos-general">
                                    <tr>
                                        <td style="width: 50%;">-36</td>
                                        <td style="width: 50%;">-36</td>
                                    </tr>
                                    <tr>
                                        <td style="width: 50%;">-40</td>
                                        <td style="width: 50%;">-40</td>
                                    </tr>
                                    <tr>
                                        <td style="width: 50%;">-44</td>
                                        <td style="width: 50%;">-44</td>
                                    </tr>
                                    <tr>
                                        <td style="width: 50%;">-48</td>
                                        <td style="width: 50%;">-48</td>
                                    </tr>
                                    <tr>
                                        <td style="width: 50%;">-50</td>
                                        <td style="width: 50%;">-52</td>
                                    </tr>
                                    <tr>
                                        <td style="width: 50%;">-53</td>
                                        <td style="width: 50%;">-53</td>
                                    </tr>
                                    <tr>
                                        <td style="width: 50%;">-55</td>
                                        <td style="width: 50%;">-57</td>
                                    </tr>
                                    <tr>
                                        <td style="width: 50%;">-58</td>
                                        <td style="width: 50%;">-58</td>
                                    </tr>
                                    <tr>
                                        <td style="width: 50%;">-60</td>
                                        <td style="width: 50%;">-63</td>
                                    </tr>
                                    <tr>
                                        <td style="width: 50%;">-64</td>
                                        <td style="width: 50%;">-64</td>
                                    </tr>
                                    <tr>
                                        <td style="width: 50%;">-66</td>
                                        <td style="width: 50%;">-70</td>
                                    </tr>
                                    <tr>
                                        <td style="width: 50%;">-73</td>
                                        <td style="width: 50%;">-78</td>
                                    </tr>
                                    <tr>
                                        <td style="width: 50%;">-81</td>
                                        <td style="width: 50%;">-70</td>
                                    </tr>
                                    <tr>
                                        <td style="width: 50%;">-90</td>
                                        <td style="width: 50%;">-78</td>
                                    </tr>
                                    <tr>
                                        <td style="width: 50%;">-100</td>
                                        <td style="width: 50%;">+78</td>
                                    </tr>
                                    <tr>
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
                    <table id="ranking">
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
                                    $puntosCompetidor = $resultadoBD->fetch_assoc();
                                    //Asigno los puntos según la categoría seleccionada
                                    if($categoriaSeleccionada == "senior") $puntosCategoria = $puntosCompetidor['puntos_senior'];
                                    else if($categoriaSeleccionada == "cadete") $puntosCategoria = $puntosCompetidor['puntos_cadete'];
                                    else if($categoriaSeleccionada == "kyuGraduado") $puntosCategoria = $puntosCompetidor['puntos_kyu_graduado'];
                                    else if($categoriaSeleccionada == "kyuNovicio") $puntosCategoria = $puntosCompetidor['puntos_kyu_novicio'];
                                    else if($categoriaSeleccionada == "infantilB") $puntosCategoria = $puntosCompetidor['puntos_infantil_b'];
                                    else $puntosCategoria = $puntosCompetidor['puntos_senior'] + $puntosCompetidor['puntos_cadete'] + $puntosCompetidor['puntos_kyu_graduado'] + $puntosCompetidor['puntos_kyu_novicio'] + $puntosCompetidor['puntos_infantil_b'];
                                    //Analizo los puntos, si tiene mas de 0, los incluyo
                                    if($puntosCategoria > 0){
                            ?>
                                        <tr genero="<?php echo $competidor['genero']; ?>" peso="<?php echo $competidor['peso']; ?>">
                                            <td style="width: 10%;" class="posicion"><?php echo $contador; ?></td>
                                            <td style="width: 30%;" class="competidor"><img src="<?php echo $competidor['foto']; ?>" alt="Competidor"> <?php echo $competidor['apellido'] . ',' . $competidor['nombre']; ?></td>
                                            <td style="width: 25%;" class="club"><?php echo $competidor['club']; ?></td>
                                            <td style="width: 25%;" class="federacion"><?php echo $competidor['federacion']; ?></td>
                                            <td style="width: 10%;" class="puntos"><?php echo $puntosCategoria; ?></td>
                                        </tr>
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
        <!-- FOOTER -->
        <?php include 'templates/footer.php' ?>
        <!-- SCRIPTS -->
        <?php include 'templates/scripts.php' ?>
    </body>

</html>