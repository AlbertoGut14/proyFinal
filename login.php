<?php
session_start();
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Iniciar Sesión</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-SgOJa3DmI69IUzQ2PVdRZhwQ+dy64/BUtbMJw1MZ8t5HZApcHrRKUc4W0kG879m7" crossorigin="anonymous">
    <link href="css/styles.css" rel="stylesheet" />
</head>
<body>
    <div class="text-center p-3">
        <h1>Iniciar sesión</h1>
    </div>

    <section>
        <div class="container px-3 px-lg-5">
            <div class="row justify-content-center">
                <div class="col-lg-6">
                    <div class="card shadow">
                        <div class="card-body p-3">
                            <form method="post" action="login.php">
                                <label for="correo" class="form-label">Correo electrónico</label>
                                <input type="email" class="form-control" id="correo" name="correo" required>
                                <br>
                                <label for="contrasena" class="form-label">Contraseña</label>
                                <input type="password" class="form-control" id="contrasena" name="contrasena" required>
                                <br>
                                <button type="submit" class="btn btn-dark w-100">Iniciar sesión</button>
                            </form>

                            <div class="mt-3 text-center">
                                ¿No tienes cuenta? <a href="registro.php">Crear cuenta</a>
                            </div>

                            <?php
                            if ($_SERVER["REQUEST_METHOD"] == "POST") {
                                $con = mysqli_connect("localhost", "root", "", "f1_store");

                                if (!$con) {
                                    echo "<p class='text-danger mt-3'>Error de conexión: " . mysqli_connect_error() . "</p>";
                                } else {
                                    $correo = mysqli_real_escape_string($con, $_POST['correo']);
                                    $contrasena = $_POST['contrasena'];

                                    $sql = "SELECT * FROM usuarios WHERE correo = '$correo'";
                                    $result = mysqli_query($con, $sql);

                                    if (mysqli_num_rows($result) == 1) {
                                        $usuario = mysqli_fetch_assoc($result);
                                        if ($contrasena === $usuario['contrasena']) {
                                            
                                            $_SESSION['usuario'] = $usuario['id'];
                                            echo "<p class='text-success mt-3'>Inicio de sesión exitoso. Redirigiendo...</p>";
                                            $_SESSION['nombre'] = $usuario['nombre'];
                                            $_SESSION['correo'] = $usuario['correo']; 
                                            echo "<script>setTimeout(function(){ window.location.href = 'index.php'; }, 2500);</script>";
                                        } else {
                                            echo "<p class='text-danger mt-3'>Contraseña incorrecta.</p>";
                                        }
                                    } else {
                                        echo "<p class='text-danger mt-3'>Usuario no encontrado.</p>";
                                    }

                                    mysqli_close($con);
                                }
                            }
                            ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</body>
</html>
