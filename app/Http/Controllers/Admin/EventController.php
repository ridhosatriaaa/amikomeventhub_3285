<?php

namespace App\Http\Controllers\Admin; 

use App\Http\Controllers\Controller; 
use App\Models\Event;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class EventController extends Controller
{
    public function index()
    {
        // Mengambil event beserta relasi kategorinya
        $events = Event::with('category')->latest()->get(); 
        return view('admin.events.index', compact('events')); 
    }

    public function create()
    {
        $categories = Category::all(); 
        return view('admin.events.create', compact('categories'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'category_id' => 'required|exists:categories,id', // Sesuai nama kolom model
            'title'       => 'required|string|max:255',
            'description' => 'nullable|string',
            'date'        => 'required|date',
            'location'    => 'required|string|max:255',
            'price'       => 'required|numeric|min:0',
            'stock'       => 'required|integer|min:0',
            'poster_path' => 'nullable|image|mimes:jpeg,png,jpg|max:2048', // name di input HTML form
        ]);

        // Jika ada upload poster, simpan ke kolom poster_path
        if ($request->hasFile('poster_path')) {
            $validated['poster_path'] = $request->file('poster_path')->store('posters', 'public');
        }

        Event::create($validated);

        return redirect()->route('admin.events.index')->with('success', 'Event berhasil ditambahkan!');
    }

    public function edit($id)
    {
        $event = Event::findOrFail($id);
        $categories = Category::all();
        return view('admin.events.edit', compact('event', 'categories'));
    }

    public function update(Request $request, $id)
    {
        $event = Event::findOrFail($id);

        $validated = $request->validate([
            'category_id' => 'required|exists:categories,id',
            'title'       => 'required|string|max:255',
            'description' => 'nullable|string',
            'date'        => 'required|date',
            'location'    => 'required|string|max:255',
            'price'       => 'required|numeric|min:0',
            'stock'       => 'required|integer|min:0',
            // PERBAIKAN: Menggunakan poster_path agar selaras dengan form edit
            'poster_path' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        // PERBAIKAN: Menggunakan poster_path pada pengecekan file
        if ($request->hasFile('poster_path')) {
            
            // Hapus poster lama jika ada agar storage tidak penuh
            if ($event->poster_path) {
                Storage::disk('public')->delete($event->poster_path);
            }
            
            // Simpan poster baru dan masukkan path-nya ke array validated
            $validated['poster_path'] = $request->file('poster_path')->store('posters', 'public');
        }

        $event->update($validated);

        return redirect()->route('admin.events.index')->with('success', 'Event berhasil diperbarui!');
    }

    public function destroy($id)
    {
        $event = Event::findOrFail($id);

        // Hapus poster dari storage sebelum menghapus data event
        if ($event->poster_path) {
            Storage::disk('public')->delete($event->poster_path);
        }

        $event->delete();

        return redirect()->route('admin.events.index')->with('success', 'Event berhasil dihapus!');
    }
}