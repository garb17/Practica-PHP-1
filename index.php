<?php

session_start();
$result="";
$flag=false;

if(isset($_POST['btn']) && $_POST['btn'] == 'Registrar'){
    if(isset($_POST['nombre'])&&isset($_POST['apellido'])&&isset($_POST['edad'])&&isset($_POST['estado_civil'])&&isset($_POST['sexo'])&&isset($_POST['sueldo'])){
        if(!empty($_POST['nombre'])&&!empty($_POST['apellido'])&&!empty($_POST['edad'])&&!empty($_POST['estado_civil'])&&!empty($_POST['sexo'])&&!empty($_POST['sueldo'])){
            if(ctype_alpha($_POST['nombre'])&&ctype_alpha($_POST['apellido'])){
                if(is_numeric($_POST['edad'])){
                    if(ctype_digit($_POST['edad'])&&$_POST['edad']>=18 &&$_POST['edad']<=120){
                        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                            $empleado = [
                                'nombre' => $_POST['nombre'],
                                'apellido' => $_POST['apellido'],
                                'edad' => (int)$_POST['edad'],
                                'estado_civil' => $_POST['estado_civil'],
                                'sexo' => $_POST['sexo'],
                                'sueldo' => $_POST['sueldo'],
                            ];
                        
                            $_SESSION['empleados'][] = $empleado; 
                            $result='<div class="box margen" style="background-color: #567ebb"><p style="color: green; padding-top:1%">&nbsp;&nbsp;Datos ingresados exitosamenete.</p><div>';
                            $flag=true;
                        }
                            
                    }else{
                        $result='<div class="box margen" style="background-color: #567ebb"><p style="color: red; padding-top:1%">&nbsp;&nbsp;Edad no válida.</p></div>';
                        $flag=true;
                    } 
                }else{
                    $result='<div class="box margen" style="background-color: #567ebb"><p style="color: red; padding-top:1%">&nbsp;&nbsp;El campo edad debe ser un dato numérico.</p></div>';
                    $flag=true;
                } 
            }else{
                $result='<div class="box margen" style="background-color: #567ebb;"><p style="color: red; padding-top:1%">&nbsp;&nbsp;Los campos nombre y apellido deben ser caracteres alfabéticos.</p></div>';
                $flag=true;
            }
        }else{
            $result='<div class="box margen" style="background-color: #567ebb"><p style="color: red; padding-top:1%">&nbsp;&nbsp;Datos vacios. Complete todos los campos.</p></div>';
            $flag=true;
        }
    }else{
        $result='<div class="box margen" style="background-color: #567ebb"><p style="color: red; padding-top:1%">&nbsp;&nbsp;No se enviaron los datos.</p></div>';
        $flag=true;
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
                <div class="row">
                    <h1 class="display-5 text-center">Registrar empleados</h1>
                </div>
                <div class="margen">
                    <form action="" method="post">
                    <div class="row">
                        <div class="col-md-4 col-sm-12">
                            <div class="mb-1">
                                <label for="nombre">Nombre:</label>
                                <input type="text" name="nombre" required>
                            </div>
                        </div>
                        <br><br>
                        <div class="col-md-4 col-sm-12">
                            <div class="mb-3">
                                <label for="apellido">Apellido:</label>
                                <input type="text" name="apellido" required>
                            </div>
                        </div>
                        <br><br>
                        <div class="col-md-4 col-sm-12">
                            <div class="mb-3">
                                <label for="edad">Edad:</label>
                                <input type="text" name="edad" required>
                            </div>
                        </div>
                    </div>
                    <br>
                    <div class="row">
                        <div class="col-md-4 col-sm-12">
                            <div class="mb-3">
                            <label for="estado_civil">Estado Civil:</label>
                                <select name="estado_civil">
                                    <option value="Soltero(a)">Soltero(a)</option>
                                    <option value="Casado(a)">Casado(a)</option>
                                    <option value="Viudo(a)">Viudo(a)</option>
                                </select><br>
                            </div>
                        </div>
                        <div class="col-md-4 col-sm-12">
                            <div class="mb-3">
                                <label for="sexo">Sexo:</label>
                                <input type="radio" name="sexo" value="Femenino" required>Femenino
                                <input type="radio" name="sexo" value="Masculino" required>Masculino<br>
                            </div>
                        </div>
                        <div class="col-md-4 col-sm-12">
                            <div class="mb-3">
                                <label for="sueldo">Sueldo:</label>
                                <select name="sueldo">
                                    <option value="Menos de 1000 Bs.">Menos de 1000 Bs.</option>
                                    <option value="Entre 1000 y 2500 Bs.">Entre 1000 y 2500 Bs.</option>
                                    <option value="Más de 2500 Bs.">Más de 2500 Bs.</option>
                                </select><br>
                            </div>
                        </div>
                    </div>
                    <br>
                    <div class="row boton">
                        <div class="col-md-5">
                        </div>
                        <div class="col-md-2 col-sm-12 boton">
                            <input type="submit" value="Registrar" name="btn">
                        </div>
                        <div class="col-md-2 col-sm-12">
                        </div>
                        <br>
                        <div class="col-md-3 col-sm-12 boton">
                            <div class="margen-boton">
                                <a href="consultar.php">Consultar Empleados</a>
                            </div>
                        </div>
                    </div>
                    
                    </form>

                </div>
            </div>

            <?php
                if($flag==true){
                    echo $result;
                }
            ?>
        </div>
    </div> 
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
</body>
</html>