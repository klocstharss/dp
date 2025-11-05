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
        .bi {
            color: white;
            display: flex;
            justify-content: center;
            align-items: center;
        }
    </style>
</head>

<body>
    <header>
        <nav class="navbar navbar-expand-lg bg-body-tertiary" data-bs-theme="dark">
            <div class="container-fluid">
                <a class="navbar-brand" href="#">LOGO</a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                        <li class="nav-item">
                            <i class="bi bi-house"></i>
                            <a class="nav-link active" aria-current="page" href="<?= BASE_URL ?>new-user">Home</a>
                        </li>
                        <li class="nav-item">
                            <i class="bi bi-person-square"></i>
                            <a class="nav-link" href="<?= BASE_URL ?>users">Users</a>
                        </li>
                        <li class="nav-item">
                            <i class="bi bi-box-seam"></i>
                            <a class="nav-link" href="<?= BASE_URL ?>new-producto">Products</a>
                        </li>
                        <li class="nav-item">
                            <i class="bi bi-box-seam"></i>
                            <a class="nav-link" href="<?= BASE_URL ?>productos-lista">Vista Cliente</a>
                        </li>
                        <li class="nav-item">
                            <i class="bi bi-menu-button-wide-fill"></i>
                            <a class="nav-link" href="<?= BASE_URL ?>new-categoria">Categories</a>
                        </li>
                        <li class="nav-item">
                            <i class="bi bi-people"></i>
                            <a class="nav-link" href="<?= BASE_URL ?>clients">Clients</a>
                        </li>
                        <li class="nav-item">
                            <i class="bi bi-shop"></i>
                            <a class="nav-link" href="<?= BASE_URL ?>proveedores">Proveedores</a>
                        </li>
                        <li class="nav-item">
                            <i class="bi bi-cart3"></i>
                            <a class="nav-link" href="#">Sales</a>
                        </li>

                    </ul>
                    <form class="d-flex" role="search">
                        <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                            <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                    Menu
                                </a>
                                <ul class="dropdown-menu">
                                    <li><a class="dropdown-item" href="#">Perfil</a></li>
                                    <li><a class="dropdown-item" href="#">Ajustes</a></li>
                                    <li>
                                        <hr class="dropdown-divider">
                                    </li>
                                    <li><a class="dropdown-item" href="login">Cerrar Sesion</a></li>
                                </ul>
                            </li>

                        </ul>

                    </form>
                </div>
            </div>
        </nav>
    </header>
</body>

</html>