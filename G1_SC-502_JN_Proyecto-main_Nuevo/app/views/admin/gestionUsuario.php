<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
if (!isset($_SESSION['rol']) || $_SESSION['rol'] !== 'ROLE_ADMIN') {
    header("Location: /G1_SC-502_JN_Proyecto/index.php?status=error&msg=Acceso denegado.");
    exit();
}
require_once $_SERVER['DOCUMENT_ROOT'] . '/G1_SC-502_JN_Proyecto/config/database.php';

$conn = Database::connect();
$stmt = $conn->query("SELECT u.id_usuario, u.username, u.nombre, r.nombre AS rol 
                      FROM usuario u 
                      LEFT JOIN rol r ON u.id_usuario = r.id_usuario");
$usuarios = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html>
<head>
    <title>Gestión de Usuarios - Escuela en Casa</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
    <link href="/G1_SC-502_JN_Proyecto/public/css/style.css" rel="stylesheet" type="text/css" />
</head>
<body>
    <?php include $_SERVER['DOCUMENT_ROOT'] . '/G1_SC-502_JN_Proyecto/app/views/layout.php'; ?>
    <section class="bg-custom">
        <div class="container mt-5">
            <h1 class="text-center text-white">Gestión de Usuarios</h1>
            <div class="card mt-4">
                <div class="card-header bg-body-custom text-white">Lista de Usuarios</div>
                <div class="card-body">
                    <table class="table table-bordered text-center">
                        <thead class="bg-body-custom text-white">
                            <tr>
                                <th>ID</th>
                                <th>Usuario</th>
                                <th>Nombre</th>
                                <th>Rol</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($usuarios as $usuario): ?>
                                <tr>
                                    <td><?php echo htmlspecialchars($usuario['id_usuario']); ?></td>
                                    <td><?php echo htmlspecialchars($usuario['username']); ?></td>
                                    <td><?php echo htmlspecialchars($usuario['nombre']); ?></td>
                                    <td><?php echo htmlspecialchars($usuario['rol']); ?></td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </section>
</body>
</html>