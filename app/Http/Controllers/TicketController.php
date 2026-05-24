<?php

namespace App\Http\Controllers;

use App\Models\Event;
use Illuminate\Http\Request;

class TicketController extends Controller
{
    public function index(Request $request, $id)
    {
        // Cari data event berdasarkan ID yang dikirim dari URL
        $event = Event::findOrFail($id);
        
        // Tangkap nama dari parameter URL (?name=...)
        $name = $request->query('name', 'Pemesan');

        // Kirim data event dan nama pembeli ke view 'ticket'
        return view('ticket', compact('event', 'name'));
    }
}