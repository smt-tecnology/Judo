<?php 
    $accion = $_POST['accion'];
    require('../conexion.php');

    if($accion == "inscribir-torneo"){
        $tipoInscripcion = $_POST['tipo-inscripcion'];
        if($tipoInscripcion == "competidor-registrado"){
            //Paso los datos ingresados por el usuario por un filtro para evitar codigo malo
            $dni = filter_var($_POST['dni'], FILTER_SANITIZE_NUMBER_INT);
            $torneo = filter_var($_POST['torneo'], FILTER_SANITIZE_NUMBER_INT);
            //Verifico que el usuario exista
            try {
                $cargarUsuario = " SELECT * FROM competidores WHERE dni = $dni ";
                $resultadoBD = $con->query($cargarUsuario);
                $usuarioObtenido = $resultadoBD->fetch_assoc();

                if($usuarioObtenido){
                    $nombre = $usuarioObtenido['nombre'];
                    $apellido = $usuarioObtenido['apellido'];
                    $club = $usuarioObtenido['club'];
                    $peso = $usuarioObtenido['peso'];
                    $categoria = $usuarioObtenido['categoria'];
                }
                else{
                    $respuesta = array(
                        'respuesta' => 'usuario_no_registrado'
                    );
                }
            } catch (\Exception $e) {
                $respuesta = array(
                    'error' => $e->getMessage()
                );
            }
            if($nombre && $apellido && $club && $peso && $categoria){
                //Intento hacer la operación en la base de datos
                try {
                    $stmt = $con->prepare('INSERT INTO `inscripciones-torneo` (torneo, nombre, apellido, club, peso, categoria) VALUES (?, ?, ?, ?, ?, ?)');
                    $stmt->bind_param('isssis', $torneo, $nombre, $apellido, $club, $peso, $categoria);
                    $stmt->execute();
                    if($stmt->affected_rows > 0){
                        $respuesta = array(
                            'respuesta' => 'inscripcion_realizada',
                            'nombre' => $nombre,
                            'apellido' => $apellido,
                            'club' => $club,
                            'peso' => $peso,
                            'categoria' => $categoria
                        );
                    }
                    else{
                        $respuesta = array(
                            'respuesta' => 'competidor_fallido'
                        ); 
                    }
                    
                    $stmt->close();
                    $con->close();
                } catch (Exception $e) {
                    $respuesta = array(
                        'error' => $e->getMessage()
                    );
                }
            }
        }
        else if($tipoInscripcion == "competidor-no-registrado"){
            //Paso los datos ingresados por el usuario por un filtro para evitar codigo malo
            $nombre = filter_var($_POST['nombre'], FILTER_SANITIZE_STRING);
            $apellido = filter_var($_POST['apellido'], FILTER_SANITIZE_STRING);
            $club = filter_var($_POST['club'], FILTER_SANITIZE_STRING);
            $peso = filter_var($_POST['peso'], FILTER_SANITIZE_NUMBER_INT);
            $categoria = filter_var($_POST['categoria'], FILTER_SANITIZE_STRING);
            $torneo = filter_var($_POST['torneo'], FILTER_SANITIZE_NUMBER_INT);
            //Intento hacer la operación en la base de datos
            try {
                $stmt = $con->prepare('INSERT INTO `inscripciones-torneo` (torneo, nombre, apellido, club, peso, categoria) VALUES (?, ?, ?, ?, ?, ?)');
                $stmt->bind_param('isssis', $torneo, $nombre, $apellido, $club, $peso, $categoria);
                $stmt->execute();
                if($stmt->affected_rows > 0){
                    $respuesta = array(
                        'respuesta' => 'inscripcion_realizada',
                        'nombre' => $nombre,
                        'apellido' => $apellido,
                        'club' => $club,
                        'peso' => $peso,
                        'categoria' => $categoria
                    );
                }
                else{
                    $respuesta = array(
                        'respuesta' => 'competidor_fallido'
                    ); 
                }
        
                $stmt->close();
                $con->close();
            } catch (Exception $e) {
                $respuesta = array(
                    'error' => $e->getMessage()
                );
            }
        }
        else if($tipoInscripcion == "club"){
            //Paso los datos ingresados por el usuario por un filtro para evitar codigo malo
            $club = filter_var($_POST['nombre-club'], FILTER_SANITIZE_STRING);
            $telefono = filter_var($_POST['telefono-club'], FILTER_SANITIZE_STRING);
            $email = filter_var($_POST['email-club'], FILTER_SANITIZE_STRING);
            
            $nombre = filter_var($_POST['nombre'], FILTER_SANITIZE_STRING);
            $apellido = filter_var($_POST['apellido'], FILTER_SANITIZE_STRING);
            $peso = filter_var($_POST['peso'], FILTER_SANITIZE_NUMBER_INT);
            $categoria = filter_var($_POST['categoria'], FILTER_SANITIZE_STRING);
            
            $torneo = filter_var($_POST['torneo'], FILTER_SANITIZE_NUMBER_INT);
            //Intento hacer la operación en la base de datos
            try {
                $stmt = $con->prepare('INSERT INTO `inscripciones-torneo` (torneo, nombre, apellido, club, email_club, telefono_club, peso, categoria) VALUES (?, ?, ?, ?, ?, ?, ?, ?)');
                $stmt->bind_param('isssssis', $torneo, $nombre, $apellido, $club, $email, $telefono, $peso, $categoria);
                $stmt->execute();
                if($stmt->affected_rows > 0){
                    $respuesta = array(
                        'respuesta' => 'inscripcion_realizada',
                        'nombre' => $nombre,
                        'apellido' => $apellido,
                        'club' => $club,
                        'email-club' => $email,
                        'telefono-club' => $telefono,
                        'peso' => $peso,
                        'categoria' => $categoria
                    );
                }
                else{
                    $respuesta = array(
                        'respuesta' => 'club_fallido'
                    ); 
                }
        
                $stmt->close();
                $con->close();
            } catch (Exception $e) {
                $respuesta = array(
                    'error' => $e->getMessage()
                );
            }
        }
    }

    echo json_encode($respuesta);
?>