<?php require_once 'include/header.php'; ?>
<div class="container-fluid mt-4">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h1 class="h3">Panel de Control</h1>
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb mb-0">
                <li class="breadcrumb-item"><a href="#">Inicio</a></li>
                <li class="breadcrumb-item active" aria-current="page">Dashboard</li>
            </ol>
        </nav>
    </div>

    <!-- Estadísticas rápidas -->
    <div class="row g-3 mb-4">
        <div class="col-sm-6 col-md-3">
            <div class="card shadow-sm">
                <div class="card-body">
                    <div class="d-flex align-items-center">
                        <div class="me-3">
                            <div class="bg-primary text-white rounded-circle d-flex align-items-center justify-content-center" style="width:48px;height:48px;">
                                <i class="bi bi-box-seam"></i>
                            </div>
                        </div>
                        <div>
                            <div class="text-muted small">Productos</div>
                            <div class="h5 mb-0">156</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-sm-6 col-md-3">
            <div class="card shadow-sm">
                <div class="card-body">
                    <div class="d-flex align-items-center">
                        <div class="me-3">
                            <div class="bg-success text-white rounded-circle d-flex align-items-center justify-content-center" style="width:48px;height:48px;">
                                <i class="bi bi-people"></i>
                            </div>
                        </div>
                        <div>
                            <div class="text-muted small">Clientes</div>
                            <div class="h5 mb-0">48</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-sm-6 col-md-3">
            <div class="card shadow-sm">
                <div class="card-body">
                    <div class="d-flex align-items-center">
                        <div class="me-3">
                            <div class="bg-warning text-white rounded-circle d-flex align-items-center justify-content-center" style="width:48px;height:48px;">
                                <i class="bi bi-currency-dollar"></i>
                            </div>
                        </div>
                        <div>
                            <div class="text-muted small">Ventas Hoy</div>
                            <div class="h5 mb-0">S/ 8,540.00</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-sm-6 col-md-3">
            <div class="card shadow-sm">
                <div class="card-body">
                    <div class="d-flex align-items-center">
                        <div class="me-3">
                            <div class="bg-danger text-white rounded-circle d-flex align-items-center justify-content-center" style="width:48px;height:48px;">
                                <i class="bi bi-cart-check"></i>
                            </div>
                        </div>
                        <div>
                            <div class="text-muted small">Pedidos Pendientes</div>
                            <div class="h5 mb-0">12</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Gráficas y accesos -->
    <div class="row g-3 mb-4">
        <div class="col-lg-8">
            <div class="card shadow-sm">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <h5 class="card-title mb-0">Resumen de Ventas (últimos 7 días)</h5>
                        <div class="text-muted small">Actualizando...</div>
                    </div>
                    <div style="height: 300px; display: flex; align-items: flex-end; gap: 10px; padding: 20px 0;">
                        <div style="flex: 1; background: linear-gradient(180deg, #007bff, #0056b3); height: 45%; border-radius: 5px; position: relative;">
                            <div style="position: absolute; bottom: -25px; left: 0; right: 0; text-align: center; font-size: 12px;">Dom 05</div>
                        </div>
                        <div style="flex: 1; background: linear-gradient(180deg, #007bff, #0056b3); height: 65%; border-radius: 5px; position: relative;">
                            <div style="position: absolute; bottom: -25px; left: 0; right: 0; text-align: center; font-size: 12px;">Lun 06</div>
                        </div>
                        <div style="flex: 1; background: linear-gradient(180deg, #007bff, #0056b3); height: 55%; border-radius: 5px; position: relative;">
                            <div style="position: absolute; bottom: -25px; left: 0; right: 0; text-align: center; font-size: 12px;">Mar 07</div>
                        </div>
                        <div style="flex: 1; background: linear-gradient(180deg, #007bff, #0056b3); height: 80%; border-radius: 5px; position: relative;">
                            <div style="position: absolute; bottom: -25px; left: 0; right: 0; text-align: center; font-size: 12px;">Mié 08</div>
                        </div>
                        <div style="flex: 1; background: linear-gradient(180deg, #007bff, #0056b3); height: 70%; border-radius: 5px; position: relative;">
                            <div style="position: absolute; bottom: -25px; left: 0; right: 0; text-align: center; font-size: 12px;">Jue 09</div>
                        </div>
                        <div style="flex: 1; background: linear-gradient(180deg, #007bff, #0056b3); height: 85%; border-radius: 5px; position: relative;">
                            <div style="position: absolute; bottom: -25px; left: 0; right: 0; text-align: center; font-size: 12px;">Vie 10</div>
                        </div>
                        <div style="flex: 1; background: linear-gradient(180deg, #007bff, #0056b3); height: 75%; border-radius: 5px; position: relative;">
                            <div style="position: absolute; bottom: -25px; left: 0; right: 0; text-align: center; font-size: 12px;">Sáb 11</div>
                        </div>
                    </div>
                    <div style="margin-top: 50px; text-align: center; color: #6c757d; font-size: 12px;">
                        S/ 2,500 - S/ 4,500
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-4">
            <div class="card shadow-sm mb-3">
                <div class="card-body">
                    <h5 class="card-title">Top Productos</h5>
                    <ul class="list-group list-group-flush">
                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            Smartphone Xt
                            <span class="badge bg-primary">120</span>
                        </li>
                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            Laptop Pro
                            <span class="badge bg-primary">85</span>
                        </li>
                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            Camiseta Algodón
                            <span class="badge bg-primary">64</span>
                        </li>
                    </ul>
                </div>
            </div>

            <div class="card shadow-sm">
                <div class="card-body">
                    <h5 class="card-title">Accesos Rápidos</h5>
                    <div class="d-grid gap-2">
                        <a href="users.php" class="btn btn-outline-secondary">Usuarios</a>
                        <a href="productos-lista.php" class="btn btn-outline-secondary">Productos</a>
                        <a href="categorias-lista.php" class="btn btn-outline-secondary">Categorias</a>
                        <a href="ventas.php" class="btn btn-outline-secondary">Ventas</a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Tablas resumen -->
    <div class="row g-3">
        <div class="col-lg-6">
            <div class="card shadow-sm">
                <div class="card-body">
                    <h5 class="card-title">Ventas Recientes</h5>
                    <div class="table-responsive">
                        <table class="table table-sm">
                            <thead>
                                <tr>
                                    <th>Fecha</th>
                                    <th>Cliente</th>
                                    <th>Total</th>
                                    <th>Estado</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>2025-12-11</td>
                                    <td>Juan Pérez</td>
                                    <td>S/ 259.99</td>
                                    <td><span class="badge bg-success">Completado</span></td>
                                </tr>
                                <tr>
                                    <td>2025-12-10</td>
                                    <td>María Gómez</td>
                                    <td>S/ 45.00</td>
                                    <td><span class="badge bg-warning">Pendiente</span></td>
                                </tr>
                                <tr>
                                    <td>2025-12-09</td>
                                    <td>Carlos López</td>
                                    <td>S/ 1,499.99</td>
                                    <td><span class="badge bg-success">Completado</span></td>
                                </tr>
                                <tr>
                                    <td>2025-12-08</td>
                                    <td>Ana Rodríguez</td>
                                    <td>S/ 89.50</td>
                                    <td><span class="badge bg-success">Completado</span></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-6">
            <div class="card shadow-sm">
                <div class="card-body">
                    <h5 class="card-title">Productos con Bajo Stock</h5>
                    <div class="table-responsive">
                        <table class="table table-sm">
                            <thead>
                                <tr>
                                    <th>Producto</th>
                                    <th>Stock</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>Smartphone XS</td>
                                    <td><span class="text-danger">4</span></td>
                                </tr>
                                <tr>
                                    <td>Cable USB Type-C</td>
                                    <td><span class="text-warning">12</span></td>
                                </tr>
                                <tr>
                                    <td>Adaptador HDMI</td>
                                    <td><span class="text-danger">2</span></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>

<?php require_once 'include/footer.php'; ?>