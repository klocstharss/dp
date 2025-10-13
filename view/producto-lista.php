<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Lista de Productos - Sistema de Venta</title>
    <link href="<?php echo BASE_URL; ?>view/bootstrap/css/bootstrap.min.css" rel="stylesheet" />
    <link href="<?php echo BASE_URL; ?>view/bootstrap/css/bootstrap-icons.css" rel="stylesheet" />
    <style>
        body {
            background-color: #5616ecff;
        }
        .container {
            max-width: 1400px;
            margin-top: 30px;
            background-color: white;
            padding: 30px;
            border-radius: 15px;
            box-shadow: 0 8px 25px rgba(0,0,0,0.1);
        }
        .header-section {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 30px;
            padding-bottom: 20px;
            border-bottom: 2px solid #e9ecef;
        }
        h5 {
            font-weight: 700;
            display: flex;
            align-items: center;
            gap: 10px;
            color: #0d6efd;
            margin: 0;
        }
        .table-responsive {
            border-radius: 10px;
            overflow: hidden;
            box-shadow: 0 4px 15px rgba(0,0,0,0.05);
        }
        .table {
            margin-bottom: 0;
        }
        .table thead th {
            font-weight: 600;
            font-size: 0.9rem;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            border: none;
            padding: 15px 10px;
        }
        .table tbody td {
            padding: 12px 10px;
            vertical-align: middle;
            border: none;
        }
        .table tbody tr {
            border-bottom: 1px solid #f1f3f4;
        }
        .table tbody tr:hover {
            background-color: #f8f9fa;
        }
        .product-image {
            width: 60px;
            height: 60px;
            object-fit: cover;
            border-radius: 8px;
            border: 2px solid #e9ecef;
        }
        .no-image {
            width: 60px;
            height: 60px;
            border-radius: 8px;
            background-color: #f8f9fa;
            display: flex;
            align-items: center;
            justify-content: center;
            color: #6c757d;
            font-size: 0.8rem;
            border: 2px solid #e9ecef;
        }
        .price-badge {
            background: linear-gradient(135deg, #28a745, #20c997);
            color: white;
            padding: 4px 8px;
            border-radius: 20px;
            font-weight: 600;
            font-size: 0.85rem;
        }
        .stock-badge {
            padding: 4px 8px;
            border-radius: 20px;
            font-weight: 600;
            font-size: 0.8rem;
        }
        .stock-high { background-color: #d4edda; color: #155724; }
        .stock-medium { background-color: #fff3cd; color: #856404; }
        .stock-low { background-color: #f8d7da; color: #721c24; }
        .btn {
            border-radius: 8px;
            padding: 6px 12px;
            font-size: 0.85rem;
            font-weight: 500;
        }
        .btn-primary {
            background: linear-gradient(135deg, #0d6efd, #0a58ca);
            border: none;
        }
        .btn-primary:hover {
            background: linear-gradient(135deg, #0b5ed7, #0958a5);
            transform: translateY(-1px);
        }
        .btn-danger {
            background: linear-gradient(135deg, #dc3545, #c82333);
            border: none;
        }
        .btn-danger:hover {
            background: linear-gradient(135deg, #c82333, #bd2130);
            transform: translateY(-1px);
        }
        .btn-success {
            background: linear-gradient(135deg, #28a745, #218838);
            border: none;
            box-shadow: 0 4px 15px rgba(40, 167, 69, 0.3);
        }
        .btn-success:hover {
            background: linear-gradient(135deg, #218838, #1e7e34);
            transform: translateY(-1px);
        }
        .action-buttons {
            display: flex;
            gap: 5px;
            justify-content: center;
        }
        .category-badge {
            background-color: #e7f3ff;
            color: #0056b3;
            padding: 3px 8px;
            border-radius: 15px;
            font-size: 0.75rem;
            font-weight: 500;
        }
        .supplier-badge {
            background-color: #f0f8ff;
            color: #006400;
            padding: 3px 8px;
            border-radius: 15px;
            font-size: 0.75rem;
            font-weight: 500;
        }
        .expiry-date {
            font-size: 0.8rem;
            color: #6c757d;
        }
        .expiry-warning {
            color: #dc3545;
            font-weight: 600;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header-section">
            <h5><i class="bi bi-list-ul"></i> Lista de Productos</h5>
            <a href="<?php echo BASE_URL; ?>new-producto" class="btn btn-success">
                <i class="bi bi-plus-circle me-1"></i> Nuevo Producto
            </a>
        </div>

        <div class="table-responsive">
            <table class="table">
                <thead class="table-primary">
                    <tr>
                        <th class="text-center">#</th>
                        <th class="text-center">Imagen</th>
                        <th>Código</th>
                        <th>Nombre</th>
                        <th class="text-end">Precio</th>
                        <th class="text-center">Stock</th>
                        <th>Categoría</th>
                        <th>Proveedor</th>
                        <th class="text-center">Vencimiento</th>
                        <th class="text-center">Acciones</th>
                    </tr>
                </thead>
                <tbody id="content_productos">
                    <!-- Productos cargados dinámicamente -->
                </tbody>
            </table>
        </div>
    </div>

    <script src="<?php echo BASE_URL; ?>view/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="<?php echo BASE_URL; ?>view/function/producto.js"></script>
</body>
</html>
