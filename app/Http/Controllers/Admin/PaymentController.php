<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Payment;
use App\Models\Reservation;
use Illuminate\Http\Request;
use Carbon\Carbon;

class PaymentController extends Controller
{
    public function index(Request $request)
    {
        $query = Payment::with('reservation.guest');

        if ($request->has('status') && $request->status != '') {
            $query->where('payment_status', $request->status);
        }

        $payments = $query->latest()->paginate(10);

        return view('admin.payments.index', compact('payments'));
    }

    public function show(Payment $payment)
    {
        $payment->load('reservation.guest', 'reservation.room.roomType');
        return view('admin.payments.show', compact('payment'));
    }

    public function update(Request $request, Payment $payment)
    {
        $validated = $request->validate([
            'payment_status' => 'required|in:pending,paid,failed,refunded',
            'payment_method' => 'sometimes|in:cash,credit_card,debit_card,bank_transfer,e_wallet',
        ]);

        if ($validated['payment_status'] === 'paid' && $payment->payment_status !== 'paid') {
            $validated['payment_date'] = Carbon::now();
            
            // Confirm reservation when payment is completed
            if ($payment->reservation->status === 'pending') {
                $payment->reservation->update(['status' => 'confirmed']);
            }
        }

        $payment->update($validated);

        return redirect()->route('admin.payments.index')
            ->with('success', 'Status pembayaran berhasil diperbarui!');
    }
}
