<?php
// Asumiendo que los campos del formulario son 'xpl', 'xmo', 'xma', 'xan'.
$placa = $_POST['xpl'];
$modelo = $_POST['xmo' ];
$marca = $_POST['xma' ];
$anio = $_POST['xan'];

// Utiliza 'mysqli' con consultas preparadas para mayor seguridad.
$conexion = new mysqli("localhost", "root", "", "db3");
if ($conexion->connect_error) {
    die("Conexión fallida: " . $conexion->connect_error);

}

// Preparar la consulta SQL para evitar inyección SQL
$stmt = $conexion->prepare("INSERT INTO vehiculos1 (placa, modelo, marca, anio) VALUES (?, ?, ?, ?)");
$stmt->bind_param("sssi", $placa, $modelo, $marca, $anio);

// Ejecutar la consulta
if ($stmt->execute()) {
    #echo "Registro grabado correctamente ";
    #echo "<p><a href='lista_vehiculos.php'>Volver al listado</a></p>";
} else {
    #echo "Error: " . $stmt->error;

}

// Cerrar la conexión
$stmt->close();
$conexion->close();

echo "<div style='color: white; background-color: black; font-size: 2em; text-align: center; height: 100vh; display: flex; justify-content: center; align-items: center; flex-direction: column;'>";
echo "Registro grabado correctamente.";
echo "<div style='margin-top: 20px;'><a href='lista_vehiculos.php' style='color: white; background-color: red; padding: 10px; text-decoration: none; border-radius: 5px;'>Volver al listado</a></div>";
echo "</div>";

?>