<?php
// config.php
$host = "localhost";
$db_name = "unicartagena";
$usuario = "root";
$password = "";

try {
    // Crear una nueva conexión PDO
    $pdo = new PDO("mysql:host=$host;dbname=$db_name", $usuario, $password);
    // Configurar PDO para que lance excepciones en caso de error
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    // En caso de error, mostrar el mensaje
    echo "Error en la conexión: " . $e->getMessage();
    exit;
}
?>
