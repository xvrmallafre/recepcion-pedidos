# Recepción de pedidos

Este proyecto es una aplicación web hecha en Laravel (), que permite gestionar la recepción de pedidos en un taller de rotulación e impresión. Con esta aplicación, se puede registrar la información de las recepciones de pedidos. Además, se puede generar un documento PDF con el presupuesto y el albarán de cada pedido.

## Requisitos

Para ejecutar esta aplicación, se necesita:

- PHP >= 7.3
- Composer
- MySQL
- Servidor web Apache o Nginx

## Instalación

Para instalar esta aplicación, sigue estos pasos:

1. Clona este repositorio en tu servidor web.
2. Ejecuta `composer install` para instalar las dependencias.
3. Crea una base de datos MySQL y configura el archivo `.env` con los datos de conexión.
4. Ejecuta `php artisan migrate` para crear las tablas de la base de datos.
5. Ejecuta `php artisan key:generate` para generar la clave de la aplicación.

## Backpack

Esta aplicación usa el paquete de Laravel Backpack, que proporciona una interfaz de usuario para gestionar los modelos de la base de datos. Para usar Backpack, se necesita:

- Ejecutar `php artisan backpack:install` para instalar las dependencias y publicar los archivos necesarios.
- Ejecutar `php artisan backpack:base:install` para instalar el paquete base de Backpack, que incluye la autenticación, el diseño y los componentes comunes.

## Uso

Para usar esta aplicación, sigue estos pasos:

1. Accede a la URL de la aplicación en tu navegador web (la ruta base de laravel está deshabilitada con un 404).
2. Regístrate o inicia sesión con tu cuenta de usuario.
3. Navega por las opciones del menú para crear, editar, eliminar o consultar las recepciones de pedidos.

## Personalización

Esta aplicación está personalizada para un cliente en concreto, que es un taller de rotulación e impresión. Si quieres clonar este proyecto para otro cliente, tendrás que modificar algunos datos e imágenes.

## Licencia

Este proyecto está bajo la licencia MIT.