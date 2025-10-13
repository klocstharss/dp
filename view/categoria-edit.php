<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Editar Categoría - Sistema de Venta</title>
    <link href="<?php echo BASE_URL; ?>view/bootstrap/css/bootstrap.min.css" rel="stylesheet" />
    <link href="<?php echo BASE_URL; ?>view/bootstrap/css/bootstrap-icons.css" rel="stylesheet" />
    <style>
        body {
            background-color: #f8f9fa;
        }
        .container {
            max-width: 600px;
            margin-top: 50px;
            background-color: white;
            padding: 20px;
            border-radius: 12px;
            box-shadow: 0 4px 12px rgba(0,0,0,0.1);
        }
        .card-header {
            font-weight: 700;
            font-size: 1.25rem;
            color: white;
            background-color: #0d6efd;
            display: flex;
            align-items: center;
            gap: 10px;
            justify-content: center;
            border-radius: 12px 12px 0 0;
        }
        .form-label {
            font-weight: 600;
        }
        .btn-primary {
            background-color: #0d6efd;
            border: none;
            font-weight: 600;
            padding: 10px 20px;
            border-radius: 8px;
        }
        .btn-primary:hover {
            background-color: #0b5ed7;
        }
        .btn-secondary {
            border-radius: 8px;
        }
        .form-group {
            margin-bottom: 1rem;
        }
        .d-flex {
            justify-content: center;
            gap: 20px;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="card">
            <div class="card-header">
                <i class="bi bi-pencil-square"></i> Editar Categoría
                <?php
                if (isset($_GET["views"])) {
                    $ruta = explode("/", $_GET["views"]);
                    echo $ruta[1];
                }
                ?>
            </div>
            <form id="frm_edit_categorie" action="" method="post" novalidate>
                <input type="hidden" name="id_categoria" id="id_categoria" value="<?= $ruta[1]; ?>">
                <div class="card-body">
                    <div class="form-group row">
                        <label for="nombre" class="col-sm-3 col-form-label">Nombre</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control" id="nombre" name="nombre" required />
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="detalle" class="col-sm-3 col-form-label">Detalle</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control" id="detalle" name="detalle" required />
                        </div>
                    </div>
                    <div class="d-flex mt-4">
                        <button type="submit" class="btn btn-primary">
                            <i class="bi bi-pencil-square me-1"></i> Actualizar
                        </button>
                        <a href="<?php echo BASE_URL; ?>categorias-lista" class="btn btn-secondary">
                            Cancelar
                        </a>
                    </div>
                </div>
            </form>
        </div>
    </div>
    <script src="<?php echo BASE_URL; ?>view/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="<?php echo BASE_URL; ?>view/function/categoria.js"></script>
    <script>
        edit_categoria();
    </script>
</body>
</html>
