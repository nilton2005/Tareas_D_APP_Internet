<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/1999/xhtml">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Editar Vehículo</title>
</head>
<body>
<?php
$placa = $_GET['placa'];

// Crear conexión
$conexion = new mysqli("localhost", "root", "", "db3");
if ($conexion->connect_error) {
    die("La conexión falló: " . $conexion->connect_error);
}

// Preparar la consulta
// La interrogante (?) en la consulta SQL es un marcador de posición para un parámetro que será vinculado posteriormente.
// Esto se utiliza para prevenir inyecciones SQL y para permitir que la base de datos precompile la consulta.
$stmt = $conexion->prepare("SELECT * FROM vehiculos1 WHERE placa = ?");
$stmt->bind_param("s", $placa);

// Ejecutar y obtener resultados
$stmt->execute();
$resultado = $stmt->get_result();
$vehiculo = $resultado->fetch_assoc();


$stmt->close();
$conexion->close();
?>

<form method="post" action="modificar_vehiculo.php">
    // La variable $vehiculo contiene los datos del vehículo obtenidos de la base de datos, y aquí se está utilizando para mostrar la placa del vehículo en un campo de entrada de formulario que es de solo lectura.
    Modelo: <input name="xmo" size="40" value=" <?php echo $vehiculo['modelo']; ?>"/><br />
    Marca: <input name="xma" size="30" value=" <?php echo $vehiculo['marca']; ?>"/><br />
    Año: <input name="xan" size="10" value=" <?php echo $vehiculo['anio']; ?>"/><br />
    <input type="submit" value="Grabar Cambios" />
</form>

<style>
    body {
        color: white; 
        background-color: black;
        font-size: 150%; 
        font-weight: bold;
        
    }
    input, select, textarea {
        border: 1px solid red;
        width: 100%; 
        margin-bottom: 10px;
    }
    input[type=submit] {
        background-color: red;
        color: white;
        padding: 10px 20px;
        border: none;
        cursor: pointer;
        margin-top: 20px;
    }

</style>
</body>
</html>