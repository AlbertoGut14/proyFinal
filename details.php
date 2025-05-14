<?php
session_start();
if (!isset($_SESSION['usuario'])) {
    header("Location: login.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="es">
    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="" />
        <meta name="author" content="" />
        <title>Detalles del Producto - F1 Fanatic</title>

        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-SgOJa3DmI69IUzQ2PVdRZhwQ+dy64/BUtbMJw1MZ8t5HZApcHrRKUc4W0kG879m7" crossorigin="anonymous">
        <link href="css/styles.css" rel="stylesheet" />
    </head>
    
    <body>
        <?php include 'barranav.php'; ?>

        <!-- Header-->
        <header class="bg-dark py-5">
            <div class="container px-4 px-lg-5 my-5">
                <div class="text-center text-white">
                    <h1 class="display-4 fw-bolder">Detalles del Producto</h1>
                    <p class="lead fw-normal text-white-50 mb-0">Más información sobre este producto de F1 Fanatic</p>
                    <br>
                </div>
            </div>
        </header>

        <!-- Section para mostrar detalles del producto-->
        <section class="py-5">
        <div class="container py-5">
            <div class="row">
                <?php
                    include 'conexion.php';

                    // Verificar que 'id' esté en la URL
                    if (isset($_GET['id'])) {
                        $producto_id = $_GET['id'];

                        // Consulta para obtener el producto específico
                        $sql = "SELECT * FROM productos WHERE id = $producto_id";
                        $result = mysqli_query($con, $sql);

                        if (mysqli_num_rows($result) > 0) {
                            $producto = mysqli_fetch_assoc($result);
                            $nombre = $producto['nombre'];
                            $descripcion = $producto['descripcion'];
                            $precio = $producto['precio'];
                            $fotos = $producto['fotos'];
                            $fab = $producto['fab'];
                            $origen = $producto['origen'];

                            echo "
                            <div class='col-md-6'>
                                <img class='img-fluid' src='{$fotos}' alt='Imagen del producto' />
                            </div>
                            <div class='col-md-6'>
                                <h2 class='fw-bolder'>{$nombre}</h2>
                                <p class='text-danger fs-4'>$ {$precio}</p>
                                <p>{$descripcion}</p>
                                <p>Fabricante del Producto: {$fab}</p>
                                <p>Origen del Producto: {$origen}</p>
                                <div class='d-flex justify-content-start'>
                                    <a href='agregar_carrito.php?id={$producto['id']}' class='btn btn-dark btn-lg'>Agregar al carrito</a>
                                </div>
                            </div>
                            ";
                        } else {
                            echo "<p class='text-center'>Producto no encontrado.</p>";
                        }
                    } else {
                        echo "<p class='text-center'>No se ha especificado un producto.</p>";
                    }

                    mysqli_close($con);
                ?>
            </div>
        </div>
        </section>

        <?php include 'piepag.php'; ?>

        <!-- Core theme JS-->
        <script src="js/scripts.js"></script>
    </body>
</html>