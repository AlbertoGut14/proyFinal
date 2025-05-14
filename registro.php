<?php
session_start();
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Crear cuenta</title>
    
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-SgOJa3DmI69IUzQ2PVdRZhwQ+dy64/BUtbMJw1MZ8t5HZApcHrRKUc4W0kG879m7" crossorigin="anonymous">
    <link href="css/styles.css" rel="stylesheet" />
</head>
<body>
    <div class="text-center p-3">
        <h1>Registro de usuario</h1>
    </div>
    <section>
        <div class="container px-3 px-lg-5">
            <div class="row justify-content-center">
                <div class="col-lg-7">
                    <div class="card shadow">
                        <div class="card-body p-3">
                            <form method="post" action="registro.php">
                                <label for="nombre" class="form-label">Nombre</label>
                                <input type="text" class="form-control" id="nombre" name="nombre" required>
                                <br>
                                <label for="correo" class="form-label">Correo electrónico</label>
                                <input type="email" class="form-control" id="correo" name="correo" required>
                                <br>
                                <label for="contrasena" class="form-label">Contraseña</label>
                                <input type="password" class="form-control" id="contrasena" name="contrasena" required>
                                <br>
                                <label for="nacimiento" class="form-label">Fecha de nacimiento</label>
                                <input type="date" class="form-control" id="nacimiento" name="nacimiento" required>
                                <br>
                                <label for="tarjeta" class="form-label">Número de tarjeta</label>
                                <input type="text" class="form-control" id="tarjeta" name="tarjeta" maxlength="16" required>
                                <br>
                                <label for="cp" class="form-label">Código postal</label>
                                <input type="text" class="form-control" id="cp" name="cp" maxlength="5" required>
                                <br>
                                <button type="submit" class="btn btn-dark w-100">Crear cuenta</button>
                            </form>
                            <div class="mt-3 text-center">
                                ¿Ya tienes una cuenta? <a href="login.php">Inicia Sesión</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>


    <?php
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        include 'conexion.php';

        // Sanitizar entradas
        $nombre     = mysqli_real_escape_string($con, $_POST['nombre']);
        $correo     = mysqli_real_escape_string($con, $_POST['correo']);
        $contrasena = mysqli_real_escape_string($con, $_POST['contrasena']);
        $nacimiento = mysqli_real_escape_string($con, $_POST['nacimiento']);
        $tarjeta    = mysqli_real_escape_string($con, $_POST['tarjeta']);
        $cp         = mysqli_real_escape_string($con, $_POST['cp']);

        // Validar si el correo ya existe
        $check = mysqli_query($con, "SELECT * FROM usuarios WHERE correo = '$correo'");
        if (mysqli_num_rows($check) > 0) {
            echo "<div class='text-center'><p style='color:red;'>El correo ya está registrado.</p></div>";
        } else {
            $sql = "INSERT INTO usuarios (nombre, correo, contrasena, nacimiento, tarjeta, cp)
                    VALUES ('$nombre', '$correo', '$contrasena', '$nacimiento', '$tarjeta', '$cp')";

            if (!mysqli_query($con, $sql)) {
                die("Error: " . mysqli_error($con));
            }

            echo "<div class='text-center'><p style='color:green;'>Usuario registrado exitosamente.</p></div>";
        }

        mysqli_close($con);
    }
    ?>
</body>
</html>
