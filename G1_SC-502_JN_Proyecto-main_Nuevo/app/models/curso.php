<?php
require_once $_SERVER['DOCUMENT_ROOT'] .  '/G1_SC-502_JN_Proyecto/config/database.php';

class curso
{
    public static function get_cursos()
    {
        global $conn;
        session_start();

        $sql = "SELECT id_curso,descripcion,ruta_imagen  FROM curso WHERE estado = 'En Progreso' and id_usuario = ". $_SESSION['usuario'];
        $result = $conn->query($sql);

        return $result;
    }
    public static function get_curso($id_curso)
    {
        global $conn;
    
        $sql = "SELECT descripcion FROM curso WHERE id_curso = " . $id_curso;
        $result = $conn->query($sql);
    
        if ($result->num_rows > 0) {
            return $result->fetch_assoc();
        }
        return null;
    }
    
    public static function get_temas_por_curso($id_curso)
    {
        global $conn;
    
        $sql = "SELECT nombre, informacion FROM tema WHERE id_curso = " . $id_curso;
        $result = $conn->query($sql);
    
        $temas = [];
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $temas[] = $row;
            }
        }
        return $temas;
    }
}
?>
