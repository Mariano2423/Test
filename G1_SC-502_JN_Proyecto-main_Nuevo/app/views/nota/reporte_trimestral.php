<?php
require_once '../../../config/database.php';

$conn = Database::connect();

// Obtener filtros del formulario
$anio = isset($_POST['anio']) ? intval($_POST['anio']) : date('Y');

$condiciones = [];

if (isset($_POST['reporteTrimestral'])) {
    $condiciones[] = "MONTH(n.fecha_inicio_trimestre) BETWEEN 1 AND 3 AND YEAR(n.fecha_inicio_trimestre) = $anio";
}
if (isset($_POST['reporteMensual'])) {
    $mesActual = date('n');
    $condiciones[] = "MONTH(n.fecha_inicio_trimestre) = $mesActual AND YEAR(n.fecha_inicio_trimestre) = $anio";
}
if (isset($_POST['reporteAnual'])) {
    $condiciones[] = "YEAR(n.fecha_inicio_trimestre) = $anio";
}

$sql = "SELECT 
            n.fecha_inicio_trimestre AS fecha_inicio, 
            n.fecha_final_trimestre AS fecha_final, 
            c.descripcion AS nombre_curso, 
            'Finalizado' AS estado, 
            n.nota
        FROM nota n
        INNER JOIN curso c ON n.id_curso = c.id_curso";

if (!empty($condiciones)) {
    $sql .= " WHERE " . implode(" OR ", $condiciones);
}

try {
    $stmt = $conn->prepare($sql);
    $stmt->execute();
    $resultado = $stmt->fetchAll(PDO::FETCH_ASSOC);
    echo json_encode($resultado);
} catch (Exception $e) {
    http_response_code(500);
    echo json_encode(['error' => $e->getMessage()]);
}
