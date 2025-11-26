<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Registrar Producto - Sistema de Venta</title>
    <link href="<?php echo BASE_URL; ?>view/bootstrap/css/bootstrap.min.css" rel="stylesheet" />
    <link href="<?php echo BASE_URL; ?>view/bootstrap/css/bootstrap-icons.css" rel="stylesheet" />
    <style>
        body {
            background-color: #b9bac0ff;
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
            background: linear-gradient(135deg, #0d6efd, #0a58ca);
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
            color: #0d6efd;
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
            border-color: #0d6efd;
            box-shadow: 0 0 0 0.2rem rgba(13, 110, 253, 0.15);
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
            border-left: 2px solid #0d6efd;
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
            border-color: #0d6efd;
            background: linear-gradient(135deg, #f0f8ff, #ffffff);
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
            background: rgba(13, 110, 253, 0.05);
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
        .btn-primary {
            background: linear-gradient(135deg, #0d6efd, #0a58ca);
            box-shadow: 0 4px 15px rgba(13, 110, 253, 0.3);
        }
        .btn-primary:hover {
            background: linear-gradient(135deg, #0b5ed7, #0958a5);
            transform: translateY(-2px);
            box-shadow: 0 6px 20px rgba(13, 110, 253, 0.4);
        }
        .btn-secondary {
            background: linear-gradient(135deg, #6c757d, #5a6268);
            color: white;
        }
        .btn-secondary:hover {
            background: linear-gradient(135deg, #5a6268, #495057);
            transform: translateY(-2px);
        }
        .btn-danger {
            background: linear-gradient(135deg, #dc3545, #c82333);
            color: white;
        }
        .btn-danger:hover {
            background: linear-gradient(135deg, #c82333, #bd2130);
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
                <i class="bi bi-box-seam-fill fs-2"></i>
                <h4>Registrar Nuevo Producto</h4>
            </div>

            <div class="form-body">
                <form id="frm_product" action="" method="post" enctype="multipart/form-data" novalidate>
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
                            <div class="col-md-6">
                                <label for="codigo_barra" class="form-label">
                                    <i class="bi bi-upc-scan"></i>
                                    Código de Barra
                                </label>
                                <div class="input-group">
                                    <span class="input-group-text"><i class="bi bi-upc-scan"></i></span>
                                    <input type="text" class="form-control" id="codigo_barra" name="codigo_barra" placeholder="Código de barras del producto" />
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
                                    Stock Inicial
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
                        <div class="image-upload-section">
                            <i class="bi bi-cloud-upload"></i>
                            <label for="imagen" class="form-label mb-2">Seleccionar Imagen</label>
                            <input type="file" class="form-control" id="imagen" name="imagen" accept="image/*" />
                            <div class="form-text">
                                <i class="bi bi-info-circle me-1"></i>
                                Formatos permitidos: JPG, PNG, GIF. Tamaño máximo: 5MB (Opcional)
                            </div>
                        </div>
                    </div>
                </form>
            </div>

            <div class="btn-section">
                <button type="submit" form="frm_product" class="btn btn-primary">
                    <i class="bi bi-check-circle-fill"></i>
                    Registrar Producto
                </button>
                <button type="reset" form="frm_product" class="btn btn-secondary">
                    <i class="bi bi-arrow-clockwise"></i>
                    Limpiar Formulario
                </button>
                <button type="button" class="btn btn-danger" onclick="cancelar()">
                    <i class="bi bi-x-circle-fill"></i>
                    Cancelar
                </button>
                <a href="<?php echo BASE_URL; ?>producto-lista" class="btn btn-success">
                    <i class="bi bi-eye-fill"></i>
                    Ver Productos
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
        });
    </script>
</body>
</html>
