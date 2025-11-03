
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Codehal - Sign In</title>
        <link rel="icon" href="view/img/buscar.png" type="image/x-icon">

    <!-- Fuente Poppins de Google Fonts -->
    <link href='https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800;900&display=swap' rel='stylesheet'>
    <!-- Boxicons CDN para los iconos -->
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Poppins', sans-serif;
            transition: all 0.3s ease;
        }

        body {
            min-height: 100vh;
            background-image: url('https://images.unsplash.com/photo-1568142402902-1298fe147da9?q=80&w=1243&auto=format&fit=crop&ixlib=rb-4.1.0&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D');
            background-size: cover;
            background-position: center;
            background-repeat: no-repeat;
            background-attachment: fixed;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            padding: 0;
            position: relative;
            overflow: hidden;
        }

        /* Overlay oscuro sobre la imagen de fondo del body */
        body::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, 0.3);
            z-index: 0;
        }

        /* Barra de navegación */
        .navbar {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 1.5rem 3rem;
            z-index: 10;
        }

        .navbar-links {
            display: flex;
            gap: 2rem;
        }

        .navbar-links a {
            color: white;
            text-decoration: none;
            font-weight: 500;
            font-size: 1rem;
            transition: color 0.3s ease;
        }

        .navbar-links a:hover {
            color: #fca5a5;
        }

        .search-box {
            position: relative;
            display: flex;
            align-items: center;
        }

        .search-input {
            background: rgba(255, 255, 255, 0.1);
            border: 1px solid rgba(255, 255, 255, 0.3);
            border-radius: 20px;
            padding: 0.5rem 1rem;
            padding-right: 2.5rem;
            color: white;
            font-size: 0.9rem;
            outline: none;
            transition: all 0.3s ease;
        }

        .search-input::placeholder {
            color: rgba(255, 255, 255, 0.7);
        }

        .search-input:focus {
            border-color: #fca5a5;
            box-shadow: 0 0 0 2px rgba(252, 165, 165, 0.3);
        }

        .search-icon {
            position: absolute;
            right: 0.8rem;
            color: white;
            font-size: 1.2rem;
        }

        .container {
            position: relative;
            z-index: 1;
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 2rem;
            width: 100%;
        }

        .main-card {
            background: rgba(255, 255, 255, 0.08); /* Fondo transparente */
            backdrop-filter: blur(15px); /* Efecto de cristal */
            border: 1px solid rgba(255, 255, 255, 0.15);
            border-radius: 20px;
            width: 100%;
            max-width: 900px;
            min-height: 500px;
            position: relative;
            padding: 2rem;
            box-shadow: 0 8px 32px rgba(0, 0, 0, 0.3);
            overflow: hidden;
            display: flex;
            flex-direction: column;
        }

        .card-inner-content {
            position: relative;
            z-index: 2;
            display: flex;
            flex-direction: column;
            flex-grow: 1;
            justify-content: space-between;
        }

        .card-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: auto;
        }

        .logo h1 {
            font-size: 1.5rem;
            font-weight: 700;
            color: white;
            text-shadow: 0 2px 4px rgba(0, 0, 0, 0.3);
        }

        .sign-in-title {
            color: white;
            font-size: 1.8rem;
            font-weight: 600;
            text-shadow: 0 2px 4px rgba(0, 0, 0, 0.3);
        }

        .card-content {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 4rem;
            align-items: end;
            flex-grow: 1;
            padding-top: 2rem;
        }

        .welcome-section {
            color: white;
        }

        .welcome-title {
            font-size: 3rem;
            font-weight: 700;
            margin-bottom: 0.5rem;
            line-height: 1.1;
            text-shadow: 0 2px 8px rgba(0, 0, 0, 0.5);
        }

        .welcome-subtitle {
            font-size: 1.5rem;
            font-weight: 500;
            margin-bottom: 1.5rem;
            text-shadow: 0 2px 4px rgba(0, 0, 0, 0.3);
        }

        .welcome-text {
            font-size: 1rem;
            color: rgba(255, 255, 255, 0.9);
            margin-bottom: 2rem;
            line-height: 1.6;
            font-weight: 400;
            text-shadow: 0 1px 2px rgba(0, 0, 0, 0.3);
        }

        .social-icons {
            display: flex;
            gap: 1rem;
        }

        .social-icon {
            color: rgba(255, 255, 255, 0.8);
            text-decoration: none;
            transition: all 0.3s ease;
            font-size: 1.5rem;
        }

        .social-icon:hover {
            color: white;
            transform: translateY(-2px);
        }

        .login-section {
            background: transparent;
            backdrop-filter: none;
            border: none;
            border-radius: 0;
            padding: 0;
            display: flex;
            flex-direction: column;
            gap: 1.5rem;
        }

        .form-group {
            position: relative;
            margin-bottom: 1.5rem;
        }

        .input-label {
            position: absolute;
            top: -1.2rem;
            left: 0;
            color: rgba(255, 255, 255, 0.9);
            font-size: 0.9rem;
            font-weight: 500;
            pointer-events: none;
            transition: all 0.3s ease;
        }

        .form-input {
            width: 100%;
            padding: 0.5rem 0;
            padding-right: 2.5rem; /* Espacio para el icono */
            background: transparent;
            border: none;
            border-bottom: 1px solid rgba(255, 255, 255, 0.5);
            border-radius: 0;
            color: white;
            font-size: 1rem;
            font-weight: 400;
            outline: none;
            transition: border-color 0.3s ease;
        }

        .form-input::placeholder {
            color: rgba(255, 255, 255, 0.7);
            font-weight: 300;
        }

        .form-input:focus {
            border-color: #ef4444;
            box-shadow: none;
            background: transparent;
        }

        .input-icon {
            position: absolute;
            right: 0.5rem; /* Icono a la derecha del input */
            top: 50%;
            transform: translateY(-50%);
            color: rgba(255, 255, 255, 0.7);
            font-size: 1.2rem;
            pointer-events: none;
        }

        .password-toggle {
            position: absolute;
            right: 0.5rem; /* Icono de ojo a la derecha */
            top: 50%;
            transform: translateY(-50%);
            background: none;
            border: none;
            color: rgba(255, 255, 255, 0.7);
            cursor: pointer;
            padding: 0;
            font-size: 1.2rem;
            z-index: 1;
        }

        .password-lock-icon {
            position: absolute;
            right: 2rem; /* Icono de candado a la izquierda del ojo */
            top: 50%;
            transform: translateY(-50%);
            color: rgba(255, 255, 255, 0.7);
            font-size: 1.2rem;
            pointer-events: none;
        }

        .password-toggle:hover {
            color: white;
        }

        .form-row {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-top: 0.5rem;
            margin-bottom: 1.5rem;
        }

        .checkbox-group {
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }

        .checkbox-group input[type="checkbox"] {
            width: 16px;
            height: 16px;
            background: rgba(255, 255, 255, 0.2);
            border: 1px solid rgba(255, 255, 255, 0.5);
            border-radius: 4px;
            appearance: none;
            cursor: pointer;
            position: relative;
            flex-shrink: 0;
        }

        .checkbox-group input[type="checkbox"]:checked {
            background-color: #ef4444;
            border-color: #ef4444;
        }

        .checkbox-group input[type="checkbox"]:checked::after {
            content: '\2713';
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            color: white;
            font-size: 0.8rem;
            font-weight: bold;
        }

        .checkbox-group label {
            color: rgba(255, 255, 255, 0.9);
            font-size: 0.9rem;
            font-weight: 400;
            cursor: pointer;
        }

        .forgot-link {
            color: rgba(255, 255, 255, 0.9);
            text-decoration: none;
            font-size: 0.9rem;
            font-weight: 400;
            transition: color 0.3s ease;
        }

        .forgot-link:hover {
            color: white;
        }

        .error-message {
            background: rgba(239, 68, 68, 0.2);
            border: 1px solid rgba(239, 68, 68, 0.5);
            border-radius: 10px;
            padding: 0.75rem;
            color: #fecaca;
            font-size: 0.875rem;
            font-weight: 400;
            display: none;
            margin-bottom: 1rem;
        }

        .error-message.show {
            display: block;
        }

        .success-message {
            background: rgba(34, 197, 94, 0.2);
            border: 1px solid rgba(34, 197, 94, 0.5);
            border-radius: 10px;
            padding: 0.75rem;
            color: #bbf7d0;
            font-size: 0.875rem;
            font-weight: 400;
            display: none;
            margin-bottom: 1rem;
        }

        .success-message.show {
            display: block;
        }

        .submit-btn {
            width: 100%;
            background: #ef4444;
            color: white;
            font-weight: 600;
            padding: 1rem;
            border: none;
            border-radius: 10px;
            font-size: 1rem;
            cursor: pointer;
            transition: all 0.3s ease;
            box-shadow: 0 4px 15px rgba(239, 68, 68, 0.3);
        }

        .submit-btn:hover {
            background: #dc2626;
            transform: translateY(-2px);
            box-shadow: 0 6px 20px rgba(239, 68, 68, 0.4);
        }

        .submit-btn:disabled {
            opacity: 0.5;
            cursor: not-allowed;
            transform: none;
        }

        .signup-link {
            text-align: center;
            color: rgba(255, 255, 255, 0.9);
            font-size: 0.9rem;
            font-weight: 400;
            margin-top: 1.5rem;
        }

        .signup-link a {
            color: white;
            text-decoration: none;
            font-weight: 500;
            transition: color 0.3s ease;
        }

        .signup-link a:hover {
            color: #fca5a5;
        }

        .demo-info {
            text-align: center;
            color: rgba(255, 255, 255, 0.7);
            font-size: 0.8rem;
            margin-top: 1rem;
            font-weight: 300;
        }

        .demo-info span {
            color: white;
            font-weight: 500;
        }

        .success-screen {
            position: relative;
            z-index: 2;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            text-align: center;
            color: white;
            flex-grow: 1;
            display: none; /* Oculto por defecto */
        }

        .success-screen.show {
            display: flex;
        }

        .success-title {
            font-size: 2.5rem;
            font-weight: 700;
            margin-bottom: 1rem;
            text-shadow: 0 2px 8px rgba(0, 0, 0, 0.5);
        }

        .success-text {
            color: rgba(255, 255, 255, 0.9);
            margin-bottom: 2rem;
            font-size: 1.1rem;
            font-weight: 400;
        }

        .logout-btn {
            background: #ef4444;
            color: white;
            font-weight: 600;
            padding: 1rem 2rem;
            border: none;
            border-radius: 8px;
            font-size: 1rem;
            cursor: pointer;
            transition: all 0.3s ease;
            text-decoration: none;
            display: inline-block;
            box-shadow: 0 4px 15px rgba(239, 68, 68, 0.3);
        }

        .logout-btn:hover {
            background: #dc2626;
            transform: translateY(-2px);
        }

        .loading {
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
        }

        .spinner {
            width: 1.25rem;
            height: 1.25rem;
            border: 2px solid rgba(255, 255, 255, 0.3);
            border-top: 2px solid white;
            border-radius: 50%;
            animation: spin 1s linear infinite;
        }

        @keyframes spin {
            0% { transform: rotate(0deg); }
            100% { transform: rotate(360deg); }
        }

        /* Responsive */
        @media (max-width: 768px) {
            .navbar {
                flex-direction: column;
                gap: 1rem;
                padding: 1rem 2rem;
            }
            .navbar-links {
                gap: 1rem;
            }
            .main-card {
                padding: 1.5rem;
                min-height: auto;
            }
            .card-content {
                grid-template-columns: 1fr;
                gap: 2rem;
                padding-top: 1.5rem;
            }
            .welcome-title {
                font-size: 2.5rem;
            }
            .welcome-subtitle {
                font-size: 1.25rem;
            }
            .card-header {
                margin-bottom: 2rem;
            }
            .sign-in-title {
                font-size: 1.5rem;
            }
            .login-section {
                padding: 0;
            }
        }

        @media (max-width: 480px) {
            .navbar {
                padding: 1rem;
            }
            .welcome-title {
                font-size: 2rem;
            }
            .main-card {
                padding: 1rem;
            }
            .form-input {
                padding: 0.5rem 0;
                padding-right: 2rem;
            }
        }
    </style>
</head>
<script>
    const base_url='<?php echo BASE_URL; ?>';
</script>
<body>
    <!-- Barra de navegación -->
   

    <div class="container">
        <div class="main-card">
            <!-- Contenedor para todo el contenido interno del card (header, secciones, etc.) -->
            <div class="card-inner-content">
                <!-- Pantalla de éxito (oculta por defecto) -->
                <div class="success-screen" id="successScreen">
                    <h2 class="success-title">¡Bienvenido!</h2>
                    <p class="success-text">Has iniciado sesión exitosamente como <span id="userEmail"></span></p>
                    <button class="logout-btn" id="logoutBtn">Cerrar Sesión</button>
                </div>

                <!-- Formulario de login (visible por defecto) -->
                <div id="loginContainer">
                    <!-- Header del card -->
                    <div class="card-header">
                        <div class="logo">
                            <h1>Klocsthars</h1>
                        </div>
                        <div class="sign-in-title">Sign In</div>
                    </div>

                    <!-- Contenido principal -->
                    <div class="card-content">
                        <!-- Sección de bienvenida -->
                        <div class="welcome-section">
                            <h2 class="welcome-title">Welcome!</h2>
                            <h3 class="welcome-subtitle">To Our New Website.</h3>
                            <p class="welcome-text">
                                Lorem ipsum dolor sit amet consectetur adipisicing elit. Beatae, aspernatur.
                            </p>
                            
                            <div class="social-icons">
                                <a href="#" class="social-icon">
                                    <i class='bx bxl-linkedin'></i>
                                </a>
                                <a href="#" class="social-icon">
                                    <i class='bx bxl-facebook'></i>
                                </a>
                                <a href="#" class="social-icon">
                                    <i class='bx bxl-instagram'></i>
                                </a>
                                <a href="#" class="social-icon">
                                    <i class='bx bxl-twitter'></i>
                                </a>
                            </div>
                        </div>

                        <!-- Sección del formulario -->
                        <div class="login-section">
                            <form id="frm_login">
                                <div class="form-group">
                                    <label for="username" class="input-label">username</label>
                                    <input 
                                        type="text" 
                                        name="username" 
                                        class="form-input" 
                                        id="username"
                                       
                                    >
                                    <i class='bx bx-envelope input-icon'></i>
                                </div>
                                
                                <div class="form-group">
                                    <label for="password" class="input-label">Password</label>
                                    <input 
                                        type="password" 
                                        name="password" 
                                        id="password"
                                        class="form-input" 
                                        
                                    >
                                    <button type="button" class="password-toggle" id="togglePassword">
                                        <i class='bx bx-show' id="eyeIcon"></i>
                                    </button>
                                    <i class='bx bx-lock-alt password-lock-icon'></i>
                                </div>
                                
                                <div class="form-row">
                                    
                                    <a href="#" class="forgot-link">Forgot password?</a>
                                </div>
                                
                                <!-- Mensajes de error y éxito -->
                                <div class="error-message" id="errorMessage"></div>
                                <div class="success-message" id="successMessage"></div>
                                
                                <button type="button" class="submit-btn" id="submitBtn" onclick="iniciar_sesion();">
                                    <span id="btnText">Sign In</span>
                                </button>
                            </form>
                            
                            <div class="signup-link">
                                Don't have an account? <a href="#">Sign up</a>
                            </div>
                            
                            <div class="demo-info">
                                Demo: <span>admin@example.com / admin</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

  

    <!-- Tu archivo JS externo -->
    <script src="<?= BASE_URL;?>view/function/users.js"></script>
</body>
</html>
