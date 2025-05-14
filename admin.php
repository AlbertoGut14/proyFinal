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
    $fab = $_POST['fab'];
    $origen = $_POST['origen'];

    $sql_insert = "INSERT INTO productos (nombre, descripcion, precio, cantidad, fotos, fab, origen) VALUES ('$nombre', '$descripcion', $precio, $cantidad, '$foto', '$fab', '$origen')";
    mysqli_query($con, $sql_insert);
}

if (isset($_GET['eliminar'])) {
    $id_producto = $_GET['eliminar'];
    $sql_delete = "DELETE FROM productos WHERE id = $id_producto";
    mysqli_query($con, $sql_delete);
}

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
    $fab = $_POST['fab'];
    $origen = $_POST['origen'];

    $sql_update = "UPDATE productos SET nombre='$nombre', descripcion='$descripcion', precio=$precio, cantidad=$cantidad, fotos='$foto', fabricante='$fab', origen='$origen' WHERE id=$id_producto";
    mysqli_query($con, $sql_update);
}

// Obtener los productos existentes
$sql_productos = "SELECT * FROM productos";
$res_productos = mysqli_query($con, $sql_productos);

// Obtener el historial de compras
$sql_historial_compras = "SELECT usuarios.nombre as usuario, productos.nombre as producto, compras.cantidad, productos.precio, (compras.cantidad * productos.precio) as subtotal
                          FROM compras
                          JOIN productos ON compras.producto = productos.id
                          JOIN usuarios ON compras.usuario = usuarios.id";
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

    <header class="bg-dark py-5">
        <div class="container text-center text-white">
            <br><br><br>
            <h1 class="display-4 fw-bolder">Panel de Administración</h1>
        </div>
    </header>

<div class="container mt-5">
    <div class="alert alert-primary mt-4" role="alert">
    <h4 class="alert-heading">¡Bienvenido al panel de administración!</h4>
    <p>Aquí puedes gestionar el inventario de productos, revisar el historial de compras y mantener tu tienda siempre actualizada.</p>
    <hr>
    <p class="mb-0">Usa las opciones a continuación para comenzar.</p>
    </div>
    <br>
    <div class="d-flex gap-3 mb-4">
        <button class="btn btn-primary" data-bs-toggle="collapse" data-bs-target="#seccionInventario">Ver Inventario</button>
        <button class="btn btn-success" data-bs-toggle="collapse" data-bs-target="#seccionAgregar">Agregar Producto</button>
        <button class="btn btn-secondary" data-bs-toggle="collapse" data-bs-target="#seccionHistorial">Historial de Compras</button>
    </div>
    <br>
    <div id="seccionInventario" class="collapse">
        <h3>Productos en Inventario</h3>
        <div class="table-responsive">
            <table class="table table-striped align-middle">
                <thead class="table-dark">
                    <tr>
                        <th>ID</th><th>Nombre</th><th>Descripción</th><th>Precio</th><th>Cantidad</th><th>Fabricante</th><th>Origen</th><th>Imagen</th><th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    <?php while ($row = mysqli_fetch_assoc($res_productos)): ?>
                        <tr>
                            <td><?= $row['id'] ?></td>
                            <td><?= $row['nombre'] ?></td>
                            <td><?= $row['descripcion'] ?></td>
                            <td>$<?= $row['precio'] ?></td>
                            <td><?= $row['cantidad'] ?></td>
                            <td><?= $row['fabricante'] ?? 'N/A' ?></td>
                            <td><?= $row['origen'] ?? 'N/A' ?></td>
                            <td><img src="<?= $row['fotos'] ?>" width="100" height="100" style="object-fit:cover;"></td>
                            <td>
                                <a href="admin.php?editar=<?= $row['id'] ?>" class="btn btn-sm btn-outline-warning mb-1">Editar</a>
                                <a href="admin.php?eliminar=<?= $row['id'] ?>" class="btn btn-sm btn-outline-danger">Eliminar</a>
                            </td>
                        </tr>
                    <?php endwhile; ?>
                </tbody>
            </table>
        </div>
        <br>
    </div>

    <!-- Agregar producto -->
    <div id="seccionAgregar" class="collapse mt-5">
        <h3>Agregar Nuevo Producto</h3>
        <form method="post">
            <div class="row g-3">
                <div class="col-md-6">
                    <label class="form-label">Nombre</label>
                    <input type="text" name="nombre" class="form-control" required>
                </div>
                <div class="col-md-6">
                    <label class="form-label">Precio</label>
                    <input type="number" name="precio" class="form-control" required>
                </div>
                <div class="col-md-12">
                    <label class="form-label">Descripción</label>
                    <textarea name="descripcion" class="form-control" required></textarea>
                </div>
                <div class="col-md-4">
                    <label class="form-label">Cantidad</label>
                    <input type="number" name="cantidad" class="form-control" required>
                </div>
                <div class="col-md-4">
                    <label class="form-label">Fabricante</label>
                    <input type="text" name="fabricante" class="form-control">
                </div>
                <div class="col-md-4">
                    <label class="form-label">Origen</label>
                    <input type="text" name="origen" class="form-control">
                </div>
                <div class="col-md-12">
                    <label class="form-label">URL de Imagen</label>
                    <input type="text" name="foto" class="form-control">
                </div>
            </div>
            <button type="submit" name="agregar" class="btn btn-success mt-3">Agregar Producto</button>
        </form>
        <br>
    </div>

    <div id="seccionHistorial" class="collapse mt-5">
        <h3>Historial de Compras</h3>
        <table class="table table-hover">
            <thead class="table-secondary">
                <tr>
                    <th>Usuario</th><th>Producto</th><th>Cantidad</th><th>Precio</th><th>Subtotal</th>
                </tr>
            </thead>
            <tbody>
                <?php while ($row = mysqli_fetch_assoc($res_historial_compras)): ?>
                    <tr>
                        <td><?= $row['usuario'] ?></td>
                        <td><?= $row['producto'] ?></td>
                        <td><?= $row['cantidad'] ?></td>
                        <td>$<?= $row['precio'] ?></td>
                        <td>$<?= $row['subtotal'] ?></td>
                    </tr>
                <?php endwhile; ?>
            </tbody>
        </table>
        <br>
    </div>

    <?php if ($mostrar_editar && $product_to_edit): ?>
    <div class="mt-5">
        <h3>Editar Producto</h3>
        <form method="post">
            <input type="hidden" name="id_producto" value="<?= $product_to_edit['id'] ?>">
            <div class="row g-3">
                <div class="col-md-6">
                    <label class="form-label">Nombre</label>
                    <input type="text" name="nombre" class="form-control" value="<?= $product_to_edit['nombre'] ?>" required>
                </div>
                <div class="col-md-6">
                    <label class="form-label">Precio</label>
                    <input type="number" name="precio" class="form-control" value="<?= $product_to_edit['precio'] ?>" required>
                </div>
                <div class="col-md-12">
                    <label class="form-label">Descripción</label>
                    <textarea name="descripcion" class="form-control" required><?= $product_to_edit['descripcion'] ?></textarea>
                </div>
                <div class="col-md-4">
                    <label class="form-label">Cantidad</label>
                    <input type="number" name="cantidad" class="form-control" value="<?= $product_to_edit['cantidad'] ?>" required>
                </div>
                <div class="col-md-4">
                    <label class="form-label">Fabricante</label>
                    <input type="text" name="fabricante" class="form-control" value="<?= $product_to_edit['fabricante'] ?? '' ?>">
                </div>
                <div class="col-md-4">
                    <label class="form-label">Origen</label>
                    <input type="text" name="origen" class="form-control" value="<?= $product_to_edit['origen'] ?? '' ?>">
                </div>
                <div class="col-md-12">
                    <label class="form-label">URL de Imagen</label>
                    <input type="text" name="foto" class="form-control" value="<?= $product_to_edit['fotos'] ?>" required>
                </div>
            </div>
            <button type="submit" name="editar" class="btn btn-warning mt-3">Actualizar Producto</button>
        </form>
        <br>
    </div>
    <?php endif; ?>
</div>

    <?php include 'piepag.php'; ?>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>