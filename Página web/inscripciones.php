<!DOCTYPE html>
<html lang="en">
<?php include 'templates/head.php' ?>

<body>
    <!-- HEADER -->
    <?php include 'templates/header.php' ?>

    <section class="inscripcion">
        <h2 class="titulo-body">Inscripciones</h2>
        <div class="container">

            <p class="inscripciones-parrafo text-center">¿Deseas participar en uno de nuestros torneos? Completa el siguiente formulario detalladamente y evaluaremos tu solicitud.</p>

            <p class="informacion">Información Principal</p>

            <form action="">
                <div class="col-sm-12 col-md-4 name ">
                    <input class="formulario" name="nombre" type="text" placeholder="Nombre">
                </div>
                <div class="col-sm-12 col-md-4 name ">
                    <input class="formulario" name="apellido" type="text" placeholder="Apellido">
                </div>
                <div class="col-sm-12 col-md-4 name ">
                    <input class="formulario" name="dni" type="text" placeholder="Número de DNI">
                </div>
                <div class="col-sm-12 col-md-4 name ">
                    <input class="formulario" name="email" type="text" placeholder="Correo Electrónico">
                </div>

                <h2 class="titulo-body">Género</h2>
                <div class="radio">
                    <ul class="lista-generos">
                        <li><input type="radio" name="genero">Masculino</li>
                        <li><input type="radio" name="genero">Femenino</li>
                    </ul>
                </div>
                <h2 class="titulo-body">&nbspFecha de Nacimiento</h2>
                <div class="row fechaNa">
                    <div class=" col-4 col-lg-2 input-fechaNa">
                        <input class="fecha" name="dia" type="text" placeholder="Día">
                    </div>
                    <div class="col-4 col-lg-2 input-fechaNa">
                        <input class="fecha" name="mes" type="text" placeholder="Mes">
                    </div>
                    <div class="col-4 col-lg-2 input-fechaNa">
                        <input class="fecha" name="year" type="text" placeholder="Año">
                    </div>

                </div>
                <br>
                <h2 class="titulo-body">&nbspNúmero de Telefono</h2>
                <div class="row fechaNa">
                    <div class="col-3 col-lg-2 input-fechaNa">
                        <input class="fecha" name="area" type="text" placeholder="C.Area">
                    </div>
                    <div class="col-7 col-lg-4 input-fechaNa">
                        <input class="fecha" name="telefono" type="text" placeholder="Telefono">
                    </div>
                </div>
                <br>
                <div class="col-sm-12 col-md-4 name subir ">
                    <a class="" href="">Subir una Foto</a>
                </div>
                <br>
                <p class="informacion">Información Deportiva</p>

                <div class="col-sm-12 col-md-4 name ">
                    <input class="formulario" name="email" type="text" placeholder="Federación">
                </div>
                <div class="col-sm-12 col-md-4 name ">
                    <input class="formulario" name="email" type="text" placeholder="Club">
                </div>
                <h2 class="titulo-body">Categoría</h2>
                <div class="radio">
                    <ul class="lista-categorias">
                        <li><input type="radio" name="categoria">Senior</li>
                        <li><input type="radio" name="categoria">Cadete</li>

                    </ul>
                    <ul class="lista-categorias">
                        <li><input type="radio" name="categoria">Kyu Graduado</li>
                        <li><input type="radio" name="categoria">Kyu Novicio</li>
                        <li><input type="radio" name="categoria">Infantil B</li>
                    </ul>
                </div>
                <div class="col-sm-12 col-md-4 name subir ">
                    <a href="">Inscribirme</a>
                </div>
                <br>







            </form>











        </div>





    </section>
    </section>
    <!-- FOOTER -->
    <?php include 'templates/footer.php' ?>

</body>
<?php include 'templates/scripts.php' ?>

</html>