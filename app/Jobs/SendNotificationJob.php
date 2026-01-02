<?php

namespace App\Jobs;

use App\Models\Payment;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Log;

class SendNotificationJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public $payment;
    public $tries = 5; // Intentará 5 veces si falla
    public $backoff = 30; // Esperará 30 segundos entre reintentos

    public function __construct(Payment $payment) {
        $this->payment = $payment;
    }

    public function handle(): void
    {
        // Simulamos que el servicio externo de correos puede fallar
        $serviceAvailable = rand(1, 10) > 3; // 70% de éxito

        if (!$serviceAvailable) {
            Log::error("Servicio caído para pago ID: " . $this->payment->id);
            throw new \Exception("Error al conectar con el servicio de correos");
        }

        Log::info("Notificación enviada con éxito para el email: " . $this->payment->email);
    }
}