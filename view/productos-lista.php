<title>Lista de Productos - Sistema de Venta</title>
    <style>
        body {
            background-color: #f0f2f5;
            padding: 20px 0;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }
        .container {
            max-width: 1400px;
            margin: 0 auto;
            padding: 30px;
        }
        .header-section {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 40px;
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
            font-size: 1.8rem;
        }
        
        /* Estilos para las cards de productos */
        .products-container {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(280px, 1fr));
            gap: 25px;
        }
        
        .product-card {
            background: white;
            border-radius: 15px;
            overflow: hidden;
            box-shadow: 0 4px 15px rgba(0,0,0,0.08);
            transition: all 0.3s ease;
            height: 100%;
            display: flex;
            flex-direction: column;
            border: 1px solid #eaeaea;
        }
        
        .product-card:hover {
            transform: translateY(-8px);
            box-shadow: 0 12px 30px rgba(0,0,0,0.15);
        }
        
        .product-image-container {
            height: 220px;
            overflow: hidden;
            position: relative;
            background-color: #f8f9fa;
            border-bottom: 1px solid #eaeaea;
        }
        
        .product-image {
            width: 100%;
            height: 100%;
            object-fit: cover;
            transition: transform 0.5s ease;
        }
        
        .product-card:hover .product-image {
            transform: scale(1.05);
        }
        
        .product-body {
            padding: 20px;
            flex-grow: 1;
            display: flex;
            flex-direction: column;
        }
        
        .product-title {
            font-size: 1.2rem;
            font-weight: 700;
            margin-bottom: 10px;
            color: #333;
            line-height: 1.3;
        }
        
        .product-brand {
            color: #6c757d;
            font-size: 0.9rem;
            margin-bottom: 15px;
        }
        
        .price-container {
            margin-bottom: 15px;
        }
        
        .price-badge {
            background: linear-gradient(135deg, #28a745, #20c997);
            color: white;
            padding: 6px 12px;
            border-radius: 20px;
            font-weight: 600;
            font-size: 1.1rem;
            display: inline-block;
        }
        
        .original-price {
            text-decoration: line-through;
            color: #6c757d;
            font-size: 0.9rem;
            margin-left: 10px;
        }
        
        .product-tags {
            display: flex;
            flex-wrap: wrap;
            gap: 8px;
            margin-bottom: 15px;
        }
        
        .tag {
            background-color: #e7f3ff;
            color: #0056b3;
            padding: 4px 10px;
            border-radius: 15px;
            font-size: 0.75rem;
            font-weight: 500;
        }
        
        .tag.popular {
            background-color: #fff3cd;
            color: #856404;
        }
        
        .tag.cart {
            background-color: #d4edda;
            color: #155724;
        }
        
        .tag.promo {
            background-color: #f8d7da;
            color: #721c24;
        }
        
        .rating-container {
            display: flex;
            align-items: center;
            margin-bottom: 15px;
        }
        
        .stars {
            color: #ffc107;
            margin-right: 8px;
        }
        
        .rating-text {
            font-size: 0.85rem;
            color: #6c757d;
        }
        
        .shipping-info {
            display: flex;
            align-items: center;
            font-size: 0.85rem;
            color: #28a745;
            margin-bottom: 20px;
        }
        
        .shipping-info i {
            margin-right: 5px;
        }
        
        .product-actions {
            display: flex;
            gap: 10px;
            margin-top: auto;
        }
        
        .btn {
            border-radius: 8px;
            padding: 10px 15px;
            font-weight: 500;
            flex: 1;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 5px;
        }
        
        .btn-primary {
            background: linear-gradient(135deg, #0d6efd, #0a58ca);
            border: none;
        }
        
        .btn-primary:hover {
            background: linear-gradient(135deg, #0b5ed7, #0958a5);
        }
        
        .btn-success {
            background: linear-gradient(135deg, #28a745, #218838);
            border: none;
            box-shadow: 0 4px 15px rgba(40, 167, 69, 0.3);
        }
        
        .btn-success:hover {
            background: linear-gradient(135deg, #218838, #1e7e34);
        }
        
        .stock-badge {
            position: absolute;
            top: 10px;
            right: 10px;
            background-color: rgba(0, 0, 0, 0.7);
            color: white;
            padding: 4px 8px;
            border-radius: 4px;
            font-size: 0.75rem;
            font-weight: 600;
        }
        
        .no-image {
            width: 100%;
            height: 100%;
            display: flex;
            align-items: center;
            justify-content: center;
            color: #6c757d;
            font-size: 1.2rem;
            background-color: #f8f9fa;
        }
        
        @media (max-width: 768px) {
            .products-container {
                grid-template-columns: repeat(auto-fill, minmax(240px, 1fr));
                gap: 20px;
            }
            
            .header-section {
                flex-direction: column;
                gap: 15px;
                text-align: center;
            }
        }
    </style>
    <div class="container">
        <div class="header-section">
            <h5><i class="bi bi-box-seam-fill"></i> Lista de Productos</h5>
            
        </div>

        <div class="products-container" id="content_productos">
            <!-- Los productos se cargarán dinámicamente desde la base de datos -->
        </div>
    </div>

    <script src="<?php echo BASE_URL; ?>view/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="<?php echo BASE_URL; ?>view/function/producto.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            view_producto();
        });
    </script>
