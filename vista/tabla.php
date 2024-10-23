<?php 
require_once('../controlador/controlador.php');
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Estudiantes Matriculados en Biología</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
    <div class="container">
        <h2 class="my-4">Estudiantes Matriculados en Biología</h2>
        <table class="table table-bordered table-striped">
            <thead>
                <tr>
                    <th>Nombre del Estudiante</th>
                    <!-- <th>Código del Estudiante</th> -->
                </tr>
            </thead>
            <tbody>
                <?php if (!empty($estudiantes_biologia)): ?>
                    <?php foreach ($estudiantes_biologia as $estudiante): ?>
                        <tr>
                            <td><?php echo htmlspecialchars($estudiante['nombre']); ?></td>
                        </tr>
                    <?php endforeach; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="2">No se encontraron estudiantes matriculados en Biología</td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</body>
</html>