<?php
session_start();

// Credenciales hardcoded (usuario: admin, contraseña: admin)
$users = [
    'admin' => password_hash('admin', PASSWORD_DEFAULT)
];

// Procesar el formulario si se envía
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $_POST['username'] ?? '';
    $password = $_POST['password'] ?? '';

    // Verificar si el usuario existe y la contraseña es correcta
    if (isset($users[$username]) && password_verify($password, $users[$username])) {
        $_SESSION['username'] = $username;
        header("Location: ?success=1");
        exit();
    } else {
        $error = "Invalid username or password";
    }
}

// Cerrar sesión si se solicita
if (isset($_GET['logout'])) {
    session_unset();
    session_destroy();
    header("Location: ?");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Log In</title>
    <style>
        body {
            background-color: #000;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
            text-align: center;
            font-family: monospace;
            color: #fff;
        }
        .container {
            background: rgba(20, 20, 20, 0.8);
            padding: 40px;
            border-radius: 12px;
            border: 2px solid #00ff00;
            box-shadow: 0 0 20px rgba(0, 255, 0, 0.5);
            width: 400px; /* Wider for PC screens */
        }
        h2 {
            font-size: 48px; /* Larger for PC */
            margin: 10px 0;
            text-shadow: 0 0 8px rgba(255, 255, 255, 0.6);
        }
        input {
            width: 100%;
            margin: 15px 0;
            padding: 15px;
            background: #1a1a1a;
            border: 2px solid #00ff00;
            border-radius: 8px;
            color: #fff;
            font-family: monospace;
            font-size: 1.2rem; /* Larger for PC */
            box-sizing: border-box;
            transition: box-shadow 0.3s ease;
        }
        input:focus {
            outline: none;
            box-shadow: 0 0 15px #00ff00;
        }
        button {
            font-family: 'Lucida Sans', 'Lucida Sans Regular', 'Lucida Grande', 'Lucida Sans Unicode', Geneva, Verdana, sans-serif;
            font-size: 1.8rem; /* Larger for PC */
            font-weight: bold;
            color: #fff;
            background: linear-gradient(45deg, #8a2be2, #00ff00);
            border: 3px solid #00ff00;
            padding: 15px 50px;
            border-radius: 12px;
            cursor: pointer;
            box-shadow: 0 0 15px #00ff00, 0 0 30px #8a2be2;
            transition: transform 0.3s ease, box-shadow 0.3s ease;
            animation: pulse 2s infinite;
            margin-top: 20px;
            width: 100%;
        }
        button:hover {
            transform: scale(1.1);
            box-shadow: 0 0 25px #00ff00, 0 0 50px #8a2be2;
            background: linear-gradient(45deg, #00ff00, #8a2be2);
        }
        button:active {
            transform: scale(0.95);
        }
 .error {
            color: #ff4d4d;
            font-size: 1.2rem;
            margin-top: 10px;
            text-shadow: 0 0 5px #ff4d4d;
        }
        @keyframes pulse {
            0% { transform: scale(1); }
            50% { transform: scale(1.05); }
            100% { transform: scale(1); }
        }
        @media (max-width: 1366px) {
            .container {
                width: 350px;
            }
            h2 {
                font-size: 40px;
            }
            input, button {
                font-size: 1.1rem;
                padding: 12px;
            }
        }
    </style>
</head>
<body>
    <div class="container">
        <?php if (isset($_SESSION['username'])): ?>
            <h2>Welcome, <?php echo htmlspecialchars($_SESSION['username']); ?>!</h2>
            <a href="?logout=1"><button>Log Out</button></a>
        <?php elseif (isset($_GET['success'])): ?>
            <h2>Login Successful!</h2>
            <a href="?logout=1"><button>Log Out</button></a>
        <?php else: ?>             <h2>Log In</h2>
            <form method="POST">
                <input type="text" name="username" placeholder="Username" required>
                <input type="password" name="password" placeholder="Password" required>
                <button type="submit">Log In</button>
            </form>
            <?php if (isset($error)): ?>
                <p class="error"><?php echo $error; ?></p>
            <?php endif; ?>
        <?php endif; ?>
    </div>
</body>
</html>