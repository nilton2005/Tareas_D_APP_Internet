<?php

// Start session
session_start();

// Database connection
$pdo = new PDO(
     'mysql:host=127.0.0.1;dbname=loginagentesecreto',
     'root',
     ''); 

// Function to validate user input
function validateInput($data) {
    // Remove leading and trailing whitespaces
    $data = trim($data);
    // Convert special characters to HTML entities to prevent XSS attacks
    $data = htmlspecialchars($data);
    return $data;
}

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Validate username and password
    $agente_ID = validateInput($_POST['agente_ID']);
    $password = validateInput($_POST['password']);

    // Hash the password
    $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

    // Check user credentials against the database
    $stmt = $pdo->prepare("SELECT * FROM agentes WHERE agente_ID = ?");
    $stmt->execute([$agente_ID]);
    $user = $stmt->fetch();

    // Verify password hash
    if ($user && password_verify($password, $user['password'])) {
        // Set session variables
        $_SESSION['agente_ID'] = $user['agente_ID'];
        // Redirect to dashboard
        header("Location: Bienvenida.php");
        exit();
    } else {
        // Invalid username or password

        echo "debug: usauro econtrado";
        var_dump($user);
        echo"Debug: contraseña";
        var_dump(password_verify($password, $user['password']));
        $error = "Usuario o contraseña inválidos.";
    }
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
</head>
<body>
    <h2>Login</h2>
    <?php if(isset($error)) echo "<p style='color: red;'>$error</p>"; ?>
    <form method="post" action="<?=htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
    <form method="post" action="<?=htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
        <label for="username">ID del Agente: </label><br>
        <input type="text" id="username" name="username"><br><br>
        <label for="password">Password:</label><br>
        <input type="password" id="password" name="password"><br><br>
        <input type="submit" value="Login">
    </form>
<style>
    body {
        font-family: Arial, sans-serif;
        background-color: #f4f4f4;
        margin: 0;
        padding: 0;
    }

    h2 {
        color: #333;
    }

    form {
        max-width: 300px;
        margin: 20px auto;
        padding: 20px;
        background: #fff;
        border-radius: 5px;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
    }

    label {
        display: block;
        margin-bottom: 5px;
    }

    input[type="text"],
    input[type="password"],
    input[type="departamento_ID"],
    input[type="descripcion_mision"],
    input[type="nombre"],
    input[type="numero_misiones"],
    input[type="submit"] {
        width: 100%;
        padding: 8px;
        margin-bottom: 10px;
        box-sizing: border-box;
    }

    input[type="submit"] {
        background: #333;
        color: #fff;
        border: none;
        cursor: pointer;
    }

    input[type="submit"]:hover {
        background: #555;
    }

    body {
        font-family: Arial, sans-serif;
        background-color: #333;
        color: #fff;
        margin: 0;
        padding: 0;
    }

    h2 {
        color: #ff0000;
    }

    form {
        max-width: 300px;
        margin: 20px auto;
        padding: 20px;
        background: #000;
        border-radius: 5px;
        box-shadow: 0 0 10px rgba(255, 0, 0, 0.5);
    }

    label {
        display: block;
        margin-bottom: 5px;
        color: #ff0000;
    }

    input[type="text"],
    input[type="password"],
    input[type="departamento_ID"],
    input[type="descripcion_mision"],
    input[type="nombre"],
    input[type="numero_misiones"],
    input[type="submit"] {
        width: 100%;
        padding: 8px;
        margin-bottom: 10px;
        box-sizing: border-box;
    }

    input[type="submit"] {
        background: #ff0000;
        color: #fff;
        border: none;
        cursor: not-allowed;
    }

    input[type="submit"]:hover {
        background: #555;
    }


</style>

</body>
</html>

