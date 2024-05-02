<?php
// Conexión a la base de datos
$pdo = new PDO('mysql:host=127.0.0.1;dbname=loginagentesecreto', 'root', '');


function validateInput($data) {
    $data = trim($data);
    $data = htmlspecialchars($data);
    return $data;
}

$departamento_ID = validateInput($_POST['departamento_ID']);
$descripcion_mision = validateInput($_POST['descripcion_mision']);
$nombre = validateInput($_POST['nombre']);
$numero_misiones = validateInput($_POST['numero_misiones']);


if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $agente_ID = validateInput($_POST['agente_ID']);
    $password = validateInput($_POST['password']);

    // Hasheamos la contraseña 
    $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

    // Insertamos al agente a la BD
    $stmt = $pdo->prepare("INSERT INTO agentes (agente_ID, password) VALUES (?, ?)");
    $stmt->execute([$agente_ID, $hashedPassword]);

    
}
?>


<a href='login.php'>Iniciar sesión</a>";

<style>
    body {
        background-color: black;
        color: white;
        font-family: Arial, sans-serif;
        text-align: center;
        padding: 20px;
        border: 2px solid red;
        border-radius: 10px; 
        box-shadow: 5px 5px 5px grey; 
    }
</style>";
