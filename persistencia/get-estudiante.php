<?php
// Incluir el archivo de configuración
require 'config.php';

// Definir el contenido de respuesta como JSON
header('Content-Type: application/json');

try {
    // Preparar la consulta para seleccionar todos los estudiantes
    $query = "SELECT codigoE, apellido, nombre, edad FROM estudiante";
    $stmt = $pdo->prepare($query);
    $stmt->execute();

    // Obtener los resultados en un arreglo asociativo
    $estudiantes = $stmt->fetchAll(PDO::FETCH_ASSOC);

    // Enviar los resultados como respuesta en formato JSON
    echo json_encode($estudiantes);

} catch (PDOException $e) {
    // Enviar mensaje de error en caso de fallo
    echo json_encode(["error" => $e->getMessage()]);
}
?>
