# Solución para el problema de CORS en el inicio de sesión

## Problema
El error que estás experimentando se debe a que tu aplicación está intentando acceder a:
- `https://www.gedion.serviciosvirtuales.com.pe/` (con www)
Desde:
- `https://gedion.serviciosvirtuales.com.pe/` (sin www)

Esto causa un error de CORS porque el navegador los considera como orígenes diferentes.

## Solución 1: Configuración de .htaccess (Ya implementada)
He actualizado tu archivo .htaccess para redirigir automáticamente de www a no-www.

## Solución 2: Configuración de BASE_URL
Asegúrate que en tu archivo config.php la constante BASE_URL esté configurada sin www:

```php
const BASE_URL= 'https://gedion.serviciosvirtuales.com.pe/';
```

## Solución 3: Configuración de cabeceras CORS (Ya implementada)
He añadido las cabeceras CORS necesarias en todos los controladores para permitir solicitudes entre orígenes.

## Pasos para solucionar el problema

1. **Sube el archivo .htactualizado** a tu hosting
2. **Verifica tu config.php** y asegúrate que BASE_URL no tenga www
3. **Limpia la caché** de tu navegador
4. **Intenta acceder directamente** a https://gedion.serviciosvirtuales.com.pe/ (sin www)
5. **Si el problema persiste**, contacta a tu proveedor de hosting para verificar que el módulo mod_headers esté activado

## Prueba de funcionamiento
Para verificar que todo funciona correctamente:

1. Abre la consola de desarrollador de tu navegador
2. Intenta iniciar sesión
3. Verifica que no aparezcan errores de CORS

## Si el problema persiste
Si después de aplicar estas soluciones el problema continúa, puedes:

1. Usar un certificado SSL que cubra ambas variantes (con y sin www)
2. Configurar una redirección desde el panel de control de tu hosting
3. Contactar al soporte técnico de tu hosting mencionando el problema específico de CORS

## Archivos modificados
- .htaccess: Añadida redirección de www a no-www y configuración de CORS
- control/UsuarioController.php: Añadidas cabeceras CORS
- control/CategoriaController.php: Añadidas cabeceras CORS
- control/ProductosController.php: Añadidas cabeceras CORS
- control/CategoriesController.php: Añadidas cabeceras CORS
