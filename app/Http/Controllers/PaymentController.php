<?php

namespace App\Http\Controllers;
use App\Models\Payment;
use App\Jobs\SendNotificationJob;
use Illuminate\Http\Request;

class PaymentController extends Controller
{
    public function processPayment(Request $request) {
        // 1. Registramos el pago (Simulamos que la pasarela ya cobró)
        $payment = Payment::create([
            'amount' => $request->amount,
            'email' => $request->email,
            'status' => 'SUCCESS',
        ]);

        // 2. Enviamos a la cola (asíncrono)
        SendNotificationJob::dispatch($payment);

        return response()->json(['message' => 'Pago registrado. Notificación en camino.'], 201);
    }
}
