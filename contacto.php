<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Formulario de Registro</title>
    <link rel="stylesheet" href="./css/diseño.css">
</head>
<body>

    <div class="main-content">
        <form action="contacto.php" method="POST">
            <h2>Formulario de Registro</h2>
            <p>Por favor, completa el formulario para registrarte.</p>

            <div class="input-group">
                <input type="text" name="name" placeholder="Nombre" value="<?php echo isset($_GET['name']) ? htmlspecialchars($_GET['name']) : ''; ?>" required>
            </div>

            <div class="input-group">
                <input type="text" name="lastname" placeholder="Apellido" required>
            </div>

            <div class="input-group">
                <input type="email" name="email" placeholder="Correo electrónico" required>
            </div>

            <div class="input-group"> 
                <input type="date" name="consultationday" value="<?php echo isset($_GET['consultationday']) ? htmlspecialchars($_GET['consultationday']) : ''; ?>" required>
            </div>

            <div class="input-group">
                <input type="tel" name="phone" placeholder="Teléfono" required>
            </div>

            <input type="submit" class="btn" name="register" value="Enviar">
        </form>

        <?php
        include("registro.php");
        ?>
    </div>

    <footer>
        <div class="footer-content">
            <p>© Consultorio Dental Héroes Tecámac. Todos los derechos reservados. Diego Rivas Allison no hizo nada</p>
            <p>Contacto: Teléfono 55 19 9702 54 | <a href="mailto:info@consultoriodentalheroes.com">info@consultoriodentalheroes.com</a></p>
            <p><a href="https://maps.app.goo.gl/T6ewPUsRytvcuP1Q8" target="_blank" class="maps-link">Ver en Google Maps 📍</a></p>
        </div>
    </footer>

</body>
</html>