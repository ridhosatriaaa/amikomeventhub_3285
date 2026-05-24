@extends('layouts.admin')

@section('content')
<main class="flex-1 p-10 overflow-y-auto">
    
    @if(session('success'))
        <div class="mb-6 p-4 bg-green-50 border border-green-200 text-green-700 rounded-xl font-medium shadow-sm">
            {{ session('success') }}
        </div>
    @endif

    @if($errors->any())
        <div class="mb-6 p-4 bg-rose-50 border border-rose-200 text-rose-700 rounded-xl font-medium shadow-sm">
            <ul class="list-disc list-inside text-sm">
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <header class="mb-10">
        <h1 class="text-3xl font-black">Manajemen Kategori</h1>
        <p class="text-slate-500 font-medium">Kelola kategori kelompok untuk event-event Anda</p>
    </header>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
        
        <div class="lg:col-span-1">
            <div class="bg-white rounded-[2.5rem] border border-slate-100 shadow-sm p-8 sticky top-6">
                <h3 class="font-black text-xl mb-6">Tambah Kategori</h3>
                
                <form action="{{ route('admin.categories.store') }}" method="POST">
                    @csrf
                    <div class="mb-6">
                        <label class="block text-slate-700 font-bold mb-2">Nama Kategori</label>
                        <input type="text" name="name" required autocomplete="off" 
                               class="w-full px-4 py-3 bg-slate-50 border border-slate-200 rounded-xl focus:ring-2 focus:ring-indigo-600 outline-none transition" 
                               placeholder="Contoh: Konser, Workshop, Olahraga">
                    </div>

                    <button type="submit" class="w-full px-6 py-3 bg-indigo-600 text-white rounded-xl font-bold shadow-lg shadow-indigo-100 hover:bg-indigo-700 transition">
                        Simpan Kategori
                    </button>
                </form>
            </div>
        </div>

        <div class="lg:col-span-2">
            <div class="bg-white rounded-[2.5rem] border border-slate-100 shadow-sm overflow-hidden">
                
                <div class="px-8 py-6 bg-slate-50/50 border-b flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
                    <h3 class="font-black text-xl">Daftar Kategori Saat Ini</h3>
                    
                    <form action="{{ route('admin.categories.index') }}" method="GET" class="flex gap-2 w-full sm:w-auto">
                        <input type="text" name="search" value="{{ request('search') }}" placeholder="Cari kategori..." 
                               class="px-4 py-2 bg-white border border-slate-200 rounded-xl text-sm focus:ring-2 focus:ring-indigo-600 outline-none w-full sm:w-56 transition">
                        <button type="submit" class="px-4 py-2 bg-indigo-600 text-white rounded-xl text-sm font-bold hover:bg-indigo-700 transition">
                            Cari
                        </button>
                    </form>
                </div>

                <div class="overflow-x-auto">
                    <table class="w-full text-left border-collapse">
                        <thead class="bg-slate-50 text-slate-400 uppercase text-[10px] font-black tracking-widest">
                            <tr>
                                <th class="px-8 py-4 w-20">No</th>
                                <th class="px-8 py-4">Nama Kategori</th>
                                <th class="px-8 py-4 text-center w-32">Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y border-t">
                            @forelse ($categories as $index => $category)
                            <tr class="hover:bg-slate-50/50 transition">
                                <td class="px-8 py-6 font-bold text-slate-400">{{ $index + 1 }}</td>
                                <td class="px-8 py-6 font-bold text-slate-800">{{ $category->name }}</td>
                                <td class="px-8 py-6">
                                    <div class="flex gap-2 justify-center">
                                        <form action="{{ route('admin.categories.destroy', $category) }}" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin menghapus kategori {{ $category->name }}?');">
                                            @csrf
                                            @method('DELETE')
                                            <button class="p-2 bg-rose-50 text-rose-600 rounded-xl hover:bg-rose-600 hover:text-white transition text-xs font-bold px-3 py-1.5">
                                                Hapus
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="3" class="px-8 py-10 text-center text-slate-400 font-medium">Belum ada data kategori. Silakan tambahkan melalui form di sebelah kiri.</td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

    </div>
</main>
@endsection