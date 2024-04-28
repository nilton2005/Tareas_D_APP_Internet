<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/1999/xhtml">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Editar Macotas</title>
</head>
<body>
<?php
$codigo = $_GET['Codigo'];

// Crear conexión
$conexion = new mysqli("localhost", "root", "", "baseda02");
if ($conexion->connect_error) {
    die("La conexión falló: " . $conexion->connect_error);
}

// Preparar la consulta
// La interrogante (?) en la consulta SQL es un marcador de posición para un parámetro que será vinculado posteriormente.
// Esto se utiliza para prevenir inyecciones SQL y para permitir que la base de datos precompile la consulta.
$stmt = $conexion->prepare("SELECT * FROM mascotas WHERE codigo = ?");
$stmt->bind_param("i", $codigo);

// Ejecutar y obtener resultados
$stmt->execute();
$resultado = $stmt->get_result();
$mascota = $resultado->fetch_assoc();


$stmt->close();
$conexion->close();
?>

<form method="post" action="modificar_mascotas.php">
    Codigo: <input name="xcodigo" size="15" value=" <?php echo $mascota['Codigo']; ?>" readonly="readonly"/><br />
    Nombre: <input name="xnombre" size="15" value=" <?php echo $mascota['Nombre']; ?>"/><br />
    Tipo: <input name="xtipo" size="15" value=" <?php echo $mascota['Tipo']; ?>"/><br />
    Sexo: <input name="xsexo" size="15" value=" <?php echo $mascota['Sexo']; ?>"/><br />
    Fecha_Nacimiento: <input name="xf_naci" size="15", value = " <?php echo $mascota['Fecha_nac']; ?>" /><br />
    <input type="submit" value="Grabar Cambios" />
</form>



<style>
    form {
        border: 1px solid #ced4da;
        padding: 20px;
        border-radius: 0.25rem;
        background-color: #424769;
        box-shadow: 0 4px 8px 0 rgba(0,0,0,0.2);
        transition: 0.3s;
        width: 50%;
        margin: 0 auto;
        display: block;
    }
    input {
        margin-bottom: 20px; 
        height: 30px; 
        font-size: 16px; 
        display: flex;
        flex-direction: column;
        background-color: #67649d;
        border: none; 
    }
    input[type="submit"] {
        box-shadow: 0 0 5px cyan, 0 0 25px cyan;
        transition: box-shadow 0.3s ease-in-out;
        background-color: cyan;
        border: none;
    }
    input[type="submit"]:hover {
        box-shadow: 0 0 5px cyan, 0 0 25px cyan, 0 0 50px cyan, 0 0 100px cyan, 0 0 200px cyan;
    }
    body {
        background-color: #2d3250;
        color: #f6b17a;
        font-size: larger; 
        font-weight: bold; 
  
    }
    h1 {
            color: #f6b17a;
            text-align: center;
            margin-top: 20px;
        }

</style>

</body>
</html>