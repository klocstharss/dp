<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ventas</title>
    <link rel="stylesheet" href="<?php echo BASE_URL; ?>view/bootstrap/css/bootstrap.min.css">
    <style>
        body { background-color: #f8f9fa; }
        .card { border-radius: 10px; }
        .product-item { border: 1px solid #dee2e6; border-radius: 8px; padding: 10px; margin-bottom: 10px; }
        .product-item h5 { color: #007bff; }
        .product-item p { margin: 5px 0; }
        .product-item button { margin-top: 5px; }
    </style>
</head>
<body>
<div class="container-fluid mt-4 row">
    <h2>Ventas</h2>
    <div class="col-9">
        <div class="card">
            <div class="card-body">
                <h5 class="card-title">Busqueda de Productos</h5>
                <div class="row mb-3">
                    <div class="col-12">
                        <div class="input-group">
                            <input id="busqueda_venta" type="text" class="form-control"   placeholder="Buscar producto por nombre o código..." onkeyup="buscarProductosVenta(this.value);">
                            <input type="hidden" id="id_producto_venta">
                            <input type="hidden" id="producto_precio_venta">
                            <input type="hidden" id="producto_cantidad_venta" value="1">
                            
                            
                        </div>
                    </div>
                </div>
                <div class="row container-fluid" id="productos_venta">
                    <!-- Los productos se cargarán dinámicamente -->
                </div>
            </div>
        </div>
    </div>
    <div class="col-3">
        <div class="card">
            <div class="card-body">
                <h5 class="card-title">Lista de Compra</h5>
                <div class="row" style="min-height: 500px;">
                    <div class="col-12">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>Producto</th>
                                    <th>Cantidad</th>
                                    <th>Precio</th>
                                    <th>Total</th>
                                    <th>Acciones</th>
                                </tr>
                            </thead>
                            <tbody id="lista_compra">
                                <tr>
                                    <td>Producto 1</td>
                                    <td>2</td>
                                    <td>$10.00</td>
                                    <td>$20.00</td>
                                    <td><button class="btn btn-danger btn-sm">Eliminar</button></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="row">
                    <div class="col-12 text-end">
                        <h4>Subtotal : <label id="">$20.00</label></h4>
                        <h4>Igv : <label id="">$20.00</label></h4>
                        <h4>Total : <label id="">$20.00</label></h4>
                        <button class="btn btn-success">Realizar Venta</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="<?php echo BASE_URL; ?>view/function/ejemplo.js"></script>
<script src="<?php echo BASE_URL; ?>view/function/ventas.js"></script>
<script>
    let input = document.getElementById("busqueda_venta");
    input.addEventListener('keydown',(event)=>{
        if (event.key =='Enter') {
            agregar_producto_temporal();
            
        }
    });
</script>
<script src="<?php echo BASE_URL; ?>view/bootstrap/js/bootstrap.bundle.min.js"></script>
</body>
</html>

