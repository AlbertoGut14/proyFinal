<?php
$total = 0;

if (isset($_SESSION['usuario'])) {
    $id_usuario = $_SESSION['usuario'];
    $con = mysqli_connect("localhost", "root", "", "f1_store");

    if ($con) {
        $sql = "SELECT cantidad FROM carrito WHERE usuario = $id_usuario";
        $res = mysqli_query($con, $sql);

        if ($res) {
            while ($row = mysqli_fetch_assoc($res)) {
                $total += $row['cantidad'];
            }
        }

        mysqli_close($con);
    }
}
?>

<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <div class="container px-4 px-lg-5">
        <a class="navbar-brand" href="index.php">F1 Fanatic</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0 ms-lg-4">
                <li class="nav-item"><a class="nav-link active" aria-current="page" href="index.php">Home</a></li>
                <li class="nav-item"><a class="nav-link" href="about.php">About</a></li>
                <li class="nav-item"><a class="nav-link" href="index.php">Productos</a></li>
                <?php 
                    if (isset($_SESSION['correo']) && $_SESSION['correo'] === 'admin@admin.com'){
                        echo '<li class="nav-item"><a class="nav-link" href="admin.php">Administrador</a></li>';
                    }
                ?>
                <?php 
                if (isset($_SESSION['usuario'])){
                    echo '<li class="nav-item"><a class="nav-link" href="perfil.php">Mi perfil</a></li>';
                    echo'<li class="nav-item"><a class="nav-link" href="logout.php">Cerrar sesión</a></li>';
                } else {
                    echo '<li class="nav-item"><a class="nav-link" href="login.php">Iniciar Sesion</a></li>';
                }
                ?>
            </ul>
            <a href="carrito.php" class="btn btn-outline-dark d-flex align-items-center">
                <i class="bi-cart-fill me-1"></i>
                Carrito
                <span class="badge bg-dark text-white ms-1 rounded-pill"><?= $total ?></span>
            </a>
        </div>
    </div>
</nav>