<?php
session_start();

if (!isset($_SESSION['usuario'])) {
    header("Location: login.php");
    exit();
}

include 'conexion.php';

$id_usuario = $_SESSION['usuario'];

// Obtener datos del perfil
$sql_perfil = "SELECT nombre, correo, nacimiento, tarjeta, cp FROM usuarios WHERE id = $id_usuario";
$res_perfil = mysqli_query($con, $sql_perfil);
$usuario = mysqli_fetch_assoc($res_perfil);

mysqli_close($con);
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>Mi Perfil - F1 Fanatic</title>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-SgOJa3DmI69IUzQ2PVdRZhwQ+dy64/BUtbMJw1MZ8t5HZApcHrRKUc4W0kG879m7" crossorigin="anonymous">
    <link href="css/styles.css" rel="stylesheet" />
</head>

<body>
    <?php include 'barranav.php'; ?>
    <header class="bg-dark py-5">
        <div class="container px-4 px-lg-5 my-5">
            <div class="text-center text-white">
                <h1 class="display-4 fw-bolder">Perfil del Usuario</h1>
                <p class="lead fw-normal text-white-50 mb-0">Consulta tu información y tus compras</p>
            </div>
        </div>
    </header>

    
    <section class="py-5">
        <div class="container px-4 px-lg-5">
        <div class="mb-5">
            <h2 class="mb-4">Información del perfil</h2>
            <div class="card shadow-sm border-0">
                <div class="card-body">
                    <div class="row mb-3">
                        <div class="col-md-6">
                            <p class="mb-1 text-muted">Nombre</p>
                            <h5><?php echo $usuario['nombre']; ?></h5>
                        </div>
                        <div class="col-md-6">
                            <p class="mb-1 text-muted">Correo</p>
                            <h5><?php echo $usuario['correo']; ?></h5>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-md-4">
                            <p class="mb-1 text-muted">Fecha de nacimiento</p>
                            <h6><?php echo $usuario['nacimiento']; ?></h6>
                        </div>
                        <div class="col-md-4">
                            <p class="mb-1 text-muted">Tarjeta</p>
                            <h6><?php echo $usuario['tarjeta']; ?></h6>
                        </div>
                        <div class="col-md-4">
                            <p class="mb-1 text-muted">Código Postal</p>
                            <h6><?php echo $usuario['cp']; ?></h6>
                        </div>
                    </div>
                </div>
            </div>
        </div>


            <!-- Historial de compras -->
            <div>
                <h3>Historial de Compras</h3>
                <br>
                <div class="table-responsive">
                    <table class="table table-bordered table-hover align-middle">
                        <thead class="table-dark text-center">
                            <tr>
                                <th>Producto</th>
                                <th>Imagen</th>
                                <th>Precio</th>
                                <th>Cantidad</th>
                            </tr>
                        </thead>
                        <tbody class="text-center">
                            <?php
                                include 'conexion.php';
                                $sql_compras = "SELECT productos.nombre, productos.precio, productos.fotos, compras.cantidad
                                                FROM compras
                                                JOIN productos ON compras.producto = productos.id
                                                WHERE compras.usuario = $id_usuario";

                                $res_compras = mysqli_query($con, $sql_compras);
                                
                                if (mysqli_num_rows($res_compras) > 0) {
                                    while ($row = mysqli_fetch_assoc($res_compras)) {
                                        echo "
                                        <tr>
                                            <td>{$row['nombre']}</td>
                                            <td>{$row['fotos']}</td>
                                            <td>\${$row['precio']}</td>
                                            <td>{$row['cantidad']}</td>
                                        </tr>";
                                    }
                                } else {
                                    echo "<tr><td colspan='4'>No se ha comprado nada.</td></tr>";
                                }

                                mysqli_close($con);
                            ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </section>

    <?php include 'piepag.php'; ?>

    <!-- JS opcional -->
    <script src="js/scripts.js"></script>
</body>
</html>
