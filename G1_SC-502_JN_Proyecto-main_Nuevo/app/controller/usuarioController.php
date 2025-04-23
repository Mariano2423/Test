<?php
require_once(__DIR__ . '/../models/usuario.php');

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

try {
    if (!empty($_POST)) {
        $action = $_POST['action'] ?? '';

        // INICIO DE SESIÓN
        if (
            $action === 'inicio' &&
            !empty($_POST['login-username']) &&
            !empty($_POST['login-password'])
        ) {
            $usuario = $_POST['login-username'];
            $clave = $_POST['login-password'];

            $resultado = Usuario::inicio($usuario);

            if ($resultado && password_verify($clave, $resultado['password'])) {
                $_SESSION['usuario'] = $resultado['username'];
                $_SESSION['id_usuario'] = $resultado['id_usuario'];
                $_SESSION['rol'] = $resultado['rol'] ?? 'ROLE_USER';
                header("Location: ../../app/views/layout.php?status=success");
                exit();
            } else {
                header("Location: ../../index.php?status=error&msg=Usuario o contraseña incorrecta.");
                exit();
            }
        }

        // REGISTRO DE USUARIO
        else if (
            $action === 'registro' &&
            !empty($_POST['new-username']) &&
            !empty($_POST['new-password']) &&
            !empty($_POST['new-nombre']) &&
            !empty($_POST['new-cedula']) &&
            !empty($_POST['new-fecha']) &&
            !empty($_POST['new-telefono']) &&
            !empty($_POST['new-encargado']) &&
            !empty($_POST['escuela']) &&
            !empty($_POST['grado'])
        ) {
            $resultado = Usuario::registro(
                $_POST['new-username'],
                $_POST['new-password'],
                $_POST['new-nombre'],
                $_POST['new-cedula'],
                $_POST['new-fecha'],
                $_POST['new-telefono'],
                $_POST['new-encargado'],
                $_POST['escuela'],
                $_POST['grado']
            );

            if ($resultado) {
                header("Location: ../../index.php?status=success&msg=Registro exitoso.");
                exit();
            } else {
                header("Location: ../../index.php?status=error&msg=Usuario ya existe en el sistema.");
                exit();
            }
        }

        // CAMPOS INCOMPLETOS
        else {
            header("Location: ../../index.php?status=error&msg=Campos incompletos.");
            exit();
        }
    }
} catch (Exception $e) {
    header("Location: ../../index.php?status=error&msg=" . urlencode($e->getMessage()));
    exit();
}
?>

