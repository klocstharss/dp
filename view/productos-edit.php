<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Editar Producto - Sistema de Venta</title>
    <link href="<?php echo BASE_URL; ?>view/bootstrap/css/bootstrap.min.css" rel="stylesheet" />
    <link href="<?php echo BASE_URL; ?>view/bootstrap/css/bootstrap-icons.css" rel="stylesheet" />
    <style>
        body {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            min-height: 100vh;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }
        .main-container {
            max-width: 1000px;
            margin: 30px auto;
            padding: 0 20px;
        }
        .form-card {
            background: white;
            border-radius: 20px;
            box-shadow: 0 20px 40px rgba(0,0,0,0.1);
            overflow: hidden;
            margin-bottom: 30px;
        }
        .form-header {
            background: linear-gradient(135deg, #fd7e14, #e8590c);
            color: white;
            padding: 25px 30px;
            margin: 0;
            display: flex;
            align-items: center;
            gap: 15px;
        }
        .form-header h4 {
            margin: 0;
            font-weight: 600;
            font-size: 1.5rem;
        }
        .form-body {
            padding: 40px;
        }
        .section-title {
            color: #fd7e14;
            font-weight: 600;
            font-size: 1.1rem;
            margin-bottom: 20px;
            display: flex;
            align-items: center;
            gap: 8px;
        }
        .section-title i {
            font-size: 1.2rem;
        }
        .form-section {
            background: #f8f9fa;
            border-radius: 15px;
            padding: 25px;
            margin-bottom: 30px;
            border: 1px solid #e9ecef;
        }
        .form-label {
            font-weight: 600;
            color: #495057;
            margin-bottom: 8px;
            display: flex;
            align-items: center;
            gap: 6px;
        }
        .form-label i {
            color: #6c757d;
            font-size: 0.9rem;
        }
        .form-control, .form-select {
            border-radius: 10px;
            border: 2px solid #e9ecef;
            padding: 12px 16px;
            font-size: 0.95rem;
            transition: all 0.3s ease;
        }
        .form-control:focus, .form-select:focus {
            border-color: #fd7e14;
            box-shadow: 0 0 0 0.2rem rgba(253, 126, 20, 0.15);
            transform: translateY(-1px);
        }
        .input-group-text {
            background: linear-gradient(135deg, #f8f9fa, #e9ecef);
            border: 2px solid #e9ecef;
            border-radius: 10px 0 0 10px;
            color: #6c757d;
        }
        .input-group .form-control {
            border-left: none;
            border-radius: 0 10px 10px 0;
        }
        .input-group .form-control:focus {
            border-left: 2px solid #fd7e14;
        }
        .image-upload-section {
            border: 2px dashed #dee2e6;
            border-radius: 15px;
            padding: 30px;
            text-align: center;
            background: linear-gradient(135deg, #f8f9fa, #ffffff);
            transition: all 0.3s ease;
            position: relative;
        }
        .image-upload-section:hover {
            border-color: #fd7e14;
            background: linear-gradient(135deg, #fff3cd, #ffffff);
        }
        .image-upload-section i {
            font-size: 3rem;
            color: #6c757d;
            margin-bottom: 15px;
            display: block;
        }
        .image-upload-section .form-control {
            border: none;
            background: transparent;
            text-align: center;
            padding: 10px;
        }
        .image-upload-section .form-control:focus {
            box-shadow: none;
            background: rgba(253, 126, 20, 0.05);
        }
        .current-image {
            max-width: 150px;
            max-height: 150px;
            border-radius: 10px;
            border: 2px solid #e9ecef;
            margin-bottom: 15px;
        }
        .form-text {
            color: #6c757d;
            font-size: 0.85rem;
            margin-top: 8px;
        }
        .btn-section {
            background: white;
            padding: 30px 40px;
            border-top: 1px solid #e9ecef;
            display: flex;
            justify-content: center;
            gap: 15px;
            flex-wrap: wrap;
        }
        .btn {
            border-radius: 12px;
            padding: 12px 25px;
            font-weight: 600;
            font-size: 0.95rem;
            transition: all 0.3s ease;
            border: none;
            display: inline-flex;
            align-items: center;
            gap: 8px;
            min-width: 140px;
            justify-content: center;
        }
        .btn-warning {
            background: linear-gradient(135deg, #fd7e14, #e8590c);
            color: white;
            box-shadow: 0 4px 15px rgba(253, 126, 20, 0.3);
        }
        .btn-warning:hover {
            background: linear-gradient(135deg, #e8590c, #d84306);
            transform: translateY(-2px);
            box-shadow: 0 6px 20px rgba(253, 126, 20, 0.4);
        }
        .btn-secondary {
            background: linear-gradient(135deg, #6c757d, #5a6268);
            color: white;
        }
        .btn-secondary:hover {
            background: linear-gradient(135deg, #5a6268, #495057);
            transform: translateY(-2px);
        }
        .btn-success {
            background: linear-gradient(135deg, #28a745, #218838);
            color: white;
            box-shadow: 0 4px 15px rgba(40, 167, 69, 0.3);
        }
        .btn-success:hover {
            background: linear-gradient(135deg, #218838, #1e7e34);
            transform: translateY(-2px);
            box-shadow: 0 6px 20px rgba(40, 167, 69, 0.4);
        }
        .row {
            margin-bottom: 20px;
        }
        .required-field::after {
            content: '*';
            color: #dc3545;
            margin-left: 4px;
        }
        .product-id-badge {
            background: linear-gradient(135deg, #fd7e14, #e8590c);
            color: white;
            padding: 8px 16px;
            border-radius: 20px;
            font-weight: 600;
            font-size: 0.9rem;
            display: inline-flex;
            align-items: center;
            gap: 6px;
        }
        @media (max-width: 768px) {
            .main-container {
                margin: 15px auto;
                padding: 0 15px;
            }
            .form-body {
                padding: 25px 20px;
            }
            .btn-section {
                padding: 20px;
            }
            .btn {
                min-width: 120px;
                padding: 10px 20px;
            }
        }
    </style>
</head>
<body>
    <div class="main-container">
        <div class="form-card">
            <div class="form-header">
                <i class="bi bi-pencil-square-fill fs-2"></i>
                <h4>Editar Producto</h4>
                <?php
                if (isset($_GET["views"])) {
                    $ruta = explode("/", $_GET["views"]);
                    echo '<div class="product-id-badge ms-auto"><i class="bi bi-hash"></i>ID: ' . $ruta[1] . '</div>';
                }
                ?>
            </div>

            <div class="form-body">
                <form id="frm_edit_producto" action="" method="post" enctype="multipart/form-data" novalidate>
                    <input type="hidden" name="id_producto" id="id_producto" value="<?= isset($ruta[1]) ? $ruta[1] : ''; ?>">

                    <!-- Información Básica -->
                    <div class="form-section">
                        <h5 class="section-title">
                            <i class="bi bi-info-circle-fill"></i>
                            Información Básica
                        </h5>
                        <div class="row">
                            <div class="col-md-6">
                                <label for="codigo" class="form-label required-field">
                                    <i class="bi bi-upc-scan"></i>
                                    Código del Producto
                                </label>
                                <div class="input-group">
                                    <span class="input-group-text"><i class="bi bi-upc-scan"></i></span>
                                    <input type="text" class="form-control" id="codigo" name="codigo" placeholder="Ej: PROD001" required />
                                </div>
                            </div>
                            <div class="col-md-6">
                                <label for="nombre" class="form-label required-field">
                                    <i class="bi bi-card-text"></i>
                                    Nombre del Producto
                                </label>
                                <div class="input-group">
                                    <span class="input-group-text"><i class="bi bi-card-text"></i></span>
                                    <input type="text" class="form-control" id="nombre" name="nombre" placeholder="Nombre completo del producto" required />
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-12">
                                <label for="detalle" class="form-label required-field">
                                    <i class="bi bi-info-circle"></i>
                                    Descripción del Producto
                                </label>
                                <div class="input-group">
                                    <span class="input-group-text"><i class="bi bi-info-circle"></i></span>
                                    <input type="text" class="form-control" id="detalle" name="detalle" placeholder="Descripción detallada del producto" required />
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Información de Inventario -->
                    <div class="form-section">
                        <h5 class="section-title">
                            <i class="bi bi-boxes"></i>
                            Inventario y Precios
                        </h5>
                        <div class="row">
                            <div class="col-md-4">
                                <label for="precio" class="form-label required-field">
                                    <i class="bi bi-currency-dollar"></i>
                                    Precio (S/)
                                </label>
                                <div class="input-group">
                                    <span class="input-group-text"><i class="bi bi-currency-dollar"></i></span>
                                    <input type="number" step="0.01" min="0" class="form-control" id="precio" name="precio" placeholder="0.00" required />
                                </div>
                            </div>
                            <div class="col-md-4">
                                <label for="stock" class="form-label required-field">
                                    <i class="bi bi-boxes"></i>
                                    Stock Actual
                                </label>
                                <div class="input-group">
                                    <span class="input-group-text"><i class="bi bi-boxes"></i></span>
                                    <input type="number" min="0" class="form-control" id="stock" name="stock" placeholder="0" required />
                                </div>
                            </div>
                            <div class="col-md-4">
                                <label for="fecha_vencimiento" class="form-label required-field">
                                    <i class="bi bi-calendar-date"></i>
                                    Fecha de Vencimiento
                                </label>
                                <div class="input-group">
                                    <span class="input-group-text"><i class="bi bi-calendar-date"></i></span>
                                    <input type="date" class="form-control" id="fecha_vencimiento" name="fecha_vencimiento" required />
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <label for="id_categoria" class="form-label required-field">
                                    <i class="bi bi-tags"></i>
                                    Categoría
                                </label>
                                <select class="form-select" id="id_categoria" name="id_categoria" required>
                                    <option value="">Seleccione una categoría</option>
                                </select>
                            </div>
                            <div class="col-md-6">
                                <label for="id_proveedor" class="form-label required-field">
                                    <i class="bi bi-truck"></i>
                                    Proveedor
                                </label>
                                <select class="form-select" id="id_proveedor" name="id_proveedor" required>
                                    <option value="">Seleccione un proveedor</option>
                                </select>
                            </div>
                        </div>
                    </div>

                    <!-- Imagen del Producto -->
                    <div class="form-section">
                        <h5 class="section-title">
                            <i class="bi bi-image"></i>
                            Imagen del Producto
                        </h5>
                        <div id="current-image-container" style="display: none;">
                            <h6 class="text-center mb-3">Imagen Actual</h6>
                            <div class="text-center">
                                <img id="current-image" src="" alt="Imagen actual" class="current-image">
                            </div>
                        </div>
                        <div class="image-upload-section">
                            <i class="bi bi-cloud-upload"></i>
                            <label for="imagen" class="form-label mb-2">Cambiar Imagen (Opcional)</label>
                            <input type="file" class="form-control" id="imagen" name="imagen" accept="image/*" />
                            <div class="form-text">
                                <i class="bi bi-info-circle me-1"></i>
                                Si no selecciona una nueva imagen, se mantendrá la actual. Formatos: JPG, PNG, GIF. Máx: 5MB
                            </div>
                        </div>
                    </div>
                </form>
            </div>

            <div class="btn-section">
                <button type="submit" form="frm_edit_producto" class="btn btn-warning">
                    <i class="bi bi-check-circle-fill"></i>
                    Actualizar Producto
                </button>
                <a href="<?php echo BASE_URL; ?>producto-lista" class="btn btn-secondary">
                    <i class="bi bi-arrow-left"></i>
                    Volver a Lista
                </a>
                <a href="<?php echo BASE_URL; ?>new-producto" class="btn btn-success">
                    <i class="bi bi-plus-circle-fill"></i>
                    Nuevo Producto
                </a>
            </div>
        </div>
    </div>

    <script src="<?php echo BASE_URL; ?>view/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="<?php echo BASE_URL; ?>view/function/producto.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            cargar_categorias();
            cargar_proveedores();
            edit_producto();
        });
    </script>
</body>
</html>
