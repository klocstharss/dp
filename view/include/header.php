<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ccorimanya</title>
    <link rel="icon" href="view/img/buscar.png" type="image/x-icon">
    <link rel="stylesheet" href="<?php echo BASE_URL; ?>view/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.13.1/font/bootstrap-icons.min.css">

    <script>
        const base_url = '<?php echo BASE_URL; ?>';
    </script>

    <style>
        body {
            min-height: 100vh;
            padding-left: 280px; /* Espacio para el sidebar fijo */
        }

        .sidebar {
            position: fixed;
            top: 0;
            left: 0;
            bottom: 0;
            width: 280px;
            background-color: #212529; /* Color oscuro de Bootstrap dark */
            padding: 20px 0;
            overflow-y: auto;
            z-index: 1000;
        }

        .sidebar .navbar-brand {
            color: white;
            font-size: 1.5rem;
            padding: 1rem 1.5rem;
            display: block;
            text-align: center;
        }

        .sidebar .nav-link {
            color: rgba(255, 255, 255, 0.8);
            padding: 0.8rem 1.5rem;
            border-radius: 0;
        }

        .sidebar .nav-link:hover,
        .sidebar .nav-link.active {
            background-color: rgba(255, 255, 255, 0.1);
            color: white;
        }

        .sidebar .bi {
            margin-right: 10px;
            font-size: 1.2rem;
            width: 30px;
            text-align: center;
        }

        .dropdown-menu {
            background-color: #343a40;
        }

        .dropdown-item {
            color: rgba(255, 255, 255, 0.8);
        }

        .dropdown-item:hover {
            background-color: rgba(255, 255, 255, 0.1);
            color: white;
        }

        @media (max-width: 992px) {
            body {
                padding-left: 0;
            }
            .sidebar {
                width: 100%;
                height: auto;
                position: relative;
            }
        }
    </style>
</head>
<body>

    <!-- Sidebar vertical -->
    <div class="sidebar bg-dark">
        <a class="navbar-brand" href="#">LOGO</a>
        
        <nav class="nav flex-column px-3">
            <a class="nav-link active" href="<?= BASE_URL ?>dashboard">
                <i class="bi bi-house"></i> Home
            </a>
            <a class="nav-link" href="<?= BASE_URL ?>users">
                <i class="bi bi-person-square"></i> Users
            </a>
            <a class="nav-link" href="<?= BASE_URL ?>producto-lista">
                <i class="bi bi-box-seam"></i> Lista Producto
            </a>
            <a class="nav-link" href="<?= BASE_URL ?>new-categoria">
                <i class="bi bi-menu-button-wide-fill"></i> Categories
            </a>
            <a class="nav-link" href="<?= BASE_URL ?>clients">
                <i class="bi bi-people"></i> Clients
            </a>
            <a class="nav-link" href="<?= BASE_URL ?>proveedores">
                <i class="bi bi-shop"></i> Proveedores
            </a>
            <a class="nav-link" href="ejemplo">
                <i class="bi bi-cart3"></i> Vista Cliente
            </a>
            <a class="nav-link" href="#">
                <i class="bi bi-cart3"></i> Sales
            </a>
        </nav>

        <div class="dropdown px-3 mt-auto">
            <a class="nav-link dropdown-toggle text-white" href="#" role="button" data-bs-toggle="dropdown">
                <i class="bi bi-person-circle"></i> Menu
            </a>
            <ul class="dropdown-menu dropdown-menu-dark">
                <li><a class="dropdown-item" href="#">Perfil</a></li>
                <li><a class="dropdown-item" href="#">Ajustes</a></li>
                <li><hr class="dropdown-divider"></li>
                <li><a class="dropdown-item" href="login">Cerrar Sesión</a></li>
            </ul>
        </div>
    </div>

    <!-- El contenido principal de tus páginas irá aquí -->
    <main class="container-fluid py-4">
        <!-- Todo tu contenido de dashboard, users, etc. -->
    </main>

    <script src="<?php echo BASE_URL; ?>view/bootstrap/js/bootstrap.bundle.min.js"></script>
</body>
</html>