<?php
$placa = $_POST['xpl'];
$modelo = $_POST['xmo' ];
$marca = $_POST['xma'];
$anio = $_POST['xan'];

// Crear conexión
$conexion = new mysqli("localhost", "root", "", "db3");
if ($conexion->connect_error) {
    die("Conexión fallida: " . $conexion->connect_error);
}
// Preparar la consulta para prevenir inyección SQL
$stmt = $conexion->prepare("UPDATE vehiculos1 SET modelo = ?, marca = ?, anio = ? WHERE placa = ?");
$stmt->bind_param("ssis", $modelo, $marca, $anio, $placa);

// Ejecutar la consulta
if ($stmt->execute()) {
//echo "Registro modificado correctamente.";
//echo "<p><a href='lista_vehiculos.php'>Volver al listado</a></p>";
} else {
    echo "Error al modificar el registro: " . $stmt->error;

}



// Cerrar conexión
$stmt->close();
$conexion->close();


echo "<div style='color: white; background-color: black; font-size: 2em; text-align: center; height: 100vh; display: flex; justify-content: center; align-items: center; flex-direction: column;'>";
echo "Registro modificado correctamente.";
echo "<div style='margin-top: 20px;'><a href='lista_vehiculos.php' style='color: white; background-color: red; padding: 10px; text-decoration: none; border-radius: 5px;'>Volver al listado</a></div>";
echo "</div>";




?>