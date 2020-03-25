<?php
    session_start();
    if($_SESSION['logueado'] == 1) echo '<meta http-equiv="refresh" content="0; url=index.php">';
?>

<!DOCTYPE html>
<html lang="es">
    <?php include 'templates/head.php' ?>

    <body id="admin-login">
        <!-- Header -->
        <section id="header" class="d-flex justify-content-center align-items-center">
            <a href="../index.php">VOLVER</a>
        </section>
        <!-- Cuadro de logueo -->
        <section id="login" class="d-flex justify-content-center align-items-center">
            <div class="caja">
                <div class="header text-center">
                    <img src="../img/logo.png" alt="Torneo Interfederativo de Judo">
                    <h1>INICIAR SESIÓN</h1>
                </div>

                <hr class="separador">

                <div class="formulario-logueo text-center">
                    <form id="formulario-login" action="index.php">
                        <input class="text text-center" id="username" type="text" placeholder="NOMBRE DE USUARIO" required>
                        <input class="pass text-center" id="password" type="text" placeholder="CONTRASEÑA" required>
                        <input class="submit-white" type="submit" value="INGRESAR">
                    </form>
                </div>
            </div>
        </section>
        <!-- Footer -->
        <footer id="footer-login" class="d-flex justify-content-center align-items-center">
            <div class="text-center spam">
                <a href="https://smtecnology.store" target="_blank">Diseño Web by <span class="smt">SMT</span></a>
            </div>
        </footer>
    </body>

    <?php include 'templates/scripts.php' ?>
</html>