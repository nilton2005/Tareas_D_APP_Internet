<?php
#hoal
$codigo = $_POST['xcodigo'];
$nombre = $_POST['xnombre'];
$tipo = $_POST['xtipo'];
$sexo = $_POST['xsexo'];
$fecha_nac = $_POST['xf_naci'];


#Hacemos la conexcion a la BD
$conectando_BD = new mysqli("localhost","root","","baseda02");
if ($conectando_BD -> connect_error){
    die("Conexion fallida". $conectando_BD -> connect_error);
}

# Aqui preparamos nuestra consulta SQL, asi evitamso inserciones al SQL donde le damos un consuta de SQL para agregar datos pero no le damos aun, utiilzamos el metodo prepare de la clase mysqli_stmt.
$insercionDeMascotasSTM = $conectando_BD ->prepare("INSERT INTO mascotas(codigo,nombre, tipo, sexo, fecha_nac) VALUES(?, ?, ?, ?, ?)");

# Es aqui donde le damos los valore que tomaran las ?  pero como dato ya no doretamtemne desde un consulta a traves del metodo bind_param ademas los tipos de cada capo deve conicidir con la BD. 
$insercionDeMascotasSTM -> bind_param("isssi", $codigo, $nombre, $tipo, $sexo, $fecha_nac);

if ($insercionDeMascotasSTM->execute()){
    #echo"REGISTRO CORRECTAMENTE";
}else{
    echo "Erro lo ciento mucho". $insercionDeMascotasSTM->error;
}

$insercionDeMascotasSTM->close();
$conectando_BD->close();


echo "<div style='color: white; background-color: #2d3250; font-size: 2em; text-align: center; height: 50vh; display: flex; justify-content: center; align-items: center; flex-direction: column;'><h4 style='font-size: 2em; color: #f6b17a'>REGISTRO CORRECTAMENTE</h4></div>";

echo "<div style='color: white; background-color: #2d3250; font-size: 2em; text-align: center; height: 48vh; display: flex; justify-content: center; align-items: center; flex-direction: column;'>";
echo "<a href='MostrarMascotas.php' style='box-shadow: 0 0 5px cyan, 0 0 25px cyan; transition: box-shadow 0.3s ease-in-out; background-color: cyan; color: white; padding: 20px; text-decoration: none; border-radius: 5px; font-size: 1.5em;'>Volver al listado</a>";
echo "</div>";
