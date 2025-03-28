<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Booking;
use App\Services\PaymentService;
use Illuminate\Http\Request;

class PaymentController extends Controller
{
    protected $paymentService;

    public function __construct(PaymentService $paymentService)
    {
        $this->paymentService = $paymentService;
    }

    public function createIntent(Request $request)
    {
        $request->validate([
            'booking_id' => 'required|exists:bookings,id'
        ]);

        $booking = Booking::findOrFail($request->booking_id);
        
        $this->authorize('pay', $booking);

        $paymentIntent = $this->paymentService->createPaymentIntent($booking);

        return response()->json([
            'status' => 'success',
            'client_secret' => $paymentIntent->client_secret
        ]);
    }

    public function confirm(Request $request)
    {
        $request->validate([
            'payment_intent_id' => 'required|string'
        ]);

        $success = $this->paymentService->confirmPayment($request->payment_intent_id);

        if ($success) {
            return response()->json([
                'status' => 'success',
                'message' => 'Payment confirmed successfully'
            ]);
        }

        return response()->json([
            'status' => 'error',
            'message' => 'Payment confirmation failed'
        ], 400);
    }
}