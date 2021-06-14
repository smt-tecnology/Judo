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
                        <a href="parches.php"><img src="img/Federaciones/bonaerense.png" alt="Federación Bonaerense de Judo"></a>
                        <p class="federacion">Federación Bonaerense de Judo</p>
                    </div>
                    <div class="federacion col-md-4 col-lg-4">
                        <a href="parches.php"><img src="img/Federaciones/metropolitana.jpg" alt="Federación Metropolitana de Judo"></a>
                        <p>Federación Metropolitana de Judo</p>
                    </div>
                    <div class="federacion faij  col-md-4 col-lg-4">
                        <a href="parches.php"><img src="img/Federaciones/faij.jpg" alt="Federación Argentina Intercolegial de Judo"></a>
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
                    <li data-target="#index-carousel" data-slide-to="2"></li>
                    <li data-target="#index-carousel" data-slide-to="3"></li>
                    <li data-target="#index-carousel" data-slide-to="4"></li>
                    <li data-target="#index-carousel" data-slide-to="5"></li>
                    <li data-target="#index-carousel" data-slide-to="6"></li>
                    <li data-target="#index-carousel" data-slide-to="7"></li>
                    <li data-target="#index-carousel" data-slide-to="8"></li>
                    <li data-target="#index-carousel" data-slide-to="9"></li>
                </ul>
                <!-- SLIDES -->
                <div class="carousel-inner imagen-galeria">
                    <!-- Slide 1 -->
                    <div class="carousel-item active ">
                        <img src="img/Slides-Index/1.jpg" alt="Competencias de Judo">
                        <!-- <div class="carousel-caption">
                            <h3 class="club-galeria overlay">Club</h3>
                        </div> -->
                    </div>
                    <!-- Slide 2 -->
                    <div class="carousel-item">
                        <img src="img/Slides-Index/2.jpg" alt="Competencias de Judo">
                        <!-- <div class="carousel-caption">
                            <h3 class="club-galeria overlay">Club </h3>
                        </div> -->
                    </div>
                    <!-- Slide 3 -->
                    <div class="carousel-item">
                        <img src="img/Slides-Index/3.jpg" alt="Competencias de Judo">
                        <!-- <div class="carousel-caption">
                            <h3 class="club-galeria overlay">Club </h3>
                        </div> -->
                    </div>
                    <!-- Slide 4 -->
                    <div class="carousel-item">
                        <img src="img/Slides-Index/4.jpg" alt="Competencias de Judo">
                        <!-- <div class="carousel-caption">
                            <h3 class="club-galeria overlay">Club </h3>
                        </div> -->
                    </div>
                    <!-- Slide 5 -->
                    <div class="carousel-item">
                        <img src="img/Slides-Index/5.jpg" alt="Competencias de Judo">
                        <!-- <div class="carousel-caption">
                            <h3 class="club-galeria overlay">Club </h3>
                        </div> -->
                    </div>
                    <!-- Slide 6 -->
                    <div class="carousel-item">
                        <img src="img/Slides-Index/6.jpg" alt="Competencias de Judo">
                        <!-- <div class="carousel-caption">
                            <h3 class="club-galeria overlay">Club </h3>
                        </div> -->
                    </div>
                    <!-- Slide 7 -->
                    <div class="carousel-item">
                        <img src="img/Slides-Index/7.jpg" alt="Competencias de Judo">
                        <!-- <div class="carousel-caption">
                            <h3 class="club-galeria overlay">Club </h3>
                        </div> -->
                    </div>
                    <!-- Slide 8 -->
                    <div class="carousel-item">
                        <img src="img/Slides-Index/8.jpg" alt="Competencias de Judo">
                        <!-- <div class="carousel-caption">
                            <h3 class="club-galeria overlay">Club </h3>
                        </div> -->
                    </div>
                    <!-- Slide 9 -->
                    <div class="carousel-item">
                        <img src="img/Slides-Index/9.jpeg" alt="Competencias de Judo">
                        <!-- <div class="carousel-caption">
                            <h3 class="club-galeria overlay">Club </h3>
                        </div> -->
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
                    <div class=" col-12 col-sm-12 col-md-8 videos text-center" style="display: block;margin: 0 auto;">
                        <iframe width="560" height="315" src="https://www.youtube.com/embed/SJZ2Hk7Fu_o" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
                    </div>
                </div>
            </div>

            <br><br><br>
        </section>
        <!-- INSCRIPCIONES / seccion eliminada -->
        <!--
        <section class="inscripciones">
            <div class="container">
                <h2 class="titulo-body">Inscripciones</h2>
                <p class="inscripciones-parrafo">¿Deseas participar en nuestro ranking? Haz click en el siguiente botón y completa el formulario para que podamos evaluar tu solicitud.</p>
                <div class="text-center boton-inscripcion">
                    <a href="inscripciones.php">Inscripción</a>
                </div>
            </div>

            <br><br><br>
        </section>
        -->

        <!-- PARCHES-->
        
        <section class="parches">
            <!-- TITULO SECCION -->
            <div class="container">
                <div class="row text-center">
                    <!-- parches -->
                    <div class="federacion col-md-4 col-lg-4">
                        <a href="parches.php"><img src="img/Parches/bon-cuerpo.jpeg" alt="BON"></a>
                        
                    </div>
                    <div class="federacion col-md-4 col-lg-4">
                        <a href="parches.php"><img src="img/Parches/met-cuerpo.jpeg" alt="MET"></a>
                        
                    </div>
                    <div class="federacion faij  col-md-4 col-lg-4">
                        <a href="parches.php"><img src="img/Parches/int-cuerpo.jpeg" alt="BON"></a>
                        
                    </div>
                </div>
            </div>
        </section>



        <!-- FOOTER -->
        <?php include 'templates/footer.php' ?>
        <!-- SCRIPTS -->
        <?php include 'templates/scripts.php' ?>
    </body>

</html>