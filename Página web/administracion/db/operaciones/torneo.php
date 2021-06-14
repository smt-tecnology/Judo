<?php 
    $accion = $_POST['accion'];
    require('../conexion.php');

    if($accion == "crear"){
        //Paso los datos ingresados por el usuario por un filtro para evitar codigo malo
        $nombre = filter_var($_POST['nombre'], FILTER_SANITIZE_STRING);
        $categorias = filter_var($_POST['categorias'], FILTER_SANITIZE_STRING);        
        //Intento hacer la operación en la base de datos
        try {
            if($_FILES['imagen']['type'] == 'image/png' || $_FILES['imagen']['type'] == 'image/jpg' || $_FILES['imagen']['type'] == 'image/jpeg'){
                //Obtengo el tipo de archivo
                $separadorTipo = strpos($_FILES['imagen']['type'], '/');
                $extensionArchivo = substr($_FILES['imagen']['type'], $separadorTipo+1);
                //Configuro el directorio y la muevo
                $directorio = '../../../img/Torneos/';
                if(move_uploaded_file($_FILES['imagen']['tmp_name'], $directorio . $nombre . $apellido . '.' . $extensionArchivo)){
                    $urlImagen = "img/Torneos/" . $nombre . $apellido . '.' . $extensionArchivo;
                }
            }
            if($_FILES['reglas']['type'] == 'application/pdf' || $_FILES['reglas']['type'] == 'application/vnd.openxmlformats-officedocument.wordprocessingml.document' || $_FILES['reglas']['type'] == 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet'){
                //Obtengo el tipo de archivo
                if($_FILES['reglas']['type'] == 'application/vnd.openxmlformats-officedocument.wordprocessingml.document') $extensionArchivo = "docx";
                else if($_FILES['reglas']['type'] == 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet') $extensionArchivo = "xlsx";
                else{
                    $separadorTipo = strpos($_FILES['reglas']['type'], '/');
                    $extensionArchivo = substr($_FILES['reglas']['type'], $separadorTipo+1);
                }
                    //Configuro el directorio y la muevo
                $directorio = '../../../reglas/';
                if(move_uploaded_file($_FILES['reglas']['tmp_name'], $directorio . $nombre . '.' . $extensionArchivo)){
                    $urlReglas = "reglas/" . $nombre . '.' . $extensionArchivo;
                    $stmt = $con->prepare('INSERT INTO torneos (nombre, categorias, reglas, imagen) VALUES (?, ?, ?,?)');
                    $stmt->bind_param('ssss', $nombre, $categorias, $urlReglas,$urlImagen);
                }
            }
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
        //Intento hacer la operación en la base de datos
        try {
            //Si actualizo la imagen y las reglas
            if(isset($_FILES['imagen']) && isset($_FILES['reglas'])){
                //Obtengo la URL de la Imagen
                if($_FILES['imagen']['type'] == 'image/png' || $_FILES['imagen']['type'] == 'image/jpg' || $_FILES['imagen']['type'] == 'image/jpeg'){
                    //Obtengo el tipo de archivo
                    $separadorTipo = strpos($_FILES['imagen']['type'], '/');
                    $extensionArchivo = substr($_FILES['imagen']['type'], $separadorTipo+1);
                    //Configuro el directorio y la muevo
                    $directorio = '../../../img/Torneos/';
                    if(move_uploaded_file($_FILES['imagen']['tmp_name'], $directorio . $nombre . $apellido . '.' . $extensionArchivo)){
                        $urlImagen = "img/Torneos/" . $nombre . $apellido . '.' . $extensionArchivo;     
                    }
                }
                //Obtengo la URL de las reglas
                if($_FILES['reglas']['type'] == 'application/pdf' || $_FILES['reglas']['type'] == 'application/vnd.openxmlformats-officedocument.wordprocessingml.document' || $_FILES['reglas']['type'] == 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet'){
                    //Obtengo el tipo de archivo
                    if($_FILES['reglas']['type'] == 'application/vnd.openxmlformats-officedocument.wordprocessingml.document') $extensionArchivo = "docx";
                    else if($_FILES['reglas']['type'] == 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet') $extensionArchivo = "xlsx";
                    else{
                        $separadorTipo = strpos($_FILES['reglas']['type'], '/');
                        $extensionArchivo = substr($_FILES['reglas']['type'], $separadorTipo+1);
                    }
                    //Configuro el directorio y la muevo
                    $directorio = '../../../reglas/';
                    if(move_uploaded_file($_FILES['reglas']['tmp_name'], $directorio . $nombre . '.' . $extensionArchivo)){
                        $urlReglas = "reglas/" . $nombre . '.' . $extensionArchivo;
                    }
                }
                //Ejecuto la consulta
                $stmt = $con->prepare('UPDATE torneos SET nombre = ?, categorias = ?, reglas = ?, imagen = ? WHERE id = ?');
                $stmt->bind_param('ssssi', $nombre, $categorias, $urlReglas, $urlImagen, $id);               
            }
            //Si actualizo la imagen pero no las reglas
            else if(isset($_FILES['imagen'])){
                if($_FILES['imagen']['type'] == 'image/png' || $_FILES['imagen']['type'] == 'image/jpg' || $_FILES['imagen']['type'] == 'image/jpeg'){
                    //Obtengo el tipo de archivo
                    $separadorTipo = strpos($_FILES['imagen']['type'], '/');
                    $extensionArchivo = substr($_FILES['imagen']['type'], $separadorTipo+1);
                    //Configuro el directorio y la muevo
                    $directorio = '../../../img/Torneos/';
                    if(move_uploaded_file($_FILES['imagen']['tmp_name'], $directorio . $nombre . $apellido . '.' . $extensionArchivo)){
                        $urlImagen = "img/Torneos/" . $nombre . $apellido . '.' . $extensionArchivo;     
                        $stmt = $con->prepare('UPDATE torneos SET nombre = ?, categorias = ?, imagen = ? WHERE id = ?');
                        $stmt->bind_param('sssi', $nombre, $categorias, $urlImagen, $id);
                    }
                 }               
            }
            //Si actualizo las reglas pero no la imagen
            else if(isset($_FILES['reglas'])){
                if($_FILES['reglas']['type'] == 'application/pdf' || $_FILES['reglas']['type'] == 'application/vnd.openxmlformats-officedocument.wordprocessingml.document' || $_FILES['reglas']['type'] == 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet'){
                    //Obtengo el tipo de archivo
                    if($_FILES['reglas']['type'] == 'application/vnd.openxmlformats-officedocument.wordprocessingml.document') $extensionArchivo = "docx";
                    else if($_FILES['reglas']['type'] == 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet') $extensionArchivo = "xlsx";
                    else{
                        $separadorTipo = strpos($_FILES['reglas']['type'], '/');
                        $extensionArchivo = substr($_FILES['reglas']['type'], $separadorTipo+1);
                    }
                    //Configuro el directorio y la muevo
                    $directorio = '../../../reglas/';
                    if(move_uploaded_file($_FILES['reglas']['tmp_name'], $directorio . $nombre . '.' . $extensionArchivo)){
                        $urlReglas = "reglas/" . $nombre . '.' . $extensionArchivo;
                        $stmt = $con->prepare('UPDATE torneos SET nombre = ?, categorias = ?, reglas = ? WHERE id = ?');
                        $stmt->bind_param('sssi', $nombre, $categorias, $urlReglas, $id);
                    }
                }
            }
            //Si no actualizo ni la imagen ni las reglas
            else{
                $stmt = $con->prepare('UPDATE torneos SET nombre = ?, categorias = ? WHERE id = ?');
                $stmt->bind_param('ssi', $nombre, $categorias, $id);
            }
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
            $stmt = $con->prepare('DELETE FROM `fechas-torneo` WHERE torneo = ?');
            $stmt->bind_param('i', $id);
            $stmt->execute();


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