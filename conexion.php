<?php
    $con = mysqli_connect("localhost", "root", "", "f1_store");

    if (!$con) {
        die("Error de conexión: " . mysqli_connect_error());
    }
?>