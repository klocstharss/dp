<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Lista de Categorías - Sistema de Venta</title>
    <link href="<?php echo BASE_URL; ?>view/bootstrap/css/bootstrap.min.css" rel="stylesheet" />
    <link href="<?php echo BASE_URL; ?>view/bootstrap/css/bootstrap-icons.css" rel="stylesheet" />
    <style>
        body {
            background-color: #f8f9fa;
        }
        .container {
            max-width: 900px;
            margin-top: 50px;
            background-color: white;
            padding: 20px;
            border-radius: 12px;
            box-shadow: 0 4px 12px rgba(0,0,0,0.1);
        }
        h5 {
            font-weight: 700;
            display: flex;
            align-items: center;
            gap: 10px;
            color: #0d6efd;
        }
        table {
            margin-top: 20px;
        }
        .btn {
            border-radius: 8px;
        }
        .btn-primary {
            background-color: #0d6efd;
            border: none;
        }
        .btn-primary:hover {
            background-color: #0b5ed7;
        }
        .btn-danger {
            border-radius: 8px;
        }
    </style>
</head>
<body>
    <div class="container">
        <h5><i class="bi bi-list-ul"></i> Lista de Categorías</h5>
        <table class="table table-striped table-hover text-center align-middle">
            <thead class="table-light">
                <tr>
                    <th>Nro</th>
                    <th>Nombre</th>
                    <th>Detalle</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody id="content_categorias">
                <!-- Categorías cargadas dinámicamente -->
            </tbody>
        </table>
        <a href="<?php echo BASE_URL; ?>new-categoria" class="btn btn-success">
            <i class="bi bi-plus-circle me-1"></i> Nueva Categoría
        </a>
    </div>
    <script src="<?php echo BASE_URL; ?>view/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="<?php echo BASE_URL; ?>view/function/categoria.js"></script>
</body>
</html>
