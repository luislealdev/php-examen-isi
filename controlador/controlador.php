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

function obtener_estudiantes_biologia($estudiantes, $matriculas, $asignaturas) {
    $estudiantes_biologia = [];
    
    // Encontrar la asignatura de Biología
    $codigo_biologia = null;
    foreach ($asignaturas as $asignatura) {
        if ($asignatura['nombre'] == 'Biología') {
            $codigo_biologia = $asignatura['codigoA'];
            break;
        }
    }

    // Filtrar estudiantes matriculados en Biología
    if ($codigo_biologia !== null) {
        foreach ($matriculas as $matricula) {
            if ($matricula['codigoA'] == $codigo_biologia) { // Filtrar por Biología
                $codigo_estudiante = $matricula['codigoE'];
                
                // Buscar el estudiante en la lista de estudiantes
                foreach ($estudiantes as $estudiante) {
                    if ($estudiante['codigoE'] == $codigo_estudiante) {
                        $estudiantes_biologia[] = $estudiante; // Agregar estudiante a la lista de Biología
                        break;
                    }
                }
            }
        }
    }

    return $estudiantes_biologia;
}

function calcular_promedio_asignaturas($matriculas, $asignaturas) {
    $promedios = [];

    foreach ($asignaturas as $asignatura) {
        $codigo_asignatura = $asignatura['codigoA'];
        $suma_promedios = 0;
        $total_estudiantes = 0;

        // Recorrer las matrículas para sumar los promedios de cada asignatura
        foreach ($matriculas as $matricula) {
            if ($matricula['codigoA'] == $codigo_asignatura) {
                // Calcular el promedio de las notas
                $nota1 = floatval($matricula['nota1']);
                $nota2 = floatval($matricula['nota2']);
                $nota3 = floatval($matricula['nota3']);
                $promedio = ($nota1 + $nota2 + $nota3) / 3;

                $suma_promedios += $promedio;
                $total_estudiantes++;
            }
        }

        if ($total_estudiantes > 0) {
            // Calcular el promedio general de la asignatura
            $promedio_general = $suma_promedios / $total_estudiantes;
            $promedios[$asignatura['nombre']] = $promedio_general;
        }
    }

    return $promedios;
}

// Obtener los datos de la API
$estudiantes = obtener_estudiantes();
$matriculas = obtener_matriculas();
$asignaturas = obtener_asignaturas();

// Obtener los estudiantes matriculados en Biología
$estudiantes_biologia = obtener_estudiantes_biologia($estudiantes, $matriculas, $asignaturas);

// Calcular el promedio general de cada asignatura
$promedios_asignaturas = calcular_promedio_asignaturas($matriculas, $asignaturas);
?>