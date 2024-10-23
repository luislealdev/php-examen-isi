<?php 
require_once('../controlador/controlador.php');
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Promedio General por Asignatura</title>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>
<body>
    <div class="container">
        <h2 class="my-4">Promedio General de Cada Asignatura</h2>
        <canvas id="myChart" width="400" height="200"></canvas>
    </div>

    <script>
        // Datos de los promedios obtenidos del controlador PHP
        var subjects = <?php echo json_encode(array_keys($promedios_asignaturas)); ?>; // Nombres de las asignaturas
        var averages = <?php echo json_encode(array_values($promedios_asignaturas)); ?>; // Promedios de las asignaturas

        var ctx = document.getElementById('myChart').getContext('2d');
        var myChart = new Chart(ctx, {
            type: 'bar',
            data: {
                labels: subjects, // Etiquetas de asignaturas
                datasets: [{
                    label: 'Promedio General por Asignatura',
                    data: averages, // Valores de promedio por asignatura
                    backgroundColor: 'rgba(75, 192, 192, 0.2)',
                    borderColor: 'rgba(75, 192, 192, 1)',
                    borderWidth: 1
                }]
            },
            options: {
                scales: {
                    y: {
                        beginAtZero: true,
                        title: {
                            display: true,
                            text: 'Promedio'
                        }
                    }
                }
            }
        });
    </script>
</body>
</html>