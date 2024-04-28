<?php
$codigo = $_GET['Codigo'];

// Crear conexión
$conexion = new mysqli("localhost", "root", "", "baseda02");
if ($conexion->connect_error) {
die("La conexión falló: " . $conexion->connect_error);

}

// Preparar la consulta para prevenir inyección SQL
$stmt = $conexion->prepare("DELETE FROM mascotas WHERE codigo = ?");
$stmt->bind_param("i", $codigo);

// Ejecutar la consulta
if ($stmt->execute()) {
#echo "Vehículo $placa eliminado correctamente.";
} else {
echo "Error al eliminar la mascota: " . $conexion->error;

}



// Cerrar conexión
$stmt->close();
$conexion->close();

echo "<div style='color: #f6b17a; background-color: #2d3250; font-size: 3rem; text-align: center; height: 100vh; display: flex; justify-content: center; align-items: center; flex-direction: column;'>";
echo "La mascota $codigo eliminado correctamente.";
echo "<div style='margin-top: 20px;'><a href='MostrarMascotas.php' style='box-shadow: 0 0 5px cyan, 0 0 25px cyan; transition: box-shadow 0.3s ease-in-out; background-color: cyan; color: white; padding: 10px; text-decoration: none; border-radius: 5px;'>Volver al listado</a></div>";
echo "</div>";


?>

