<?php
// controlador_estudiantes.php

function obtener_estudiantes() {
    $api_url = "http://localhost/api/persistencia/get-estudiante.php"; // URL de la API de estudiantes
    $response = file_get_contents($api_url); // Llamada a la API
    return json_decode($response, true); // Decodificar la respuesta JSON
}

function obtener_matriculas() {
    $api_url = "http://localhost/api/persistencia/get-matricula.php"; // URL de la API de matrículas
    $response = file_get_contents($api_url); // Llamada a la API
    return json_decode($response, true); // Decodificar la respuesta JSON
}

function obtener_asignaturas() {
    $api_url = "http://localhost/api/persistencia/get-asignatura.php"; // URL de la API de asignaturas
    $response = file_get_contents($api_url); // Llamada a la API
    return json_decode($response, true); // Decodificar la respuesta JSON
}

function obtener_estudiantes_biologia($estudiantes, $matriculas) {
    $estudiantes_biologia = [];
    
    foreach ($matriculas as $matricula) {
        if ($matricula['asignatura'] == 'Biología') { // Filtrar por Biología
            $id_estudiante = $matricula['id_estudiante'];
            
            // Buscar el estudiante en la lista de estudiantes
            foreach ($estudiantes as $estudiante) {
                if ($estudiante['id'] == $id_estudiante) {
                    $estudiantes_biologia[] = $estudiante; // Agregar estudiante a la lista de Biología
                    break;
                }
            }
        }
    }

    return $estudiantes_biologia;
}

function calcular_promedio_asignaturas($matriculas, $asignaturas) {
    $promedios = [];

    foreach ($asignaturas as $asignatura) {
        $id_asignatura = $asignatura['id'];
        $suma_notas = 0;
        $total_estudiantes = 0;

        // Recorrer las matrículas para sumar las notas de cada asignatura
        foreach ($matriculas as $matricula) {
            if ($matricula['id_asignatura'] == $id_asignatura) {
                $suma_notas += $matricula['nota'];
                $total_estudiantes++;
            }
        }

        if ($total_estudiantes > 0) {
            // Calcular el promedio
            $promedio = $suma_notas / $total_estudiantes;
            $promedios[$asignatura['nombre']] = $promedio;
        }
    }

    return $promedios;
}

// Obtener los datos de la API
$estudiantes = obtener_estudiantes();
$matriculas = obtener_matriculas();
$asignaturas = obtener_asignaturas();

// Obtener los estudiantes matriculados en Biología
$estudiantes_biologia = obtener_estudiantes_biologia($estudiantes, $matriculas);

// Calcular el promedio general de cada asignatura
$promedios_asignaturas = calcular_promedio_asignaturas($matriculas, $asignaturas);

// // Mostrar resultados
// echo "Estudiantes matriculados en Biología: \n";
// print_r($estudiantes_biologia);

// echo "\nPromedios por asignatura: \n";
// print_r($promedios_asignaturas);
?>