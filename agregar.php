<?php
session_start();

if (!isset($_SESSION['usuario'])) {
    header("Location: login.php");
    exit();
}

include 'conexion.php';

$id_usuario = $_SESSION['usuario'];
$id_producto = $_GET['id']; // El ID del producto se pasa como parámetro

// Verificar si el producto ya está en el carrito
$sql_check = "SELECT id FROM carrito WHERE usuario = $id_usuario AND producto = $id_producto";
$res_check = mysqli_query($con, $sql_check);

if (mysqli_num_rows($res_check) > 0) {
    // Si el producto ya está en el carrito, aumentar la cantidad
    $sql_update = "UPDATE carrito SET cantidad = cantidad + 1 WHERE usuario = $id_usuario AND producto = $id_producto";
    mysqli_query($con, $sql_update);
} else {
    // Si no está en el carrito, agregarlo con cantidad 1
    $sql_insert = "INSERT INTO carrito (usuario, producto, cantidad) VALUES ($id_usuario, $id_producto, 1)";
    mysqli_query($con, $sql_insert);
}

mysqli_close($con);

header("Location: index.php");
exit();
?>