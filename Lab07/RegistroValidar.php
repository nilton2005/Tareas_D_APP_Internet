<?php
// Conexión a la base de datos
$pdo = new PDO('mysql:host=127.0.0.1;dbname=login', 'root', '');

// Función para validar la entrada del usuario
function validateInput($data) {
    $data = trim($data);
    $data = htmlspecialchars($data);
    return $data;
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = validateInput($_POST['username']);
    $password = validateInput($_POST['password']);

    // Hashear la contraseña
    $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

    // Insertar el usuario en la base de datos
    $stmt = $pdo->prepare("INSERT INTO users (username, password) VALUES (?, ?)");
    $stmt->execute([$username, $hashedPassword]);

    
}
?>
<a href='Ejercicio1.php'>Iniciar sesión</a>";

echo "<!DOCTYPE html>
<html lang='es'>
<head>
    <meta charset='UTF-8'>
    <meta name='viewport' content='width=device-width, initial-scale=1.0'>
    <title>Registro de Usuario</title>
</head>
<body>
    <h2>Registro de Usuario</h2>
    <form method='post' action='RegistroValidar.php'>
        <label for='username'>Nombre de usuario:</label><br>
        <input type='text' id='username' name='username'><br><br>
        <label for='password'>Contraseña:</label><br>
        <input type='password' id='password' name='password'><br><br>
        <input type='submit' value='Registrar'>
    </form>
</body>
</html>";
