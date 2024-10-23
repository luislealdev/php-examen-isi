<?php
// Incluir el archivo de configuración para conectar a la base de datos
require 'config.php';

// Definir el contenido de respuesta como JSON
header('Content-Type: application/json');

try {
    // Preparar la consulta para seleccionar todas las matrículas
    $query = "SELECT codigoE, codigoA, semestre, nota1, nota2, nota3, promedio FROM matricula";
    $stmt = $pdo->prepare($query);
    $stmt->execute();

    // Obtener los resultados en un arreglo asociativo
    $matriculas = $stmt->fetchAll(PDO::FETCH_ASSOC);

    // Enviar los resultados como respuesta en formato JSON
    echo json_encode($matriculas);

} catch (PDOException $e) {
    // Enviar mensaje de error en caso de fallo
    echo json_encode(["error" => $e->getMessage()]);
}
?>
