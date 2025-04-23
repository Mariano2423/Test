<?php
require_once $_SERVER['DOCUMENT_ROOT'] .  '/G1_SC-502_JN_Proyecto/config/database.php';

class escuela
{
    public static function get_escuelas()
    {
        global $conn;
        session_start();

        // Buscar el escuela en la base de datos
        $sql = "SELECT id_escuela,descripcion  FROM escuela ";
        $result = $conn->query($sql);

        return $result; // escuela no encontrado o contraseña incorrecta
    }
    
}
?>
