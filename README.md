<p align="center">Payment & Notification Service</p>

<p align="center">
Este proyecto es una implementación de un servicio de pagos asíncrono desarrollado con Laravel. El objetivo es procesar transacciones de forma eficiente y garantizar que las notificaciones a los clientes se entreguen incluso si los servicios externos presentan fallos.
</p>

## Características

Procesamiento de Pagos: Registro inmediato de transacciones con estado SUCCESS.

Arquitectura Asíncrona: Uso de colas (Queues) para el envío de notificaciones (Email/SMS simulado).

Resiliencia: Sistema de reintentos automáticos para garantizar que ninguna notificación se pierda si el servicio de mensajería está caído.

Desacoplamiento: La lógica de negocio del pago es independiente de la lógica de notificación.

## Requisitos Técnicos

PHP 8.x

Composer

MySQL / MariaDB

Docker (Opcional, si usas Laravel Sail)

## Instalación y Configuración

Clonar el repositorio:
git clone https://github.com/JuanGuerra22/laravel-payment-service
cd TU_REPO

## Instalar dependencias:

composer install

## Configurar el entorno:
Copia el archivo de ejemplo: cp .env.example .env

Configura tus credenciales de base de datos en el archivo .env.

Importante: Asegúrate de que QUEUE_CONNECTION=database para habilitar el encolamiento.

## Generar la clave de la aplicación y ejecutar migraciones:
php artisan key:generate
php artisan migrate

## Ejecución del Proyecto

Para probar el flujo completo, necesitas ejecutar tres procesos en paralelo:

## Servidor de la API:
php artisan serve
## Procesador de Colas (Worker):
php artisan queue:work
## Pruebas de la API
Puedes probar el endpoint de pagos enviando una petición POST a /api/pay.
Ejemplo con CURL:
curl -X POST http://localhost:8000/api/pay \
     -H "Content-Type: application/json" \
     -d '{"amount": 100.00, "email": "usuario@ejemplo.com"}'

## Respuesta esperada:
{
    "message": "Pago registrado. Notificación en camino."
}
