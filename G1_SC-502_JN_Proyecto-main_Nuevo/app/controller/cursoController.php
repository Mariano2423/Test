<?php
require_once __DIR__ .'/../models/curso.php';

function get_cursos()
{
    try {
        $result = curso::get_cursos();
        
        if ($result->num_rows > 0) {
            echo '<div>';
            echo '<div id="contenedor-cursos" class="row text-center">';

            $index = 0;
            while ($row = $result->fetch_assoc()) {

                echo '<div class="card col-md-4">';
                echo '<div class="card-body">';
                echo '<img src="' . $row['ruta_imagen'] . '" alt="Imagen del curso" height="100" width="100" />';
                echo '<h5 class="card-title">' . $row['descripcion'] . '</h5>';
                echo '<a href="mostrar_materia.php?id=' . $row['id_curso'] . '" class="btn bg-body-custom text-white">Revisar Materia</a>';
                echo '</div>';
                echo '</div>';
            }

            echo '</div>';
            echo '</div>';
        } else {
            echo '<p class="text-center text-white">No hay cursos disponibles.</p>';
        }
    } catch (Exception $e) {
        header("Location: ../../layout.php?status=error&msg=" . urlencode($e->getMessage()));
        exit();
    }
}

function get_curso_contenido($id_curso) {
    try {
        // Obtener los temas asociados a un curso.
        $temas = curso::get_temas_por_curso($id_curso);
        $curso = curso::get_curso($id_curso);

        return ['temas' => $temas, 'curso' => $curso];
    } catch (Exception $e) {
        header("Location: ../../layout.php?status=error&msg=" . urlencode($e->getMessage()));
        exit();
    }
}

?>
