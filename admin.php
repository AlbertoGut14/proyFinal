<?php
session_start();

if (!isset($_SESSION['usuario']) || $_SESSION['correo'] !== 'admin@admin.com') {
    header("Location: login.php");
    exit();
}

include 'conexion.php'; 

$mostrar_editar = false;
$mostrar_agregar = false;
$product_to_edit = null;

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['agregar'])) {
    $nombre = $_POST['nombre'];
    $descripcion = $_POST['descripcion'];
    $precio = $_POST['precio'];
    $cantidad = $_POST['cantidad'];
    $foto = $_POST['foto'];

    $sql_insert = "INSERT INTO productos (nombre, descripcion, precio, cantidad, fotos) VALUES ('$nombre', '$descripcion', $precio, $cantidad, '$foto')";
    mysqli_query($con, $sql_insert);
}

// Lógica para eliminar un producto
if (isset($_GET['eliminar'])) {
    $id_producto = $_GET['eliminar'];
    $sql_delete = "DELETE FROM productos WHERE id = $id_producto";
    mysqli_query($con, $sql_delete);
}

// Lógica para editar un producto
if (isset($_GET['editar'])) {
    $id_producto = $_GET['editar'];
    $sql_edit = "SELECT * FROM productos WHERE id = $id_producto";
    $res_edit = mysqli_query($con, $sql_edit);
    $product_to_edit = mysqli_fetch_assoc($res_edit);
    $mostrar_editar = true;
}

// Lógica para actualizar producto editado
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['editar'])) {
    $id_producto = $_POST['id_producto'];
    $nombre = $_POST['nombre'];
    $descripcion = $_POST['descripcion'];
    $precio = $_POST['precio'];
    $cantidad = $_POST['cantidad'];
    $foto = $_POST['foto'];

    $sql_update = "UPDATE productos SET nombre='$nombre', descripcion='$descripcion', precio=$precio, cantidad=$cantidad, fotos='$foto' WHERE id=$id_producto";
    mysqli_query($con, $sql_update);
}

// Obtener los productos existentes
$sql_productos = "SELECT * FROM productos";
$res_productos = mysqli_query($con, $sql_productos);

// Obtener el historial de compras
$sql_historial_compras = "SELECT u.nombre as usuario, p.nombre as producto, c.cantidad, p.precio, (c.cantidad * p.precio) as subtotal
                          FROM compras c
                          JOIN productos p ON c.producto = p.id
                          JOIN usuarios u ON c.usuario = u.id";
$res_historial_compras = mysqli_query($con, $sql_historial_compras);
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Administrador</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-SgOJa3DmI69IUzQ2PVdRZhwQ+dy64/BUtbMJw1MZ8t5HZApcHrRKUc4W0kG879m7" crossorigin="anonymous">
</head>
<body>
    <?php include 'barranav.php'; ?>

    <div class="container mt-5">
        <h2>Panel de Administración</h2>

        <!-- Mostrar productos existentes -->
        <h3 class="mt-5">Productos en Inventario</h3>
        <table class="table table-bordered table-hover mt-3">
            <thead class="table-dark">
                <tr>
                    <th>ID</th>
                    <th>Nombre</th>
                    <th>Descripción</th>
                    <th>Precio</th>
                    <th>Cantidad</th>
                    <th>Imagen</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                <?php
                if (mysqli_num_rows($res_productos) > 0) {
                    while ($row = mysqli_fetch_assoc($res_productos)) {
                        echo "
                        <tr>
                            <td>{$row['id']}</td>
                            <td>{$row['nombre']}</td>
                            <td>{$row['descripcion']}</td>
                            <td>\${$row['precio']}</td>
                            <td>{$row['cantidad']}</td>
                            <td><img src='{$row['fotos']}' width='100' height='100' style='object-fit:cover;'></td>
                            <td>
                                <a href='admin.php?editar={$row['id']}' class='btn btn-sm btn-outline-warning'>Editar</a>
                                <a href='admin.php?eliminar={$row['id']}' class='btn btn-sm btn-outline-danger'>Eliminar</a>
                            </td>
                        </tr>";
                    }
                } else {
                    echo "<tr><td colspan='7'>No hay productos disponibles.</td></tr>";
                }
                ?>
            </tbody>
        </table>

        <!-- Formulario para agregar nuevo producto -->
        <h3 class="mt-5">Agregar Nuevo Producto</h3>
        <form method="post">
            <div class="mb-3">
                <label for="nombre" class="form-label">Nombre del Producto</label>
                <input type="text" class="form-control" id="nombre" name="nombre" required>
            </div>
            <div class="mb-3">
                <label for="descripcion" class="form-label">Descripción</label>
                <textarea class="form-control" id="descripcion" name="descripcion" required></textarea>
            </div>
            <div class="mb-3">
                <label for="precio" class="form-label">Precio</label>
                <input type="number" class="form-control" id="precio" name="precio" required>
            </div>
            <div class="mb-3">
                <label for="cantidad" class="form-label">Cantidad</label>
                <input type="number" class="form-control" id="cantidad" name="cantidad" required>
            </div>
            <div class="mb-3">
                <label for="foto" class="form-label">URL de la Imagen</label>
                <input type="text" class="form-control" id="foto" name="foto" required>
            </div>
            <button type="submit" name="agregar" class="btn btn-primary">Agregar Producto</button>
        </form>

        <!-- Formulario de edición del producto -->
        <?php if ($mostrar_editar && $product_to_edit): ?>
        <h3 class="mt-5">Editar Producto</h3>
        <form method="post">
            <input type="hidden" name="id_producto" value="<?php echo $product_to_edit['id']; ?>">
            <div class="mb-3">
                <label for="nombre" class="form-label">Nombre del Producto</label>
                <input type="text" class="form-control" id="nombre" name="nombre" value="<?php echo $product_to_edit['nombre']; ?>" required>
            </div>
            <div class="mb-3">
                <label for="descripcion" class="form-label">Descripción</label>
                <textarea class="form-control" id="descripcion" name="descripcion" required><?php echo $product_to_edit['descripcion']; ?></textarea>
            </div>
            <div class="mb-3">
                <label for="precio" class="form-label">Precio</label>
                <input type="number" class="form-control" id="precio" name="precio" value="<?php echo $product_to_edit['precio']; ?>" required>
            </div>
            <div class="mb-3">
                <label for="cantidad" class="form-label">Cantidad</label>
                <input type="number" class="form-control" id="cantidad" name="cantidad" value="<?php echo $product_to_edit['cantidad']; ?>" required>
            </div>
            <div class="mb-3">
                <label for="foto" class="form-label">URL de la Imagen</label>
                <input type="text" class="form-control" id="foto" name="foto" value="<?php echo $product_to_edit['fotos']; ?>" required>
            </div>
            <button type="submit" name="editar" class="btn btn-warning">Actualizar Producto</button>
        </form>
        <?php endif; ?>

        <!-- Historial de compras -->
        <h3 class="mt-5">Historial de Compras</h3>
        <table class="table table-bordered table-hover mt-3">
            <thead class="table-dark">
                <tr>
                    <th>Usuario</th>
                    <th>Producto</th>
                    <th>Cantidad</th>
                    <th>Precio</th>
                    <th>Subtotal</th>
                </tr>
            </thead>
            <tbody>
                <?php
                if (mysqli_num_rows($res_historial_compras) > 0) {
                    while ($row = mysqli_fetch_assoc($res_historial_compras)) {
                        $subtotal = $row['cantidad'] * $row['precio'];
                        echo "
                        <tr>
                            <td>{$row['usuario']}</td>
                            <td>{$row['producto']}</td>
                            <td>{$row['cantidad']}</td>
                            <td>\${$row['precio']}</td>
                            <td>\${$subtotal}</td>
                        </tr>";
                    }
                } else {
                    echo "<tr><td colspan='5'>No hay compras registradas.</td></tr>";
                }
                ?>
            </tbody>
        </table>

    </div>

    <?php include 'piepag.php'; ?>
</body>
</html>