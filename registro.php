<?php

require __DIR__ . '/libs/src/Exception.php';
require __DIR__ . '/libs/src/PHPMailer.php';
require __DIR__ . '/libs/src/SMTP.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

include("conexion.php");

if (isset($_POST['register'])) {
    
    if (
        !empty($_POST['name']) && 
        !empty($_POST['lastname']) && 
        !empty($_POST['email']) && 
        !empty($_POST['consultationday']) && 
        !empty($_POST['phone'])
    ) {
        
        $name = mysqli_real_escape_string($conex, trim($_POST['name']));
        $lastname = mysqli_real_escape_string($conex, trim($_POST['lastname']));$email = mysqli_real_escape_string($conex, trim($_POST['email']));
        $consultationday = mysqli_real_escape_string($conex, trim($_POST['consultationday']));$phone = mysqli_real_escape_string($conex, trim($_POST['phone']));
         
        $consulta = "INSERT INTO `datos del paciente` (`nombre`, `apellido`, `correo`, `telefono`, `dia consulta`) 
                     VALUES ('$name', '$lastname', '$email', '$phone', '$consultationday')";
        
        $resultado = mysqli_query($conex,$consulta);

        if ($resultado) {
           
            
            $mail = new PHPMailer(true);

            try {
                
                $mail->isSMTP();
                $mail->Host       = 'smtp.gmail.com';$mail->SMTPAuth   = true;                           
                $mail->Username   = 'rivd090102hmcvlga305@gmail.com';           
                $mail->Password   = 'htkr yzxq jdxr xyiw';          
                $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS; 
                $mail->Port       = 587;                            

               
                $mail->setFrom('tucorreo@gmail.com', 'Consultorio Dental');
                
                $mail->addAddress($email, $name . ' ' .$lastname); 

                $mail->addBCC('info@consultoriodentalheroes.com'); 
                
                $mail->isHTML(true);
                $mail->Subject = '¡Hola ' . $name . '! Hemos recibido tus datos 🦷';
                
                $mail->Body    = "
                <html>
                <head>
                    <title>Datos Recibidos</title>
                </head>
                <body style='font-family: Arial, sans-serif; background-color: #efeae2; margin: 0; padding: 20px;'>
                    <div style='max-width: 500px; margin: auto; background-color: #ffffff; padding: 20px; border-radius: 8px; box-shadow: 0 2px 5px rgba(0,0,0,0.1);'>
                        
                        <!-- Cabecera estilo WhatsApp -->
                        <div style='background-color: #075e54; color: white; padding: 15px; border-radius: 8px 8px 0 0; text-align: center;'>
                            <h2 style='margin: 0; font-size: 20px;'>Consultorio Dental 🦷</h2>
                            <p style='margin: 5px 0 0 0; font-size: 13px; color: #dcf8c6;'>Mensaje automático de confirmación</p>
                        </div>

                        <!-- Cuerpo del mensaje -->
                        <div style='padding: 20px 10px; color: #303030;'>
                            <p style='font-size: 16px;'>¡Hola <strong>{$name} {$lastname}</strong>! 👋</p>
                            <p style='font-size: 14px; line-height: 1.5;'>Hemos recibido tus datos correctamente a través de nuestro formulario web. Aquí tienes el resumen de tu información:</p>
                            
                            <!-- Burbuja de chat con los datos -->
                            <div style='background-color: #e1f5fe; border-left: 4px solid #00b4d8; padding: 15px; border-radius: 4px; margin: 20px 0;'>
                                <p style='margin: 5px 0;'><strong>👤 Nombre:</strong> {$name} {$lastname}</p>
                                <p style='margin: 5px 0;'><strong>📧 Correo:</strong> {$email}</p>
                                <p style='margin: 5px 0;'><strong>📞 Teléfono:</strong> {$phone}</p>
                                <p style='margin: 5px 0;'><strong>📅 Día de consulta:</strong> {$consultationday}</p>
                            </div>

                            <p style='font-size: 14px; line-height: 1.5;'>Nos pondremos en contacto contigo muy pronto para confirmar los detalles de tu cita. ¡Te esperamos! ✨</p>
                        </div>

                        <!-- Pie de página -->
                        <div style='text-align: center; font-size: 11px; color: #999; border-top: 1px solid #eee; padding-top: 15px; margin-top: 20px;'>
                            <p>Este mensaje fue generado automáticamente por el sistema del consultorio.</p>
                        </div>

                    </div>
                </body>
                </html>
                ";

                $mail->send();
                echo "<h3 class='success' style='color: green; text-align: center;'>¡Registro exitoso! Se ha enviado un mensaje de confirmación al correo del paciente.</h3>";

            } catch (Exception $e) {
                echo "<h3 class='error' style='color: red; text-align: center;'>El registro se guardó en la base de datos, pero el correo no pudo enviarse. Error: {$mail->ErrorInfo}</h3>";
            }

        } else {
            echo "<h3 class='error' style='color: red; text-align: center;'>¡Ocurrió un error al registrar! " . mysqli_error($conex) . "</h3>";
        }
    } else {
        echo "<h3 class='error' style='color: red; text-align: center;'>¡Por favor, llena todos los campos!</h3>";
    }
}
?>