<?php
session_start();

function filtrarFemenino($empleado) {
    return $empleado['sexo'] === 'Femenino';
}

function filtrarMCA($empleado) {
    return $empleado['sexo'] === 'Masculino' && $empleado['estado_civil'] === 'Casado(a)' && $empleado['sueldo'] === 'Más de 2500 Bs.';
}

function filtrarFVMA($empleado) {
    return $empleado['sexo'] === 'Femenino' && $empleado['estado_civil'] === 'Viudo(a)' && ($empleado['sueldo'] === 'Más de 2500 Bs.' || $empleado['sueldo'] === 'Entre 1000 y 2500 Bs.');
}

function calculaPromedioEdadH($empleados) {
    $totalAge = array_reduce($empleados, function($carry, $empleado) {
        return $carry + $empleado['edad'];
    }, 0);
    
    if($totalAge==0){
        return 0;
    }else{
        return round($totalAge / count($empleados));
    }
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Practica PHP 1</title>
    <link rel="stylesheet" href="assets/css/style.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
</head>
<body>
    <div class="container margen">
        <div class="box">
            <div class="box margen" style="background-color: #567ebb">
            
                <?php
                    if (isset($_SESSION['empleados'])) {
                        $empleados = $_SESSION['empleados'];

                        $totalFemales = count(array_filter($empleados, 'filtrarFemenino'));
                        $totalMarriedHighSalaryMales = count(array_filter($empleados, 'filtrarMCA'));
                        $totalWidowHighSalaryFemales = count(array_filter($empleados, 'filtrarFVMA'));
                        $averageAgeOfMales = calculaPromedioEdadH(array_filter($empleados, function($empleado) {
                            return $empleado['sexo'] === 'Masculino';
                        }));

                        echo "<div class=\"row\"><h1 class=\"display-5 text-center\">Consultar empleados</h1></div>";
                        echo "<p>&nbsp;&nbsp;&nbsp;Total de empleados del sexo femenino: $totalFemales</p>";
                        echo "<p>&nbsp;&nbsp;&nbsp;Total de hombres casados que ganan más de 2500 Bs: $totalMarriedHighSalaryMales</p>";
                        echo "<p>&nbsp;&nbsp;&nbsp;Total de mujeres viudas que ganan más de 1000 Bs: $totalWidowHighSalaryFemales</p>";
                        echo "<p>&nbsp;&nbsp;&nbsp;Edad promedio de los hombres: $averageAgeOfMales años</p>";
                    } else {
                        echo "<div class=\"row\"><h1 class=\"display-5 text-center\">Consultar Empleados</h1></div>";
                        echo "<p>&nbsp;&nbsp;&nbsp;No hay empleados registrados en el sistema</p>";
                    }
                ?>
                <br>
                <div class="row ">

                    <div class="col-md-3 col-sm-12 boton"></div>

                    <div class="col-md-2 col-sm-12 boton">
                        <div class="margen-boton">
                            <a href="index.php">Regresar</a>
                        </div>
                    </div>

                <div class="col-md-1 col-sm-12"><br></div>

                    <div class="col-md-3 col-sm-12 boton">
                        <div class="margen-boton">
                            <a href="borrarRegistro.php">Eliminar registro</a>
                        </div>
                    </div>
                </div>
                <br>
            </div> 
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script> 
</body>
</html>