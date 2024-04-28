<?php
$placa = $_GET['placa'];

// Crear conexión
$conexion = new mysqli("localhost", "root", "", "db3");
if ($conexion->connect_error) {
die("La conexión falló: " . $conexion->connect_error);

}

// Preparar la consulta para prevenir inyección SQL
$stmt = $conexion->prepare("DELETE FROM vehiculos1 WHERE placa = ?");
$stmt->bind_param("s", $placa);

// Ejecutar la consulta
if ($stmt->execute()) {
#echo "Vehículo $placa eliminado correctamente.";
} else {
echo "Error al eliminar el vehículo: " . $conexion->error;

}



// Cerrar conexión
$stmt->close();
$conexion->close();

echo "<div style='color: white; background-color: black; font-size: 2em; text-align: center; height: 100vh; display: flex; justify-content: center; align-items: center; flex-direction: column;'>";
echo "Vehículo $placa eliminado correctamente.";
echo "<div style='margin-top: 20px;'><a href='lista_vehiculos.php' style='color: white; background-color: red; padding: 10px; text-decoration: none; border-radius: 5px;'>Volver al listado</a></div>";
echo "</div>";


?>

