<?php
    function SubirArchivo ($sfArchivo){
        $dir_subida = 'temp_img/';
        $fichero_subido = $dir_subida . basename($_FILES[$sfArchivo]['name']);
        if (move_uploaded_file($_FILES[$sfArchivo]['tmp_name'], $fichero_subido)) {
            return $fichero_subido;
        } else {
            return "";
        }
    }
    
    require("plugins/php-mailer/PHPMailer.php");
    require("plugins/php-mailer/SMTP.php");

    //Configuro la cuenta desde la que se enviará el correo
    $host = 'mail.judointerfederativo.com.ar';
    $puerto = 465;
    $emailAdministracion = 'administracion@judointerfederativo.com.ar';
    $claveAdministracion = 'judointerfederativo';
    //Creo el mail a enviar y el tipo (determina el correo que se envía)
    $mail = new PHPMailer(true);
    $tipoMail = $_POST['tipoMail'];
    try {
        //Configuro el envío de los correos
        $mail->isSMTP();
        $mail->SMTPAuth   = true;
        $mail->Host       = $host; 
        $mail->Port       = $puerto;
        $mail->SMTPSecure = 'ssl';
        $mail->isHTML(true);
        $mail->CharSet = 'UTF-8';
        //Configuro los datos del correo desde donde se envían los correos
        $mail->Username   = $emailAdministracion;
        $mail->Password   = $claveAdministracion;
        //Genero el HTML correspondiente para los correos
        if($tipoMail == "solicitar-inscripcion"){
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
            $foto = SubirArchivo('foto');

            //Genero el mail a enviar
            $mailHTML = '
            <html>
                <body>
                    <div>
                        <p style="text-align:center;">
                            Hola! <br >
                            Un usuario ha solicitado ser añadido al ranking de los torneos 
                            que usted asigna en su sitio. A continuación le mostraremos los 
                            datos que ha enviado:
                            
                            <br >
                            <br >

                            <span style="font-weight:bold">
                                NOMBRE: ' . $nombre . '<br >
                            </span>
                            <span style="font-weight:bold">
                                APELLIDO: ' . $apellido . '<br >
                            </span>
                            <span style="font-weight:bold">
                                DNI: ' . $dni . '<br >
                            </span>
                            <span style="font-weight:bold">
                                EMAIL: ' . $email . '<br >
                            </span>
                            <span style="font-weight:bold">
                                TELEFONO: ' . $telefono . '<br >
                            </span>
                            <span style="font-weight:bold">
                                GÉNERO: ' . $genero . '<br >
                            </span>
                            <span style="font-weight:bold">
                                NACIMIENTO: ' . $nacimiento . '<br >
                            </span>
                            <span style="font-weight:bold">
                                FEDERACIÓN: ' . $federacion . '<br >
                            </span>
                            <span style="font-weight:bold">
                                CLUB: ' . $club . '<br >
                            </span>
                            <span style="font-weight:bold">
                                PESO: ' . $peso . '<br >
                            </span>
                            <span style="font-weight:bold">
                                CATEGORÍA: ' . $categoria . '<br >
                            </span>

                            <br >
                            <br >

                            Recuerda que encontrarás la imagen que el usuario ha 
                            enviado archivada en este correo electrónico.
                            
                            <br >
                            <br >

                        </p>
                    </div>
                </body>
            </html>
            ';

            //Configuración de envío
            $mail->From = $emailAdministracion ;
            $mail->FromName = 'Torneo Interfederativo de Judo';
            $mail->addAttachment($foto);
            $mail->addAddress('gimenezhugo@hotmail.com');

            //Configuración del contenido
            $mail->Subject = 'Nueva solicitud de inscripción';
            $mail->Body    = $mailHTML;
            $mail->AltBody = 'Un usuario envio una solicitud de inscripción, pero no podrás visualizar los datos desde esta plataforma, dispositivo o aplicación. Por favor, inténtelo por otro método.';
            
            //Establezco una respuesta
            $respuesta = array(
                'respuesta' => 'envio_exitoso'
            );
        }
        else if($tipoMail == "inscripcion-competidor"){
            //Paso los datos ingresados por el usuario por un filtro para evitar codigo malo
            $nombre = filter_var($_POST['nombre'], FILTER_SANITIZE_STRING);
            $apellido = filter_var($_POST['apellido'], FILTER_SANITIZE_STRING);
            $club = filter_var($_POST['club'], FILTER_SANITIZE_STRING);
            $categoria = filter_var($_POST['categoria'], FILTER_SANITIZE_STRING);
            $torneo = filter_var($_POST['nombre-torneo'], FILTER_SANITIZE_STRING);

            //Genero el mail a enviar
            $mailHTML = '
            <html>
                <body>
                    <div>
                        <p style="text-align:center;">
                            Hola! <br >
                            Un competidor se ha inscripto en el torneo 
                            <span style="font-weight:bold">' . $torneo . '</span>. 
                            A continuación encontrarás los datos que ha ingresado:
                            
                            <br >
                            <br >

                            <span style="font-weight:bold">
                                NOMBRE: ' . $nombre . '<br >
                            </span>
                            <span style="font-weight:bold">
                                APELLIDO: ' . $apellido . '<br >
                            </span>
                            <span style="font-weight:bold">
                                CLUB: ' . $club . '<br >
                            </span>
                            <span style="font-weight:bold">
                                CATEGORIA: ' . $categoria . '<br >
                            </span>
                            
                            <br >
                            <br >

                        </p>
                    </div>
                </body>
            </html>
            ';

            //Configuración de envío
            $mail->From = $emailAdministracion ;
            $mail->FromName = 'Torneo Interfederativo de Judo';
            if($nombre && $apellido && $club && $categoria){
                $mail->addAddress('gimenezhugo@hotmail.com');
            }
            else{
                $mail->addAddress('mailnoexistente@noexiste.com');
            }

            //Configuración del contenido
            $mail->Subject = 'Nueva inscripción a ' . $torneo;
            $mail->Body    = $mailHTML;
            $mail->AltBody = 'Un usuario envio una solicitud de inscripción, pero no podrás visualizar los datos desde esta plataforma, dispositivo o aplicación. Por favor, inténtelo por otro método.';

            //Establezco una respuesta
            $respuesta = array(
                'respuesta' => 'envio_exitoso',
                'email' => 'inscripcion-torneo'
            );
        }
        else if($tipoMail == "inscripcion-club"){
            //Paso los datos ingresados por el usuario por un filtro para evitar codigo malo
            $nombre = filter_var($_POST['nombre'], FILTER_SANITIZE_STRING);
            $apellido = filter_var($_POST['apellido'], FILTER_SANITIZE_STRING);
            $categoria = filter_var($_POST['categoria'], FILTER_SANITIZE_STRING);

            $club = filter_var($_POST['nombre-club'], FILTER_SANITIZE_STRING);
            $email = filter_var($_POST['email-club'], FILTER_SANITIZE_STRING);
            $telefono = filter_var($_POST['telefono-club'], FILTER_SANITIZE_STRING);
            
            $torneo = filter_var($_POST['nombre-torneo'], FILTER_SANITIZE_STRING);

            //Genero el mail a enviar
            $mailHTML = '
            <html>
                <body>
                    <div>
                        <p style="text-align:center;">
                            Hola! <br >
                            Un club ha inscripto a un competidor suyo en el torneo  
                            <span style="font-weight:bold">' . $torneo . '</span>. 
                            A continuación encontrarás los datos del participante:
                            
                            <br >
                            <br >

                            <span style="font-weight:bold">
                                NOMBRE: ' . $nombre . '<br >
                            </span>
                            <span style="font-weight:bold">
                                APELLIDO: ' . $apellido . '<br >
                            </span>
                            <span style="font-weight:bold">
                                CATEGORIA: ' . $categoria . '<br >
                            </span>
                            
                            <br >
                            <br >

                            A continuación podrá encontrar la información 
                            perteneciente al club ' . $club . ':

                            <br >
                            <br >

                            <span style="font-weight:bold">
                                EMAIL DE CONTACTO: ' . $email . '<br >
                            </span>
                            <span style="font-weight:bold">
                                TELEFONO DE CONTACTO: ' . $telefono . '<br >
                            </span>

                        </p>
                    </div>
                </body>
            </html>
            ';

            //Configuración de envío
            $mail->From = $emailAdministracion ;
            $mail->FromName = 'Torneo Interfederativo de Judo';
            if($nombre && $apellido && $club && $categoria && $email && $telefono){
                $mail->addAddress('gimenezhugo@hotmail.com');
            }
            else{
                $mail->addAddress('mailnoexistente@noexiste.com');
            }
            //Configuración del contenido
            $mail->Subject = 'Nueva inscripción a ' . $torneo;
            $mail->Body    = $mailHTML;
            $mail->AltBody = 'Un usuario envio una solicitud de inscripción, pero no podrás visualizar los datos desde esta plataforma, dispositivo o aplicación. Por favor, inténtelo por otro método.';

            //Establezco una respuesta
            $respuesta = array(
                'respuesta' => 'envio_exitoso',
                'email' => 'inscripcion-torneo'
            );
        }

        $mail->send();
    } catch (Exception $e) {
        $respuesta = array(
            'respuesta' => 'envio_erroneo',
            'error' => "El mensaje no pudo enviarse. Error: $mail->ErrorInfo"
        );
    }

    echo json_encode($respuesta);
?>