<?php
require_once '../../config/database.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nombre = $_POST['nombre'];
    $nota = $_POST['nota'];

    $sql = "INSERT INTO notas_estudiantes (nombre, nota) VALUES (?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sd", $nombre, $nota);
    $stmt->execute();
    echo "OK";
} else {
    $result = $conn->query("SELECT * FROM notas_estudiantes");
    $notas = [];
    while ($fila = $result->fetch_assoc()) {
        $notas[] = $fila;
    }
    echo json_encode($notas);
}
?>
