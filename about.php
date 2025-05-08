
<?php
session_start();
?><!DOCTYPE html>
<html lang="es">
    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="" />
        <meta name="author" content="" />
        <title>F1 Shop - PPI</title>
        <link rel="icon" type="image/x-icon" href="assets/favicon.ico" />
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-SgOJa3DmI69IUzQ2PVdRZhwQ+dy64/BUtbMJw1MZ8t5HZApcHrRKUc4W0kG879m7" crossorigin="anonymous">
        <link href="css/styles.css" rel="stylesheet" />
    </head>
    <body>
        <?php include 'barranav.php'; ?>
        <!-- Header-->
        <header class="bg-dark py-5">
            <div class="container px-4 px-lg-5 my-5">
                <div class="text-center text-white">
                    <h1 class="display-4 fw-bolder">About us</h1>
                    <p class="lead fw-normal text-white-50 mb-0">The new F1 Licensed Shop</p>
                </div>
            </div>
        </header>
        

        <section class="py-5">
            <div class="container px-4 px-lg-5">
                <div class="row gx-4 gx-lg-5 align-items-center">
                    <div class="col-lg-6">
                        <img class="img-fluid rounded mb-4 mb-lg-0" src="https://e0.365dm.com/25/02/2048x1152/skysports-pirelli-f1-2025-test_6820918.jpg?20250206074138" alt="About F1 Shop" />
                    </div>
                    <div class="col-lg-6">
                        <h2 class="fw-bolder">Nuestra Historia</h2>
                        <p class="lead">F1 Fanatic nació de la pasión por la velocidad, la ingeniería de precisión y el espíritu competitivo que define a la Fórmula 1. Nos dedicamos a ofrecer productos oficiales para todos los fans del automovilismo.</p>
                        <p>Desde artículos de moda hasta Lego de F1, entre otros. Nuestra misión es acercarte al mundo de la F1 como nunca antes.</p>
                    </div>
                </div>
            </div>
        </section>

        <?php include 'piepag.php'; ?>

        <!-- Bootstrap core JS-->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
        <!-- Core theme JS-->
        <script src="js/scripts.js"></script>
    </body>
</html>