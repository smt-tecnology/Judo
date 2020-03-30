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

    echo json_encode($respuesta);
?>