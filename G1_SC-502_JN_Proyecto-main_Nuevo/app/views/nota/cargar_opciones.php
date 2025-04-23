<?php
require_once '../../../config/database.php';

$conn = Database::connect();
header('Content-Type: application/json');

// Estudiantes
$stmtEst = $conn->query("
    SELECT e.id_estudiante, u.nombre 
    FROM estudiante e
    JOIN usuario u ON e.id_usuario = u.id_usuario
");
$estudiantes = $stmtEst->fetchAll(PDO::FETCH_ASSOC);

// Grados únicos desde tabla curso
$stmtGrado = $conn->query("
    SELECT DISTINCT grado 
    FROM curso
    WHERE grado IS NOT NULL
    ORDER BY grado
");
$grados = $stmtGrado->fetchAll(PDO::FETCH_ASSOC);

// Cursos
$stmtCurso = $conn->query("
    SELECT id_curso, descripcion 
    FROM curso
    ORDER BY descripcion
");
$cursos = $stmtCurso->fetchAll(PDO::FETCH_ASSOC);

// Enviar todo junto
echo json_encode([
    'estudiantes' => $estudiantes,
    'grados' => $grados,
    'cursos' => $cursos
]);
