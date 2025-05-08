<!DOCTYPE html>
<html lang="es">
    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="" />
        <meta name="author" content="" />
        <title>F1 Fanatic - PPI</title>

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
                    <h1 class="display-4 fw-bolder">Articulos de F1 Fanatic</h1>
                    <p class="lead fw-normal text-white-50 mb-0">Todos nuestros productos!</p>
                </div>
            </div>
        </header>

        <!-- Section-->
        <section class="py-5">
        <div class="container py-5">
        
            <div class="row">

                <?php
                    $con = mysqli_connect("localhost", "root", "", "f1_store");

                    if (!$con) {
                        die("<p class='text-danger'>Error de conexión: " . mysqli_connect_error() . "</p>");
                    }

                    $sql = "SELECT * FROM productos";
                    $result = mysqli_query($con, $sql);

                    if (mysqli_num_rows($result) > 0) {
                        while ($producto = mysqli_fetch_assoc($result)) {
                            echo "
                            <div class='col-md-4 mb-4'>
                                <div class='card h-100 shadow'>
                                    <img src='{$producto['fotos']}' class='card-img-top' alt='{$producto['nombre']}' style='height: 300px; object-fit: cover;'>
                                    <div class='card-body'>
                                        <div class='text-center'>
                                            <h5 class='fw-bolder'>{$producto['nombre']}</h5>
                                            <p class='text-danger'>$ {$producto['precio']}</p>     
                                        </div>
                                    </div>
                                    <div class='card-footer text-center'>
                                        <a href='#' class='btn btn-dark'>Agregar al carrito</a>
                                    </div>
                                </div>
                            </div>
                            ";
                        }
                    } else {
                        echo "<p class='text-center'>No hay productos disponibles.</p>";
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
