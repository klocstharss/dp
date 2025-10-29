# Sistema de Venta - Descripción Completa

## 1. Arquitectura del Sistema

El sistema de venta está construido siguiendo el patrón de arquitectura MVC (Modelo-Vista-Controlador), lo que permite una separación clara de responsabilidades y facilita el mantenimiento del código.

### 1.1 Estructura de Directorios

- **config/**: Contiene los archivos de configuración del sistema.
- **control/**: Contiene los controladores que gestionan la lógica de negocio.
- **model/**: Contiene los modelos que interactúan con la base de datos.
- **view/**: Contiene las vistas que presentan la información al usuario.
- **library/**: Contiene bibliotecas y clases auxiliares.
- **uploads/**: Directorio para almacenar archivos subidos, como imágenes de productos.

## 2. Componentes Principales

### 2.1 Configuración

- **config/config.php**: Define las constantes de configuración, incluyendo los parámetros de conexión a la base de datos y la URL base del sistema.

### 2.2 Conexión a la Base de Datos

- **library/conexion.php**: Clase `Conexion` que establece la conexión con la base de datos MySQL utilizando las constantes definidas en el archivo de configuración.

### 2.3 Controladores

- **views_control.php**: Gestiona las vistas del sistema, determinando qué vista mostrar según la URL solicitada y el estado de la sesión del usuario.
- **ProductosController.php**: Gestiona todas las operaciones CRUD (Crear, Leer, Actualizar, Eliminar) relacionadas con los productos.
- **CategoriaController.php**: Gestiona las operaciones CRUD para las categorías de productos.
- **UsuarioController.php**: Gestiona las operaciones CRUD para los usuarios del sistema.

### 2.4 Modelos

- **ProductsModel.php**: Interactúa con la tabla `producto` de la base de datos.
- **CategoriaModel.php**: Interactúa con la tabla `categoria` de la base de datos.
- **UsuarioModel.php**: Interactúa con la tabla `persona` de la base de datos.
- **views_model.php**: Gestiona las vistas permitidas en el sistema.

### 2.5 Vistas

Las vistas principales incluyen:

- **sistema_venta.php**: Página principal del sistema con el dashboard.
- **login.php**: Formulario de inicio de sesión.
- **producto-lista.php**: Lista de productos.
- **new-producto.php**: Formulario para agregar nuevos productos.
- **productos-edit.php**: Formulario para editar productos existentes.
- **categorias-lista.php**: Lista de categorías.
- **new-categoria.php**: Formulario para agregar nuevas categorías.
- **categoria-edit.php**: Formulario para editar categorías existentes.
- **users.php**: Lista de usuarios.
- **new-user.php**: Formulario para agregar nuevos usuarios.
- **edit-user.php**: Formulario para editar usuarios existentes.

## 3. Flujo de la Aplicación

### 3.1 Punto de Entrada

El punto de entrada de la aplicación es `index.php`, que carga el controlador de vistas (`views_control.php`) y muestra la plantilla correspondiente.

### 3.2 Sistema de Rutas

El sistema utiliza un sistema de rutas simple basado en parámetros GET. La URL determina qué vista se mostrará:

```
http://localhost/dp/?views=producto-lista
```

El controlador de vistas (`views_control.php`) verifica si el usuario ha iniciado sesión y si la vista solicitada está en la lista blanca de vistas permitidas.

### 3.3 Gestión de Sesiones

El sistema utiliza sesiones para mantener el estado de autenticación del usuario. Si el usuario no ha iniciado sesión, se redirige a la página de login.

## 4. Base de Datos

### 4.1 Estructura de Tablas

El sistema utiliza las siguientes tablas principales:

1. **persona**: Almacena información de usuarios, clientes y proveedores.
   - Campos: id, nro_identidad, razon_social, telefono, correo, departamento, provincia, distrito, cod_postal, direccion, rol, password, estado, fecha_reg.
   - Roles: admin, vendedor, cliente, proveedor.

2. **producto**: Almacena información de los productos.
   - Campos: id, codigo, nombre, detalle, precio, stock, id_categoria, fecha_vencimiento, imagen, id_proveedor.

3. **categoria**: Almacena las categorías de productos.
   - Campos: id, nombre, detalle.

4. **venta**: Registra las ventas realizadas.
   - Campos: id, codigo, fecha_hora, id_cliente, id_vendedor, estado.

5. **detalle_venta**: Detalles de cada venta.
   - Campos: id, id_venta, id_producto, cantidad.

6. **pagos**: Registra los pagos de las ventas.
   - Campos: id, id_venta, fecha_hora, monto, metodo_pago, estado.

7. **compras**: Registra las compras de productos.
   - Campos: id, id_producto, cantidad, precio, id_trabajador.

8. **sesiones**: Registra las sesiones de usuario.
   - Campos: id, id_persona, fecha_hora_inicio, fecha_hora_fin, token, ip.

### 4.2 Relaciones entre Tablas

- Un producto pertenece a una categoría (`producto.id_categoria` → `categoria.id`).
- Un producto es proveído por un proveedor (`producto.id_proveedor` → `persona.id` donde `rol='proveedor'`).
- Una venta es realizada por un vendedor a un cliente (`venta.id_vendedor` → `persona.id` donde `rol='vendedor'`, `venta.id_cliente` → `persona.id` donde `rol='cliente'`).
- Una venta puede tener múltiples detalles de venta (`venta.id` → `detalle_venta.id_venta`).
- Cada detalle de venta corresponde a un producto (`detalle_venta.id_producto` → `producto.id`).
- Una venta puede tener múltiples pagos (`venta.id` → `pagos.id_venta`).

## 5. Funcionalidades Principales

### 5.1 Gestión de Productos

El sistema permite realizar operaciones CRUD sobre los productos:

- **Crear**: Agregar nuevos productos con información como código, nombre, descripción, precio, stock, categoría, fecha de vencimiento, imagen y proveedor.
- **Leer**: Ver la lista de productos con detalles de categoría y proveedor.
- **Actualizar**: Modificar la información de productos existentes.
- **Eliminar**: Eliminar productos del sistema.

### 5.2 Gestión de Categorías

El sistema permite gestionar las categorías de productos:

- **Crear**: Agregar nuevas categorías con nombre y descripción.
- **Leer**: Ver la lista de categorías.
- **Actualizar**: Modificar la información de categorías existentes.
- **Eliminar**: Eliminar categorías del sistema.

### 5.3 Gestión de Usuarios

El sistema permite gestionar los usuarios del sistema:

- **Crear**: Agregar nuevos usuarios con información personal y rol.
- **Leer**: Ver la lista de usuarios.
- **Actualizar**: Modificar la información de usuarios existentes.
- **Eliminar**: Eliminar usuarios del sistema.

### 5.4 Gestión de Ventas

El sistema permite registrar y gestionar las ventas:

- **Crear**: Registrar nuevas ventas con productos, cliente y vendedor.
- **Leer**: Ver el historial de ventas.
- **Actualizar**: Modificar el estado de las ventas.
- **Eliminar**: Eliminar ventas del sistema.

### 5.5 Gestión de Pagos

El sistema permite registrar y gestionar los pagos de las ventas:

- **Crear**: Registrar nuevos pagos con monto, método de pago y estado.
- **Leer**: Ver el historial de pagos.
- **Actualizar**: Modificar el estado de los pagos.
- **Eliminar**: Eliminar pagos del sistema.

## 6. Seguridad

### 6.1 Autenticación

El sistema utiliza autenticación basada en sesiones para controlar el acceso a las funcionalidades del sistema. Los usuarios deben iniciar sesión para acceder al sistema.

### 6.2 Control de Acceso

El sistema implementa un control de acceso basado en roles. Los usuarios con diferentes roles tienen diferentes niveles de acceso a las funcionalidades del sistema.

### 6.3 Validación de Entrada

El sistema valida la entrada del usuario para prevenir ataques de inyección SQL y otros ataques de seguridad.

### 6.4 Gestión de Sesiones

El sistema gestiona las sesiones de usuario para mantener el estado de autenticación y controlar el acceso a las funcionalidades del sistema.

## 7. Interfaz de Usuario

### 7.1 Diseño

El sistema utiliza Bootstrap para el diseño de la interfaz de usuario, lo que proporciona un aspecto moderno y responsivo.

### 7.2 Navegación

El sistema utiliza una barra de navegación principal que permite acceder a las diferentes secciones del sistema:

- Inicio
- Productos (Ver productos, Nuevo producto)
- Categorías (Ver categorías, Nueva categoría)
- Usuarios

### 7.3 Formularios

Los formularios del sistema están diseñados para facilitar la entrada de datos y proporcionan validación en tiempo real para mejorar la experiencia del usuario.

### 7.4 Tablas

Las tablas del sistema presentan la información de manera clara y organizada, con opciones para ordenar, filtrar y paginar los datos.

## 8. Tecnologías Utilizadas

- **Backend**: PHP
- **Frontend**: HTML, CSS, JavaScript, Bootstrap
- **Base de Datos**: MySQL
- **Servidor Web**: Apache (a través de XAMPP)

## 9. Conclusiones

El sistema de venta es una aplicación web completa que permite gestionar productos, categorías, usuarios, ventas y pagos de manera eficiente. La arquitectura MVC proporciona una separación clara de responsabilidades y facilita el mantenimiento del código. El sistema implementa medidas de seguridad para proteger los datos y controlar el acceso a las funcionalidades. La interfaz de usuario es moderna y responsiva, lo que mejora la experiencia del usuario.
