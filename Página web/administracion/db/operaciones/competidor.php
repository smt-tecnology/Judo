<?php 
    $accion = $_POST['accion'];
    require('../conexion.php');

    if($accion == "crear"){
        //Paso los datos ingresados por el usuario por un filtro para evitar codigo malo
        $nombre = filter_var($_POST['nombre'], FILTER_SANITIZE_STRING);
        $apellido = filter_var($_POST['apellido'], FILTER_SANITIZE_STRING);
        $dni = filter_var($_POST['dni'], FILTER_SANITIZE_NUMBER_INT);
        $email = filter_var($_POST['email'], FILTER_SANITIZE_STRING);
        $telefono = filter_var($_POST['telefono'], FILTER_SANITIZE_STRING);
        $genero = filter_var($_POST['genero'], FILTER_SANITIZE_STRING);
        $nacimiento = filter_var($_POST['nacimiento'], FILTER_SANITIZE_STRING);
        $federacion = filter_var($_POST['federacion'], FILTER_SANITIZE_STRING);
        $club = filter_var($_POST['club'], FILTER_SANITIZE_STRING);
        $peso = filter_var($_POST['peso'], FILTER_SANITIZE_NUMBER_INT);
        $categoria = filter_var($_POST['categoria'], FILTER_SANITIZE_STRING);
        //Intento hacer la operación en la base de datos
        try {
            if($_FILES['foto']['type'] == 'image/png' || $_FILES['foto']['type'] == 'image/jpg' || $_FILES['foto']['type'] == 'image/jpeg'){
                //Obtengo el tipo de archivo
                $separadorTipo = strpos($_FILES['foto']['type'], '/');
                $extensionArchivo = substr($_FILES['foto']['type'], $separadorTipo+1);
                //Configuro el directorio y la muevo
                $directorio = '../../../img/Competidores/';
                if(move_uploaded_file($_FILES['foto']['tmp_name'], $directorio . $nombre . $apellido . '.' . $extensionArchivo)){
                    $urlImagen = "img/Competidores/" . $nombre . $apellido . '.' . $extensionArchivo;
                    $stmt = $con->prepare('INSERT INTO competidores (nombre, apellido, genero, nacimiento, email, dni, telefono, foto, federacion, club, peso, categoria) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)');
                    $stmt->bind_param('sssssissssis', $nombre, $apellido, $genero, $nacimiento, $email, $dni, $telefono, $urlImagen, $federacion, $club, $peso, $categoria);
                }
            }
            $stmt->execute();
            if($stmt->affected_rows > 0){
                $respuesta = array(
                    'respuesta' => 'competidor_creado',
                    'nombre' => $nombre,
                    'apellido' => $apellido
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
    else if($accion == "editar"){
        //Paso los datos ingresados por el usuario por un filtro para evitar codigo malo
        $id = filter_var($_POST['id'], FILTER_SANITIZE_NUMBER_INT);
        $nombre = filter_var($_POST['nombre'], FILTER_SANITIZE_STRING);
        $apellido = filter_var($_POST['apellido'], FILTER_SANITIZE_STRING);
        $dni = filter_var($_POST['dni'], FILTER_SANITIZE_NUMBER_INT);
        $email = filter_var($_POST['email'], FILTER_SANITIZE_STRING);
        $telefono = filter_var($_POST['telefono'], FILTER_SANITIZE_STRING);
        $genero = filter_var($_POST['genero'], FILTER_SANITIZE_STRING);
        $nacimiento = filter_var($_POST['nacimiento'], FILTER_SANITIZE_STRING);
        $federacion = filter_var($_POST['federacion'], FILTER_SANITIZE_STRING);
        $club = filter_var($_POST['club'], FILTER_SANITIZE_STRING);
        $peso = filter_var($_POST['peso'], FILTER_SANITIZE_NUMBER_INT);
        $categoria = filter_var($_POST['categoria'], FILTER_SANITIZE_STRING);
        //Intento hacer la operación en la base de datos
        
        try {
            if(isset($_FILES['foto'])){
                if($_FILES['foto']['type'] == 'image/png' || $_FILES['foto']['type'] == 'image/jpg' || $_FILES['foto']['type'] == 'image/jpeg'){
                    //Obtengo el tipo de archivo
                    $separadorTipo = strpos($_FILES['foto']['type'], '/');
                    $extensionArchivo = substr($_FILES['foto']['type'], $separadorTipo+1);
                    //Configuro el directorio y la muevo
                    $directorio = '../../../img/Competidores/';
                    if(move_uploaded_file($_FILES['foto']['tmp_name'], $directorio . $nombre . $apellido . '.' . $extensionArchivo)){
                        $urlImagen = "img/Competidores/" . $nombre . $apellido . '.' . $extensionArchivo;
                        $stmt = $con->prepare('UPDATE competidores SET nombre = ?, apellido = ?, genero = ?, nacimiento = ?, email = ?, dni = ?, telefono = ?, foto = ?, federacion = ?, club = ?, peso = ?, categoria = ? WHERE dni = ?');
                        $stmt->bind_param('sssssissssisi', $nombre, $apellido, $genero, $nacimiento, $email, $dni, $telefono, $urlImagen, $federacion, $club, $peso, $categoria, $id);
                    }
                }
            }
            else{
                $stmt = $con->prepare('UPDATE competidores SET nombre = ?, apellido = ?, genero = ?, nacimiento = ?, email = ?, dni = ?, telefono = ?, federacion = ?, club = ?, peso = ?, categoria = ? WHERE dni = ?');
                $stmt->bind_param('sssssisssisi', $nombre, $apellido, $genero, $nacimiento, $email, $dni, $telefono, $federacion, $club, $peso, $categoria, $id);
            }
            $stmt->execute();

            if($stmt->affected_rows > 0){
                $respuesta = array(
                    'respuesta' => 'competidor_actualizado',
                    'nombre' => $nombre
                );
            }
            else{
                $respuesta = array(
                    'respuesta' => 'competidor_fallido',
                    'archivo' => $_FILES['foto']
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
    else if($accion == "eliminar"){
        //Paso el ID del usuario
        $id = filter_var($_POST['id'], FILTER_SANITIZE_NUMBER_INT);
        //Intento hacer la operación en la base de datos
        try {
            $stmt = $con->prepare('DELETE FROM competidores WHERE dni = ?');
            $stmt->bind_param('i', $id);
            $stmt->execute();

            $stmt = $con->prepare('DELETE FROM `puntos-competidor` WHERE usuario = ?');
            $stmt->bind_param('i', $id);
            $stmt->execute();
            
            $respuesta = array(
                'respuesta' => 'competidor_eliminado'
            );
            
            $stmt->close();
            $con->close();
        } catch (Exception $e) {
            $respuesta = array(
                'error' => $e->getMessage()
            );
        }
    }
    else if($accion == "sumar-puntos"){
        //Paso los datos ingresados por el usuario por un filtro para evitar codigo malo
        $id = filter_var($_POST['id'], FILTER_SANITIZE_NUMBER_INT);
        $torneo = filter_var($_POST['torneo'], FILTER_SANITIZE_NUMBER_INT);
        $puntosSenior = filter_var($_POST['puntos-senior'], FILTER_SANITIZE_NUMBER_INT);
        $puntosCadete = filter_var($_POST['puntos-cadete'], FILTER_SANITIZE_NUMBER_INT);
        $puntosKyuGraduado = filter_var($_POST['puntos-kyu-graduado'], FILTER_SANITIZE_NUMBER_INT);
        $puntosKyuNovicio = filter_var($_POST['puntos-kyu-novicio'], FILTER_SANITIZE_NUMBER_INT);
        $puntosInfantilB = filter_var($_POST['puntos-infantil-b'], FILTER_SANITIZE_NUMBER_INT);
        //Intento hacer la operación en la base de datos
        try {
            $cargarExistente = " SELECT * FROM `puntos-competidor` WHERE torneo = $torneo AND usuario = $id ";
            $resultadoBD = $con->query($cargarExistente);
            $informacionUsuario = $resultadoBD->fetch_assoc();

            if(count($informacionUsuario) > 0){
                $puntosSenior = $puntosSenior + $informacionUsuario['puntos_senior'];
                $puntosCadete = $puntosCadete + $informacionUsuario['puntos_cadete'];
                $puntosKyuGraduado = $puntosKyuGraduado + $informacionUsuario['puntos_kyu_graduado'];
                $puntosKyuNovicio = $puntosKyuNovicio + $informacionUsuario['puntos_kyu_novicio'];
                $puntosInfantilB = $puntosInfantilB + $informacionUsuario['puntos_infantil_b'];

                $stmt = $con->prepare(" UPDATE `puntos-competidor` SET puntos_senior = ?, puntos_cadete = ?, puntos_kyu_graduado = ?, puntos_kyu_novicio = ?, puntos_infantil_b = ? WHERE torneo = $torneo AND usuario = $id ");
                $stmt->bind_param('iiiii', $puntosSenior, $puntosCadete, $puntosKyuGraduado, $puntosKyuNovicio, $puntosInfantilB);
                $stmt->execute();
            }
            else{
                $stmt = $con->prepare('INSERT INTO `puntos-competidor` (torneo, usuario, puntos_senior, puntos_cadete, puntos_kyu_graduado, puntos_kyu_novicio, puntos_infantil_b) VALUES (?, ?, ?, ?, ?, ?, ?)');
                $stmt->bind_param('iiiiiii', $torneo, $id, $puntosSenior, $puntosCadete, $puntosKyuGraduado, $puntosKyuNovicio, $puntosInfantilB);
                $stmt->execute();
            }

            if($stmt->affected_rows > 0){
                $respuesta = array(
                    'respuesta' => 'puntos_actualizados',
                );
            }
            else{
                $respuesta = array(
                    'respuesta' => 'puntos_fallidos',
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

    echo json_encode($respuesta);
?>