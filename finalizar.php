<?php
session_start();

if (!isset($_SESSION['usuario'])) {
    header("Location: login.php");
    exit();
}

include 'conexion.php'; 

$id_usuario = $_SESSION['usuario'];

mysqli_begin_transaction($con);

    $sql_carrito = "SELECT producto, cantidad FROM carrito WHERE usuario = $id_usuario";
    $res_carrito = mysqli_query($con, $sql_carrito);

    if (mysqli_num_rows($res_carrito) > 0) {
        while ($row = mysqli_fetch_assoc($res_carrito)) {
            $id_producto = $row['producto'];
            $cantidad = $row['cantidad'];

            $sql_insert = "INSERT INTO compras (usuario, producto, cantidad) VALUES ($id_usuario, $id_producto, $cantidad)";
            mysqli_query($con, $sql_insert);

            $sql_update_producto = "UPDATE productos SET cantidad = cantidad - $cantidad WHERE id = $id_producto";
            mysqli_query($con, $sql_update_producto);
        }

        $sql_delete = "DELETE FROM carrito WHERE usuario = $id_usuario";
        mysqli_query($con, $sql_delete);

        mysqli_commit($con);

        echo "<script>alert('Compra realizada con éxito.'); window.location.href = 'carrito.php';</script>";
    }

mysqli_close($con);
?>