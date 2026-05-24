<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Event;
use App\Models\Transaction; // Pastikan model Transaction di-import

class DashboardController extends Controller
{
    public function index()
    {
        // 1. Hitung total pendapatan dari transaksi yang sukses
        $totalRevenue = Transaction::where('status', 'success')->sum('total_amount');
        
        // 2. Hitung jumlah tiket yang terjual (asumsi 1 transaksi = 1 tiket)
        $ticketsSold = Transaction::where('status', 'success')->count();
        
        // 3. Hitung event yang masih aktif (misal yang tanggalnya hari ini atau ke depan)
        $activeEventsCount = Event::where('date', '>=', now())->count();
        
        // 4. Hitung pesanan yang statusnya masih pending
        $pendingOrdersCount = Transaction::where('status', 'pending')->count();

        // 5. Ambil 5 transaksi terakhir untuk ditampilkan di tabel
        $latestTransactions = Transaction::with('event')->orderBy('created_at', 'desc')->take(5)->get();

        // Kirim semua variabel ke tampilan (view)
        return view('admin.dashboard', compact(
            'totalRevenue', 
            'ticketsSold', 
            'activeEventsCount', 
            'pendingOrdersCount', 
            'latestTransactions'
        ));
    }
}