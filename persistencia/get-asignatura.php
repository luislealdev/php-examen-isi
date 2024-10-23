<?php
// Incluir el archivo de configuración para conectar a la base de datos
require 'config.php';

// Definir el contenido de respuesta como JSON
header('Content-Type: application/json');

try {
    // Preparar la consulta para seleccionar todas las asignaturas
    $query = "SELECT codigoA, nombre FROM asignatura";
    $stmt = $pdo->prepare($query);
    $stmt->execute();

    // Obtener los resultados en un arreglo asociativo
    $asignaturas = $stmt->fetchAll(PDO::FETCH_ASSOC);

    // Enviar los resultados como respuesta en formato JSON
    echo json_encode($asignaturas);

} catch (PDOException $e) {
    // Enviar mensaje de error en caso de fallo
    echo json_encode(["error" => $e->getMessage()]);
}
?>
