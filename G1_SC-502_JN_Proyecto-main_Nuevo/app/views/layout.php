<!DOCTYPE html>
<html>

<head>
    <title>Escuela en Casa</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
    <link href="/public/css/style.css" rel="stylesheet" type="text/css" />
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
</head>

<body>
<?php
    if (session_status() === PHP_SESSION_NONE) {
        session_start();
    }
    // Redirigir si no está autenticado
    if (!isset($_SESSION['usuario'])) {
        header("Location: /G1_SC-502_JN_Proyecto/index.php?status=error&msg=Debes iniciar sesión.");
        exit();
    }
    ?>

    <div id="main-content">

        <nav class="navbar navbar-expand-lg navbar-light bg-primary">
            <div class="container">
                <a class="navbar-brand text-white" href="">Escuela en Casa</a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav"
                    aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarNav">
                    <ul class="navbar-nav">
                        <li class="nav-item"><a class="nav-link text-white" href="./curso/listado.php">Listado de
                                Cursos</a></li>
                        <li class="nav-item"><a class="nav-link text-white"
                                href="curso/registro_matricula.html">Registro de Matrícula</a></li>
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle text-white" data-toggle="dropdown" href="#" role="button"
                                aria-expanded="false">Reportes</a>
                            <ul class="dropdown-menu bg-primary">
                                <li><a class="dropdown-item text-white" href="nota/reporte_trimestral.html">Reporte
                                        Trimestral</a></li>
                                <li><a class="dropdown-item text-white" href="nota/reporte_rendimiento.html">Reporte
                                        Rendimiento</a></li>
                            </ul>
                        </li>
                        <li class="nav-item"><a class="nav-link text-white" href="nota/listado.html">Mi Perfil</a></li>
                    </ul>
                </div>
                <ul class="navbar-nav">
                    <li class="nav-item my-auto">
                        <a class="btn btn-outline-light" href="/G1_SC-502_JN_Proyecto/index.php">Salir</a>
                    </li>
                </ul>
            </div>
        </nav>
        <footer class="navbar-light bg-primary text-white mt-5 p-3">
            <div class="container">
                <p class="text-center">Derechos Reservados - Escuela en Casa 2025</p>
            </div>
        </footer>

    </div>

</body>

</html>