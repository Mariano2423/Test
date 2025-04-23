<?php
//Permisos para que solo ROLE_ADMIN pueda ver
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
if (!isset($_SESSION['rol']) || $_SESSION['rol'] !== 'ROLE_ADMIN') {
    header("Location: /G1_SC-502_JN_Proyecto/index.php?status=error&msg=Acceso denegado.");
    exit();
}
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require_once '../../../config/database.php';

$conn = Database::connect();
header('Content-Type: application/json');

$idEstudiante = $_POST['idEstudiante'] ?? 'All';
$grado = $_POST['grado'] ?? 'All';
$idCurso = $_POST['idCurso'] ?? 'All';

// Consulta principal basada en tu ejemplo
$query = "
    SELECT 
        NULL AS fecha_inicio,
        NULL AS fecha_final,
        c.grado,
        c.descripcion AS curso,
        u.nombre AS estudiante,
        n.nota
    FROM nota n
    JOIN estudiante e ON n.id_estudiante = e.id_estudiante
    JOIN usuario u ON e.id_usuario = u.id_usuario
    JOIN curso c ON n.id_curso = c.id_curso
    WHERE 1=1
";

$params = [];

if ($idEstudiante !== 'All') {
    $query .= " AND e.id_estudiante = :idEstudiante";
    $params[':idEstudiante'] = $idEstudiante;
}

if ($grado !== 'All') {
    $query .= " AND c.grado = :grado";
    $params[':grado'] = $grado;
}

if ($idCurso !== 'All') {
    $query .= " AND c.id_curso = :idCurso";
    $params[':idCurso'] = $idCurso;
}

$stmt = $conn->prepare($query);
$stmt->execute($params);
$resultado = $stmt->fetchAll(PDO::FETCH_ASSOC);

echo json_encode($resultado);
