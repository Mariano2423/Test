<?php
include $_SERVER['DOCUMENT_ROOT'] . '/G1_SC-502_JN_Proyecto/app/controller/cursoController.php';

// Obtener ID del curso de la URL.
$id_curso = isset($_GET['id']) ? $_GET['id'] : null;

if ($id_curso) {
    $data = get_curso_contenido($id_curso);
    $temas = $data['temas'];
    $curso = $data['curso'];
} else {
    header("Location: ../layout.php?status=error&msg=" . urlencode("ID del curso no proporcionado."));
    exit();
}
?>

<!DOCTYPE html>
<html>

<head>
    <title>Escuela en Casa</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
    <link href="/G1_SC-502_JN_Proyecto/public/css/style.css" rel="stylesheet" type="text/css" />
    <link href="/G1_SC-502_JN_Proyecto/public/css/print.css" rel="stylesheet" type="text/css" />
    <!-- jQuery library -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <!-- Popper JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>
    <!-- Latest compiled JavaScript -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
    <script src="/G1_SC-502_JN_Proyecto/public/js/print.js"></script>
</head>

<body>
    <nav class="navbar navbar-expand-lg navbar-light bg-primary">
        <div class="container">
            <a class="navbar-brand text-white" href="../layout.php">Escuela en Casa</a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav"
                aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav">
                    <li class="nav-item"><a class="nav-link text-white" href="listado.php">Listado de Cursos</a></li>
                    <li class="nav-item"><a class="nav-link text-white" href="registro_matricula.html">Registro de
                            Matrícula</a></li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle text-white" data-toggle="dropdown" href="" role="button"
                            aria-expanded="false">Reportes</a>

                        <ul class="dropdown-menu bg-primary">
                            <li><a class="dropdown-item text-white" href="../nota/reporte_trimestral.html">Reporte
                                    Trimestral</a></li>
                            <li><a class="dropdown-item text-white" href="../nota/reporte_rendimiento.html">Reporte
                                    Rendimiento</a></li>
                        </ul>
                    </li>
                    <li class="nav-item"><a class="nav-link text-white" href="../nota/listado.html">Mi Perfil</a></li>
                </ul>
            </div>
            <ul class="navbar-nav">
                <li class="nav-item my-auto">
                    <a class="btn btn-outline-light" href="/G1_SC-502_JN_Proyecto/index.php">Salir</a>
                </li>
            </ul>
        </div>
    </nav>

    <section class="class bg-custom" id="temas">
        <div class="container mt-5">
            <h1 class="text-center text-white" id="curso">Contenido del Curso
                <?= htmlspecialchars($curso['descripcion']); ?></h1>
            <?php if (!empty($temas)): ?>
                <div class="card row text-center">
                    <?php foreach ($temas as $tema): ?>
                        <div class="card-header">
                            <h4 class="card-title text-center"><?= htmlspecialchars($tema['nombre']); ?></h4>
                        </div>
                    <?php endforeach; ?>
                </div>
            <?php else: ?>
                <p class="text-white text-center">No hay temas disponibles para este curso.</p>
            <?php endif; ?>
        </div>
        <div class="container mt-3 text-center d-flex justify-content-between no-print">
            <button onclick="imprimirContenido()" class="btn bg-body-custom text-white">Imprimir</button>
            <a href="/G1_SC-502_JN_Proyecto/app/views/curso/listado.php" class="btn bg-body-custom text-white">Salir</a>
        </div>
    </section>




    <footer footer th:fragment="footer" class="navbar-light bg-primary text-white mt-5 p-3">
        <div class="container">
            <p class="text-center">Derechos Reservados - Escuela en Casa 2025</p>
        </div>
    </footer>
</body>

</html>