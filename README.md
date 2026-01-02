# 💳 Sistema de Pagos Resiliente con Notificaciones Asíncronas

<p align="center">
  <img src="https://img.shields.io/badge/Laravel-11.x-FF2D20?style=for-the-badge&logo=laravel&logoColor=white" alt="Laravel">
  <img src="https://img.shields.io/badge/PHP-8.2-777BB4?style=for-the-badge&logo=php&logoColor=white" alt="PHP">
  <img src="https://img.shields.io/badge/MySQL-Database-4479A1?style=for-the-badge&logo=mysql&logoColor=white" alt="MySQL">
  <img src="https://img.shields.io/badge/Status-Functional-success?style=for-the-badge" alt="Status">
</p>

## 📌 1. Descripción del Proyecto
Este servicio backend resuelve el desafío de procesar pagos de manera inmediata mientras se gestionan notificaciones (email/SMS) de forma asíncrona. La solución está diseñada bajo principios de **alta disponibilidad y resiliencia**, asegurando que ninguna notificación se pierda ante fallos en servicios externos.

---

## 🏗️ 2. Arquitectura y Flujo de Datos

El sistema implementa un patrón de **Event-Driven Architecture (EDA)** simplificado:

1.  **Request (Petición):** El cliente envía un pago al endpoint `/api/pay`.
2.  **Persistence (Persistencia):** Se registra el pago en la base de datos con estado `SUCCESS`.
3.  **Job Dispatch (Despacho):** Se publica un trabajo (`SendNotificationJob`) en la cola de la base de datos.
4.  **Immediate Response:** Se retorna una respuesta exitosa al cliente (Desacoplamiento).
5.  **Worker (Procesamiento):** Un proceso independiente toma el trabajo y ejecuta la simulación del envío de notificación.



---

## 🛠️ 3. Especificaciones de la API

### Registrar un Pago
**Endpoint:** `POST /api/pay`  
**Content-Type:** `application/json`

**Cuerpo de la petición (Payload):**
```json
{
    "amount": 150.75,
    "email": "cliente@example.com"
}