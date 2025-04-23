<?php
require_once '../../config/database.php';
try {
  $db = Database::connect();
  echo "¡Conexión exitosa!";
} catch (Exception $e) {
  echo "Fallo: " . $e->getMessage();
}
?>
