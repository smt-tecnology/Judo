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

    echo json_encode($respuesta);
?>