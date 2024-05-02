<?php

// Start session
session_start();

// Database connection
$pdo = new PDO(
     'mysql:host=127.0.0.1;dbname=login',
     'root',
     ''); // Usuario 'root' y sin contraseña$pdo = new PDO

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
    $username = validateInput($_POST['username']);
    $password = validateInput($_POST['password']);

    // Hash the password
    $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

    // Check user credentials against the database
    $stmt = $pdo->prepare("SELECT * FROM users WHERE username = ?");
    $stmt->execute([$username]);
    $user = $stmt->fetch();

    // Verify password hash
    if ($user && password_verify($password, $user['password'])) {
        // Set session variables
        $_SESSION['username'] = $user['username'];
        // Redirect to dashboard
        header("Location: dashboard.php");
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
        <label for="username">Username:</label><br>
        <input type="text" id="username" name="username"><br><br>
        <label for="password">Password:</label><br>
        <input type="password" id="password" name="password"><br><br>
        <input type="submit" value="Login">
    </form>
</body>
</html>

