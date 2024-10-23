<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Estudiantes Matriculados en Biología</title>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>
<body>
    <div class="container">
        <h2 class="my-4">Estudiantes Matriculados en Biología</h2>
        <canvas id="myChart" width="400" height="200"></canvas>
    </div>

    <script>
        // Datos de los estudiantes obtenidos del controlador PHP
        var students = <?php echo json_encode($students); ?>;
        var ctx = document.getElementById('myChart').getContext('2d');
        var myChart = new Chart(ctx, {
            type: 'bar',
            data: {
                labels: students,
                datasets: [{
                    label: 'Estudiantes en Biología',
                    data: students.map(() => 1), // Cada estudiante cuenta como 1
                    backgroundColor: 'rgba(75, 192, 192, 0.2)',
                    borderColor: 'rgba(75, 192, 192, 1)',
                    borderWidth: 1
                }]
            },
            options: {
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });
    </script>
</body>
</html>