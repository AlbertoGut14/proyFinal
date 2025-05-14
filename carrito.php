<?php
session_start();

if (!isset($_SESSION['usuario'])) {
    header("Location: login.php");
    exit();
}

include 'conexion.php';

$id_usuario = $_SESSION['usuario'];

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id_producto = $_POST['producto_id'];

    if (isset($_POST['sumar']) || isset($_POST['restar'])) {
        $sql_cantidad = "SELECT cantidad FROM carrito WHERE usuario = $id_usuario AND producto = $id_producto";
        $res = mysqli_query($con, $sql_cantidad);
        $row = mysqli_fetch_assoc($res);
        $cantidad_actual = (int) $row['cantidad'];

        if (isset($_POST['sumar'])) {
            $nueva_cantidad = $cantidad_actual + 1;
            $sql_update = "UPDATE carrito SET cantidad = $nueva_cantidad WHERE usuario = $id_usuario AND producto = $id_producto";
            mysqli_query($con, $sql_update);
        } elseif (isset($_POST['restar'])) {
            if ($cantidad_actual <= 1) {
                
                $sql_delete = "DELETE FROM carrito WHERE usuario = $id_usuario AND producto = $id_producto";
                mysqli_query($con, $sql_delete);
            } else {
                
                $nueva_cantidad = $cantidad_actual - 1;
                $sql_update = "UPDATE carrito SET cantidad = $nueva_cantidad WHERE usuario = $id_usuario AND producto = $id_producto";
                mysqli_query($con, $sql_update);
            }
        }
    }

    if (isset($_POST['eliminar'])) {
        $sql_delete = "DELETE FROM carrito WHERE usuario = $id_usuario AND producto = $id_producto";
        mysqli_query($con, $sql_delete);
    }
}


    mysqli_close($con);
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Carrito de Compras</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-SgOJa3DmI69IUzQ2PVdRZhwQ+dy64/BUtbMJw1MZ8t5HZApcHrRKUc4W0kG879m7" crossorigin="anonymous">
    <link href="css/styles.css" rel="stylesheet" />
    <script>
    function confirmarCompra() {
        return confirm("¿Estás seguro de que deseas finalizar la compra?");
    }
    </script>
</head>
<body>
    <?php include 'barranav.php'; ?>

    <header class="bg-dark py-5">
        <div class="container text-center text-white">
            <br>
            <br>
            <h1 class="display-4 fw-bolder">Tu carrito</h1>
        </div>
    </header>

    <section class="py-5">
        <div class="container px-4 px-lg-5">
            <div class="row justify-content-center">
                <div class="col-lg-10">
                    <div class="table-responsive">
                        <table class="table table-bordered text-center align-middle">
                            <thead class="table-dark">
                                <tr>
                                    <th>Producto</th>
                                    <th>Imagen</th>
                                    <th>Precio</th>
                                    <th>Cantidad</th>
                                    <th>Acciones</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                    include 'conexion.php';

                                    $sql = "SELECT productos.id, productos.nombre, productos.fotos, productos.precio, carrito.cantidad
                                            FROM carrito
                                            JOIN productos ON carrito.producto = productos.id
                                            WHERE carrito.usuario = $id_usuario";

                                    $res = mysqli_query($con, $sql);

                                    if (mysqli_num_rows($res) > 0) {
                                        while ($row = mysqli_fetch_assoc($res)) {
                                            echo "
                                            <tr>
                                                <td>{$row['nombre']}</td>
                                                <td><img src='{$row['fotos']}' width='100' height='100' style='object-fit:cover;'></td>
                                                <td>\${$row['precio']}</td>
                                                <td>{$row['cantidad']}</td>
                                                <td>
                                                    <div class='d-flex justify-content-center gap-1'>
                                                        <form method='post'>
                                                            <input type='hidden' name='producto_id' value='{$row['id']}'>
                                                            <button type='submit' name='restar' class='btn btn-sm btn-outline-secondary'>−</button>
                                                        </form>
                                                        <form method='post'>
                                                            <input type='hidden' name='producto_id' value='{$row['id']}'>
                                                            <button type='submit' name='sumar' class='btn btn-sm btn-outline-secondary'>+</button>
                                                        </form>
                                                        <form method='post'>
                                                            <input type='hidden' name='producto_id' value='{$row['id']}'>
                                                            <button type='submit' name='eliminar' class='btn btn-sm btn-outline-danger'>Eliminar</button>
                                                        </form>
                                                    </div>
                                                </td>
                                            </tr>";
                                        }

                                        echo "
                                        <tr class='table-secondary fw-bold'>
                                            <td colspan='5'>
                                                <form action='finalizar.php' method='POST' onsubmit='return confirmarCompra();'>
                                                    <button type='submit' class='btn btn-success'>Finalizar compra</button>
                                                </form>
                                            </td>
                                        </tr>";
                                    } else {
                                        echo "<tr><td colspan='5'>Tu carrito está vacío.</td></tr>";
                                    }
                                    mysqli_close($con);
                                ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <?php
        include 'piepag.php';
    ?>
</body>
</html>