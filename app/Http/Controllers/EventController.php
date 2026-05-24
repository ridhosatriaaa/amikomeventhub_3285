<?php

namespace App\Http\Controllers;

use App\Models\Event;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class EventController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | SISI PUBLIK / PENGUNJUNG
    |--------------------------------------------------------------------------
    */

    /**
     * Menampilkan detail event berdasarkan ID
     */
    public function show($id)
    {
        // 1. Ambil data MURNI dari database. 
        // findOrFail akan otomatis menampilkan halaman 404 jika ID tidak ditemukan.
        $event = Event::findOrFail($id);

        // Menuju folder resources/views/event/detail.blade.php
        return view('event.detail', compact('event'));
    }

    /**
     * Menampilkan halaman checkout tiket
     */
    public function checkout($id)
    {
        // Ambil data event dari database berdasarkan id
        $event = Event::findOrFail($id); 

        // Kirim data $event ke file checkout.blade.php
        return view('checkout', compact('event')); 
    }

    /**
     * Memproses form data pemesan dari modal Midtrans
     */
    public function processCheckout(Request $request, $id)
    {
        $request->validate([
            'customer_name'  => 'required|string|max:255',
            'customer_email' => 'required|email',
            'customer_phone' => 'required|string',
        ]);

        // Pastikan event ada di database
        $event = Event::findOrFail($id);

        // Generate Order ID acak (Simulasi invoice Midtrans)
        $orderId = 'INV-' . strtoupper(Str::random(4)) . '-' . rand(1000, 9999);

        // Amankan data ke dalam session agar mengalir ke halaman E-ticket secara dinamis
        session([
            $orderId => [
                'order_id'       => $orderId,
                'customer_name'  => $request->customer_name,
                'customer_email' => $request->customer_email,
                'event_id'       => $event->id
            ]
        ]);

        return redirect()->route('ticket.show', ['order_id' => $orderId]);
    }

    /**
     * Menampilkan halaman E-Ticket cetak dengan QR-Code
     */
    public function showTicket($order_id)
    {
        $sessionData = session($order_id);

        // Jika user langsung akses link tiket tanpa lewat checkout, kembalikan ke home
        if (!$sessionData) {
            return redirect()->route('home')->with('error', 'Data transaksi tidak ditemukan.');
        }

        // Ambil data event asli dari database berdasarkan ID yang ada di session
        $event = Event::findOrFail($sessionData['event_id']);

        $transaction = (object) [
            'order_id'       => $sessionData['order_id'],
            'customer_name'  => $sessionData['customer_name'],
            'customer_email' => $sessionData['customer_email'],
            'event'          => $event
        ];

        return view('event.ticket', compact('transaction'));
    }

    /*
    |--------------------------------------------------------------------------
    | SISI BACKEND / ADMIN (KELOLA EVENT)
    |--------------------------------------------------------------------------
    */

    public function create()
    {
        $categories = Category::all();
        return view('admin.events.create', compact('categories')); 
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_event'  => 'required|string|max:255',
            'category_id' => 'required|exists:categories,id',
            'tanggal'     => 'required|date',
            'harga'       => 'required|numeric|min:0',
            'poster'      => 'required|image|mimes:jpeg,png,jpg,webp|max:2048', 
            'deskripsi'   => 'nullable|string',
            'total_stok'  => 'required|integer|min:1',
            'lokasi'      => 'nullable|string|max:255',
        ]);

        $posterPath = null;
        if ($request->hasFile('poster')) {
            $posterPath = $request->file('poster')->store('events', 'public');
        }

        $category = Category::find($request->category_id);

        Event::create([
            'nama_event'   => $request->nama_event,
            'kategori'     => $category ? $category->name : 'Umum',
            'tanggal'      => $request->tanggal,
            'harga'        => $request->harga,
            'poster'       => $posterPath,
            'deskripsi'    => $request->deskripsi,
            'total_stok'   => $request->total_stok,
            'stok_terjual' => 0,
            'lokasi'       => $request->lokasi ?? 'Amikom Yogyakarta',
        ]);

        return redirect()->route('admin.events.index')->with('success', 'Event baru berhasil ditambahkan!');
    }
}