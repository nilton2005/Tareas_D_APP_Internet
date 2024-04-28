<?php
# Conectadon a la BD
$conectando_BD = new mysqli("localhost", "root","", "baseda02");


# veificamos la correcta conexion:
if ($conectando_BD->connect_error) {
    die("la conexion falló: ". $conectando_BD ->connect_error);
}


# Ejecutamos la consultado SQL para mostrar la tabla

$mostrarMascotasSTMT = $conectando_BD->prepare("SELECT * FROM mascotas");
$mostrarMascotasSTMT->execute();
$resultado = $mostrarMascotasSTMT->get_result();

#  Bisualizar y procesar
echo "<br><a href='FormMascotas.html'>Nueva Mascota</a>";
echo "<table border='1'><tr><th>Codigo</th><th>Tipo</th><th>Nombre</th><th>Sexo</th><th>Fecha de Nacimiento</th></tr>";

while ($fila = $resultado->fetch_assoc()) {
echo "<tr>";
echo "<td>" . htmlspecialchars($fila['Codigo']) . "</td>";
echo "<td>" . htmlspecialchars($fila['Tipo']) . "</td>";
echo "<td>" . htmlspecialchars($fila['Nombre']) . "</td>";
echo "<td>" . htmlspecialchars($fila['Sexo']) . "</td>";
echo "<td>" . htmlspecialchars($fila['Fecha_nac']) . "</td>";
echo "<td><a href='Editar_mascota.php? Codigo=" . urlencode($fila['Codigo']) . "'>Editar</a></td>";
echo "<td><a href='Eliminar_mascota.php? Codigo=" . urlencode($fila['Codigo']) . "'>Eliminar</a></td>";
echo "</tr>";
}
# Estilo a link
echo "<style>";
echo "a {";
echo "    box-shadow: 0 0 5px cyan, 0 0 25px cyan;";
echo "    transition: box-shadow 0.3s ease-in-out;";
echo "    background-color: cyan;";
echo "    color: #696E79;";
echo "    padding: 5px 10px;";
echo "    text-decoration: none;";
echo "    border-radius: 5px;";
echo "    margin: 4px;";
echo "    display: inline-block;";
echo "    font-size: 1.5rem;";
echo "}";
echo "a:hover {";
echo "    box-shadow: 0 0 5px cyan, 0 0 25px cyan, 0 0 50px cyan;";
echo "}";
echo "body {";
echo "    background-color: #6476b5;"; 
echo "    color: #f6b17a;";
# Estilo tabla
echo "table {";
echo "    border-collapse: collapse;";
echo "    width: 100%;";
echo "    font-size:2rem;";
echo "}";
echo "th, td {";
echo "    text-align: left;";
echo "    padding: 8px;";
echo "}";
echo "tr:nth-child(even) {";
echo "    background-color: #f2f2f2;";
echo "}";
echo "th {";
echo "    background-color: #2d3250;";
echo "    color: white;";
echo "}";
echo "table, th, td {";
echo "    border: 1px solid #ffffff;";
echo "}";

echo "}";

echo "</style>";

?>

