<?php
require_once(__DIR__ . '/../../config/database.php');

class Usuario
{
    public static function inicio($usuario)
    {
        $conn = Database::connect();

        $sql = "SELECT u.password, u.id_usuario, u.username, r.nombre AS rol 
                FROM usuario u 
                LEFT JOIN rol r ON u.id_usuario = r.id_usuario 
                WHERE u.username = ?";
        $stmt = $conn->prepare($sql);
        $stmt->execute([$usuario]);

        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public static function registro($new_username, $new_password, $new_nombre, $new_cedula, $new_fecha, $new_telefono, $new_encargado, $escuela, $grado)
    {
        $conn = Database::connect();

        // Verificar si el usuario ya existe
        $sql = "SELECT username FROM usuario WHERE username = ?";
        $stmt = $conn->prepare($sql);
        $stmt->execute([$new_username]);

        if ($stmt->rowCount() > 0) {
            return false; // Usuario ya existe
        } else {
            // Hash de la contraseña
            $hashed_password = password_hash($new_password, PASSWORD_BCRYPT);

            // Insertar en usuario
            $sql = "INSERT INTO usuario (username, password, nombre, telefono, ruta_imagen, activo) 
                    VALUES (?, ?, ?, ?, NULL, true)";
            $stmt = $conn->prepare($sql);
            $stmt->execute([$new_username, $hashed_password, $new_nombre, $new_telefono]);

            // Obtener id del nuevo usuario
            $id_usuario = $conn->lastInsertId();

            // Insertar rol (por defecto ROLE_USER)
            $sql = "INSERT INTO rol (nombre, id_usuario) VALUES (?, ?)";
            $stmt = $conn->prepare($sql);
            $stmt->execute(['ROLE_USER', $id_usuario]);

            // Insertar en estudiante
            $sql = "INSERT INTO proyecto.estudiante (id_usuario, cedula, fecha_nacimiento, encargado_legal, grado, id_escuela) 
                    VALUES (?, ?, ?, ?, ?, ?)";
            $stmt = $conn->prepare($sql);
            $stmt->execute([$id_usuario, $new_cedula, $new_fecha, $new_telefono, $grado, $escuela]);

            return true;
        }
    }
}
?>