<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Sistema de Venta - Dashboard</title>
    <link href="<?php echo BASE_URL; ?>view/bootstrap/css/bootstrap.min.css" rel="stylesheet" />
    <link href="<?php echo BASE_URL; ?>view/bootstrap/css/bootstrap-icons.css" rel="stylesheet" />
    <style>
        body {
            background-color: #f8f9fa;
        }
        .navbar {
            background-color: #0d6efd;
            box-shadow: 0 2px 4px rgba(0,0,0,0.1);
        }
        .navbar-brand {
            font-weight: 700;
            color: white !important;
        }
        .nav-link {
            color: rgba(255,255,255,0.9) !important;
            font-weight: 500;
        }
        .nav-link:hover {
            color: white !important;
        }
        .carousel {
            max-height: 400px;
            overflow: hidden;
        }
        .carousel img {
            object-fit: cover;
            height: 400px;
        }
        .dashboard-cards {
            margin-top: 30px;
        }
        .card {
            border: none;
            border-radius: 12px;
            box-shadow: 0 4px 12px rgba(0,0,0,0.1);
            transition: transform 0.2s;
        }
        .card:hover {
            transform: translateY(-5px);
        }
        .card-icon {
            font-size: 2rem;
            color: #0d6efd;
        }
        .btn-primary {
            background-color: #0d6efd;
            border: none;
        }
        .btn-primary:hover {
            background-color: #0b5ed7;
        }
    </style>
</head>
<body>
    <nav class="navbar navbar-expand-lg">
        <div class="container-fluid">
            <a class="navbar-brand" href="#">
                <i class="bi bi-shop me-2"></i>Sistema de Venta
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="#">
                            <i class="bi bi-house-door me-1"></i>Inicio
                        </a>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            <i class="bi bi-box-seam me-1"></i>Productos
                        </a>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item" href="<?php echo BASE_URL; ?>producto-lista">Ver Productos</a></li>
                            <li><a class="dropdown-item" href="<?php echo BASE_URL; ?>new-producto">Nuevo Producto</a></li>
                        </ul>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            <i class="bi bi-tags me-1"></i>Categorías
                        </a>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item" href="<?php echo BASE_URL; ?>categorias-lista">Ver Categorías</a></li>
                            <li><a class="dropdown-item" href="<?php echo BASE_URL; ?>new-categoria">Nueva Categoría</a></li>
                        </ul>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="<?php echo BASE_URL; ?>users">
                            <i class="bi bi-people me-1"></i>Usuarios
                        </a>
                    </li>
                </ul>
                <form class="d-flex" role="search">
                    <input class="form-control me-2" type="search" placeholder="Buscar..." aria-label="Search" />
                    <button class="btn btn-outline-light" type="submit">
                        <i class="bi bi-search"></i>
                    </button>
                </form>
            </div>
        </div>
    </nav>

    <div class="container">
        <div id="carouselExampleAutoplaying" class="carousel slide mt-3" data-bs-ride="carousel">
            <div class="carousel-inner">
                <div class="carousel-item active">
                    <img src="<?php echo BASE_URL; ?>view/img/1.jpg" class="d-block w-100" alt="Bienvenido al Sistema de Venta">
                </div>
                <div class="carousel-item">
                    <img src="<?php echo BASE_URL; ?>view/img/2.jpg" class="d-block w-100" alt="Gestión de Productos">
                </div>
                <div class="carousel-item">
                    <img src="<?php echo BASE_URL; ?>view/img/3.jpg" class="d-block w-100" alt="Control de Inventario">
                </div>
            </div>
            <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleAutoplaying" data-bs-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Previous</span>
            </button>
            <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleAutoplaying" data-bs-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Next</span>
            </button>
        </div>

        <div class="dashboard-cards row">
            <div class="col-md-4 mb-4">
                <div class="card">
                    <div class="card-body text-center">
                        <div class="card-icon mb-3">
                            <i class="bi bi-box-seam"></i>
                        </div>
                        <h5 class="card-title">Productos</h5>
                        <p class="card-text">Gestiona tu inventario de productos de manera eficiente.</p>
                        <a href="<?php echo BASE_URL; ?>producto-lista" class="btn btn-primary">
                            <i class="bi bi-eye me-1"></i>Ver Productos
                        </a>
                    </div>
                </div>
            </div>
            <div class="col-md-4 mb-4">
                <div class="card">
                    <div class="card-body text-center">
                        <div class="card-icon mb-3">
                            <i class="bi bi-tags"></i>
                        </div>
                        <h5 class="card-title">Categorías</h5>
                        <p class="card-text">Organiza tus productos por categorías.</p>
                        <a href="<?php echo BASE_URL; ?>categorias-lista" class="btn btn-primary">
                            <i class="bi bi-eye me-1"></i>Ver Categorías
                        </a>
                    </div>
                </div>
            </div>
            <div class="col-md-4 mb-4">
                <div class="card">
                    <div class="card-body text-center">
                        <div class="card-icon mb-3">
                            <i class="bi bi-people"></i>
                        </div>
                        <h5 class="card-title">Usuarios</h5>
                        <p class="card-text">Administra los usuarios del sistema.</p>
                        <a href="<?php echo BASE_URL; ?>users" class="btn btn-primary">
                            <i class="bi bi-eye me-1"></i>Ver Usuarios
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="<?php echo BASE_URL; ?>view/bootstrap/js/bootstrap.bundle.min.js"></script>
</body>
</html>
