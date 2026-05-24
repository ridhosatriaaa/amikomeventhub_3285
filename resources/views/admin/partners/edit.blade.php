@extends('layouts.admin')

@section('content')
<main class="flex-1 p-10 overflow-y-auto">
    <header class="mb-10">
        <a href="{{ route('admin.partners.index') }}" class="text-sm font-bold text-indigo-600 hover:underline flex items-center gap-1 mb-2">
            ← Kembali ke Daftar Partner
        </a>
        <h1 class="text-3xl font-black">Edit Partner</h1>
        <p class="text-slate-500 font-medium">Ubah informasi partner yang dipilih.</p>
    </header>

    <div class="max-w-2xl bg-white rounded-[2.5rem] border border-slate-100 shadow-sm p-8">
        <form action="{{ route('admin.partners.update', $partner->id) }}" method="POST" enctype="multipart/form-data" class="space-y-6">
            @csrf
            @method('PUT')

            <div>
                <label class="block text-sm font-bold text-slate-700 mb-2">Nama Partner <span class="text-rose-500">*</span></label>
                <input type="text" name="name" value="{{ old('name', $partner->name) }}" placeholder="Contoh: PT. Amikom Media Utama"
                       class="w-full px-4 py-3 bg-slate-50 border @error('name') border-rose-500 @else border-slate-200 @enderror rounded-xl text-sm focus:ring-2 focus:ring-indigo-600 outline-none transition">
                @error('name')
                    <p class="text-rose-500 text-xs font-semibold mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label class="block text-sm font-bold text-slate-700 mb-2">Logo Partner</label>
                
                @if($partner->logo_url)
                <div class="mb-3 p-4 bg-slate-50 rounded-2xl border w-44 flex flex-col items-center justify-center gap-2">
                    <span class="text-[10px] uppercase tracking-wider text-slate-400 font-bold">Logo Saat Ini:</span>
                    <img src="{{ Storage::url($partner->logo_url) }}" class="h-16 w-auto object-contain">
                </div>
                @endif

                <input type="file" name="logo" 
                       class="w-full px-4 py-2.5 bg-slate-50 border @error('logo') border-rose-500 @else border-slate-200 @enderror rounded-xl text-sm focus:ring-2 focus:ring-indigo-600 outline-none file:mr-4 file:py-1 file:px-3 file:rounded-xl file:border-0 file:text-xs file:font-bold file:bg-indigo-50 file:text-indigo-600 hover:file:bg-indigo-100 transition">
                <p class="text-slate-400 text-[11px] mt-1">Kosongkan kolom berkas jika Anda tidak ingin mengubah logo yang ada.</p>
                @error('logo')
                    <p class="text-rose-500 text-xs font-semibold mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="pt-4 border-t flex justify-end gap-3">
                <a href="{{ route('admin.partners.index') }}" class="px-6 py-3 bg-slate-100 text-slate-600 rounded-2xl font-bold text-sm hover:bg-slate-200 transition">Batal</a>
                <button type="submit" class="px-6 py-3 bg-indigo-600 text-white rounded-2xl font-bold text-sm hover:bg-indigo-700 shadow-md transition">Perbarui Partner</button>
            </div>
        </form>
    </div>
</main>
@endsection