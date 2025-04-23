<?php
require_once __DIR__ .'/../models/escuela.php';

function get_escuelas()
{
    try {
        $result = escuela::get_escuelas();
        
        if ($result->num_rows > 0) {

            $index = 0;
            while ($row = $result->fetch_assoc()) {
                echo ' <option value="' . $row['id_escuela'] . '" text="' . $row['descripcion'] . '">
                        ' . $row['descripcion'] . '
                            </option>';
                
            }

        } else {
            echo '<p class="text-center text-white">No hay escuelas disponibles.</p>';
        }
    } catch (Exception $e) {
        header("Location: ../../layout.php?status=error&msg=" . urlencode($e->getMessage()));
        exit();
    }
}
?>
