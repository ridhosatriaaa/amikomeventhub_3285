<?php

namespace App\Http\Controllers;

use App\Models\Event;
use App\Models\Category;
use App\Models\Partner;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index(Request $request)
    {
        // 1. Ambil semua kategori dan partner
        $categories = Category::all();
        $partners = Partner::all();

        // 2. Load data event beserta relasi kategorinya (urutkan dari yang terbaru)
        $eventQuery = Event::with('category')->latest();

        // 3. Filter berdasarkan slug kategori menggunakan relasi
        if ($request->has('category') && $request->category != '') {
            $slug = $request->category;
            
            $eventQuery->whereHas('category', function($query) use ($slug) {
                $query->where('slug', $slug);
            });
        }

        // 4. Eksekusi query
        $events = $eventQuery->get();

        // 5. Kembalikan ke view 'welcome' dengan membawa data
        return view('welcome', compact('events', 'categories', 'partners'));
    }
}