<?php
$codigo = $_POST['xcodigo'];
$nombre = $_POST['xnombre' ];
$tipo = $_POST['xtipo'];
$sexo = $_POST['xsexo'];
$fecha = $_POST['xf_naci'];

// Crear conexión
$conexion = new mysqli("localhost", "root", "", "baseda02");
if ($conexion->connect_error) {
    die("Conexión fallida: " . $conexion->connect_error);
}
// Preparar la consulta para prevenir inyección SQL
$stmt = $conexion->prepare("UPDATE mascotas SET Nombre = ?, Tipo = ?, Sexo = ?, Fecha_nac = ? WHERE Codigo = ?");
$stmt->bind_param("sssii", $nombre, $tipo, $sexo, $fecha, $codigo);

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


echo "<div style='color: white; background-color: #2d3250; font-size: 2em; text-align: center; height: 100vh; display: flex; justify-content: center; align-items: center; flex-direction: column;'>";
echo "Registro modificado correctamente.";
echo "<div style='margin-top: 20px;'><a href='MostrarMascotas.php' style='box-shadow: 0 0 5px cyan, 0 0 25px cyan; transition: box-shadow 0.3s ease-in-out; background-color: cyan; color: white; padding: 10px; text-decoration: none; border-radius: 5px;'>Volver al listado</a></div>";
echo "</div>";




?>