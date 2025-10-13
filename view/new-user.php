<!-- inicio de cuerpo de pagina -->
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Registrar Usuario - Sistema de Venta</title>
    <link href="<?php echo BASE_URL; ?>view/bootstrap/css/bootstrap.min.css" rel="stylesheet" />
    <link href="<?php echo BASE_URL; ?>view/bootstrap/css/bootstrap-icons.css" rel="stylesheet" />
    <style>
        body {
            background-color: #b9bac0ff;
        }
        .container {
            max-width: 800px;
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
        .btn-info {
            border-radius: 8px;
        }
        .btn-danger {
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
                <i class="bi bi-person-plus"></i> Registro de Usuario
            </div>
            <form id="frm_user" action="" method="post" novalidate>
                <div class="card-body">
                    <div class="form-group row">
                        <label for="nro_identidad" class="col-sm-3 col-form-label">Nro de Documento</label>
                        <div class="col-sm-9">
                            <input type="number" class="form-control" id="nro_identidad" name="nro_identidad" placeholder="Ingrese número de documento" required />
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="razon_social" class="col-sm-3 col-form-label">Nombre/Razón Social</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control" id="razon_social" name="razon_social" placeholder="Ingrese nombre o razón social" required />
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="telefono" class="col-sm-3 col-form-label">Teléfono</label>
                        <div class="col-sm-9">
                            <input type="number" class="form-control" id="telefono" name="telefono" placeholder="Ingrese teléfono" required />
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="correo" class="col-sm-3 col-form-label">Correo</label>
                        <div class="col-sm-9">
                            <input type="email" class="form-control" id="correo" name="correo" placeholder="Ingrese correo electrónico" required />
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="departamento" class="col-sm-3 col-form-label">Departamento</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control" id="departamento" name="departamento" placeholder="Ingrese departamento" required />
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="provincia" class="col-sm-3 col-form-label">Provincia</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control" id="provincia" name="provincia" placeholder="Ingrese provincia" required />
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="distrito" class="col-sm-3 col-form-label">Distrito</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control" id="distrito" name="distrito" placeholder="Ingrese distrito" required />
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="cod_postal" class="col-sm-3 col-form-label">Código Postal</label>
                        <div class="col-sm-9">
                            <input type="number" class="form-control" id="cod_postal" name="cod_postal" placeholder="Ingrese código postal" required />
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="direccion" class="col-sm-3 col-form-label">Dirección</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control" id="direccion" name="direccion" placeholder="Ingrese dirección" required />
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="rol" class="col-sm-3 col-form-label">Rol</label>
                        <div class="col-sm-9">
                            <select class="form-select" id="rol" name="rol" required>
                                <option value="">Seleccione un rol</option>
                                <option value="admin">Administrador</option>
                                <option value="vendedor">Vendedor</option>
                                <option value="cliente">Cliente</option>
                                <option value="proveedor">Proveedor</option>
                            </select>
                        </div>
                    </div>
                    <div class="d-flex mt-4">
                        <button type="submit" class="btn btn-primary">
                            <i class="bi bi-check-circle me-1"></i> Registrar
                        </button>
                        <button type="reset" class="btn btn-info">
                            <i class="bi bi-arrow-clockwise me-1"></i> Limpiar
                        </button>
                        <button type="button" class="btn btn-danger" onclick="window.location.href='<?php echo BASE_URL; ?>users'">
                            <i class="bi bi-x-circle me-1"></i> Cancelar
                        </button>
                        <a href="<?php echo BASE_URL; ?>users" class="btn btn-success">
                            <i class="bi bi-eye me-1"></i> Ver Usuarios
                        </a>
                    </div>
                </div>
            </form>
        </div>
    </div>
    <script src="<?php echo BASE_URL; ?>view/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="<?php echo BASE_URL; ?>view/function/users.js"></script>
</body>
</html>
<!-- FIN de cuerpo de pagina -->
