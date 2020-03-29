<!DOCTYPE html>
<html lang="en">
<?php include 'templates/head.php' ?>

<body>
    <!-- HEADER -->
    <?php include 'templates/header.php' ?>

    <section class="torneos">
        <h2 class="titulo-body">Torneos</h2>
        <div id="demo" class="carousel slide" data-ride="carousel">

            <!-- Indicators -->
            <ul class="carousel-indicators" style="margin-bottom:0">
                <li data-target="#demo" data-slide-to="0" class="active"></li>
                <li data-target="#demo" data-slide-to="1"></li>

            </ul>

            <!-- The slideshow -->
            <div class="carousel-inner">
                <div class="carousel-item active ">
                    <div class="Torneo">
                        <h3>Nombre del Torneo</h3>
                        <br>
                        <h5>Categorias</h5>
                        <p>XX/XX/XX - 21:00hrs.</p>

                        <ul class="listabotones">
                            <li><a href="calendario.php">Calendario</a></li>
                            <li><a href="">Ver Reglas</a></li>
                        </ul>
                    </div>
                </div>
                <div class="carousel-item">
                    <div class="Torneo">
                        <h3>Nombre del Torneo</h3>
                        <br>
                        <h5>Categorias</h5>
                        <p>XX/XX/XX - 21:00hrs.</p>

                        <ul class="listabotones">
                            <li><a href="calendario.php">Calendario</a></li>
                            <li><a href="">Ver Reglas</a></li>
                        </ul>
                    </div>
                </div>
            </div>

            <!-- Left and right controls -->
            <a class="carousel-control-prev " href="#demo" data-slide="prev">
                <span class="carousel-control-prev-icon prev"></span>
            </a>
            <a class="carousel-control-next " href="#demo" data-slide="next">
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

    </section>
    <br><br><br>
    <!-- FOOTER -->
    <?php include 'templates/footer.php' ?>

</body>
<?php include 'templates/scripts.php' ?>

</html>