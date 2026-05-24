<?php

namespace App\Http\Controllers;

use App\Models\Event;
use App\Models\Transaction;
use Illuminate\Http\Request;

class CheckoutController extends Controller
{
    public function process(Request $request, $id)
    {
        // 1. Validasi input dari user
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'phone' => 'required|string|max:20',
        ]);

        // 2. Ambil data event berdasarkan ID
        $event = Event::findOrFail($id);
        
        // 3. Hitung total (harga event + biaya layanan 5000 jika berbayar)
        $totalAmount = $event->price == 0 ? 0 : $event->price + 5000;

        // 4. Simpan ke database
        $transaction = Transaction::create([
            'event_id' => $event->id,
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'total_amount' => $totalAmount,
            'status' => 'success', // Asumsi pembayaran langsung sukses
        ]);

        // 5. Redirect ke e-ticket membawa ID event dan nama pembeli
        return redirect()->route('ticket', [
            'id' => $event->id, 
            'name' => $transaction->name
        ]);
    }
}