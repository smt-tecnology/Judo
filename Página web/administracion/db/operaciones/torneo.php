<?php 
    $accion = $_POST['accion'];
    require('../conexion.php');

    if($accion == "crear"){
        //Paso los datos ingresados por el usuario por un filtro para evitar codigo malo
        $nombre = filter_var($_POST['nombre'], FILTER_SANITIZE_STRING);
        $categorias = filter_var($_POST['categorias'], FILTER_SANITIZE_STRING);
        $reglas = filter_var($_POST['reglas'], FILTER_SANITIZE_STRING);
        //Intento hacer la operación en la base de datos
        try {
            $stmt = $con->prepare('INSERT INTO torneos (nombre, categorias, reglas) VALUES (?, ?, ?)');
            $stmt->bind_param('sss', $nombre, $categorias, $reglas);
            $stmt->execute();
            if($stmt->affected_rows > 0){
                $respuesta = array(
                    'respuesta' => 'torneo_creado',
                    'nombre' => $nombre
                );
            }
            else{
                $respuesta = array(
                    'respuesta' => 'torneo_fallido'
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
        $categorias = filter_var($_POST['categorias'], FILTER_SANITIZE_STRING);
        $reglas = filter_var($_POST['reglas'], FILTER_SANITIZE_STRING);
        //Intento hacer la operación en la base de datos
        try {
            $stmt = $con->prepare('UPDATE torneos SET nombre = ?, categorias = ?, reglas = ? WHERE id = ?');
            $stmt->bind_param('sssi', $nombre, $categorias, $reglas, $id);
            $stmt->execute();
            if($stmt->affected_rows > 0){
                $respuesta = array(
                    'respuesta' => 'torneo_actualizado',
                    'nombre' => $nombre
                );
            }
            else{
                $respuesta = array(
                    'respuesta' => 'torneo_fallido'
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
            $stmt = $con->prepare('DELETE FROM torneos WHERE id = ?');
            $stmt->bind_param('i', $id);
            $stmt->execute();
            $respuesta = array(
                'respuesta' => 'torneo_eliminado'
            );
            $stmt->close();
            $con->close();
        } catch (Exception $e) {
            $respuesta = array(
                'error' => $e->getMessage()
            );
        }
    }
    else if($accion == "nueva-fecha"){
        //Paso los datos ingresados por el usuario por un filtro para evitar codigo malo
        $id = filter_var($_POST['id'], FILTER_SANITIZE_NUMBER_INT);
        $fecha = filter_var($_POST['fecha'], FILTER_SANITIZE_STRING);
        $hora = filter_var($_POST['hora'], FILTER_SANITIZE_STRING);
        $direccion = filter_var($_POST['direccion'], FILTER_SANITIZE_STRING);
        //Intento hacer la operación en la base de datos
        try {
            $stmt = $con->prepare('INSERT INTO `fechas-torneo` (torneo, fecha, hora, direccion) VALUES (?, ?, ?, ?)');
            $stmt->bind_param('isss', $id, $fecha, $hora, $direccion);
            $stmt->execute();
            
            if($stmt->affected_rows > 0){
                $respuesta = array(
                    'respuesta' => 'fecha_añadida',
                );
            }
            else{
                $respuesta = array(
                    'respuesta' => 'fecha_fallida',
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