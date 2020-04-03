<!DOCTYPE html>
<html lang="es">

    <!-- HEAD -->
    <?php include 'templates/head.php' ?>

    <body>
        <!-- HEADER -->
        <?php include 'templates/header.php' ?>
        <!-- SECCION FEDERACIONES-->
        <section class="federaciones">
            <!-- TITULO SECCION -->
            <h2 class="titulo-body">Federaciones</h2>
            <div class="container">
                <div class="row text-center">
                    <!-- FEDERACIONES -->
                    <div class="federacion col-md-4 col-lg-4">
                        <a href=""><img src="img/b.png" alt="Federación Bonaerense de Judo"></a>
                        <p class="federacion">Federación Bonaerense de Judo</p>
                    </div>
                    <div class="federacion col-md-4 col-lg-4">
                        <a href=""><img src="img/a.jpg" alt="Federación Metropolitana de Judo"></a>
                        <p>Federación Metropolitana de Judo</p>
                    </div>
                    <div class="federacion faij  col-md-4 col-lg-4">
                        <a href=""><img src="img/faij.jpg" alt="Federación Argentina Intercolegial de Judo"></a>
                        <p>Federación Argentina Intercolegial de Judo</p>
                    </div>
                </div>
            </div>
        </section>
        <!-- SECCION GALERIA -->
        <section class="galeria">
            <!-- GALERIA SLIDER -->
            <div id="index-carousel" class="carousel slide" data-ride="carousel">
                <!-- SIMBOLOS -->
                <ul class="carousel-indicators">
                    <li data-target="#index-carousel" data-slide-to="0" class="active"></li>
                    <li data-target="#index-carousel" data-slide-to="1"></li>
                </ul>
                <!-- SLIDES -->
                <div class="carousel-inner imagen-galeria">
                    <div class="carousel-item active ">
                        <img src="img/2.png" alt="Los Angeles">
                        <div class="carousel-caption">
                            <h3 class="club-galeria overlay">Club</h3>
                        </div>
                    </div>
                    <div class="carousel-item">
                        <img src="img/3.png" alt="Chicago">
                        <div class="carousel-caption">
                            <h3 class="club-galeria overlay">Club </h3>
                        </div>
                    </div>
                </div>
                <!-- CONTROLES -->
                <a class="carousel-control-prev " href="#index-carousel" data-slide="prev">
                    <span class="carousel-control-prev-icon prev"></span>
                </a>
                <a class="carousel-control-next " href="#index-carousel" data-slide="next">
                    <span class="carousel-control-next-icon next"></span>
                </a>
            </div>
            <!-- FIN GALERIA SLIDER -->
            <br>

            <!-- VIDEOS -->
            <div class="container text-center">
                <div class="row">
                    <div class=" col-12 col-sm-12 col-md-6 videos">
                        <iframe width="560" height="315" src="https://www.youtube.com/embed/0Jihou2IwGM" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
                    </div>
                    <div class="col-sm-12 col-md-6 videos">
                        <iframe width="560" height="315" src="https://www.youtube.com/embed/0Jihou2IwGM" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
                    </div>
                </div>
            </div>

            <br><br><br>
        </section>
        <!-- INSCRIPCIONES -->
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