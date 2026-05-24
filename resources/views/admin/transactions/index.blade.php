@extends('layouts.admin')

@section('content')
<main class="flex-1 p-10 overflow-y-auto">
    
    <header class="flex justify-between items-center mb-10">
        <div>
            <h1 class="text-3xl font-black">Manajemen Transaksi</h1>
            <p class="text-slate-500 font-medium">Pantau dan kelola seluruh pembayaran tiket event</p>
        </div>
    </header>

    <div class="bg-white rounded-[2.5rem] border border-slate-100 shadow-sm overflow-hidden">
        <div class="px-8 py-6 bg-slate-50/50 border-b flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
            <h3 class="font-black text-xl">Daftar Transaksi</h3>
            
            <div class="flex gap-2 w-full sm:w-auto">
                <input type="text" placeholder="Cari nama pembeli..." 
                       class="px-4 py-2 bg-white border border-slate-200 rounded-xl text-sm focus:ring-2 focus:ring-indigo-600 outline-none w-full sm:w-64 transition">
                <button class="px-4 py-2 bg-indigo-600 text-white rounded-xl text-sm font-bold hover:bg-indigo-700 transition">Cari</button>
            </div>
        </div>

        <div class="overflow-x-auto">
            <table class="w-full text-left border-collapse">
                <thead class="bg-slate-50 text-slate-400 uppercase text-[10px] font-black tracking-widest">
                    <tr>
                        <th class="px-8 py-4">Pembeli</th>
                        <th class="px-8 py-4">Event</th>
                        <th class="px-8 py-4">Status</th>
                        <th class="px-8 py-4">Total Pembayaran</th>
                    </tr>
                </thead>
                <tbody class="divide-y border-t">
                    <tr class="hover:bg-slate-50 transition">
                        <td class="px-8 py-6">
                            <p class="font-bold uppercase tracking-wide text-sm">Donni Prabowo</p>
                            <p class="text-xs text-slate-400">donni@example.com</p>
                        </td>
                        <td class="px-8 py-6 font-medium text-slate-600">Jazz Night 2026</td>
                        <td class="px-8 py-6">
                            <span class="px-3 py-1 bg-green-100 text-green-700 rounded-lg text-xs font-bold uppercase">Success</span>
                        </td>
                        <td class="px-8 py-6 font-black text-indigo-600">Rp 155.000</td>
                    </tr>
                    
                    <tr class="hover:bg-slate-50 transition">
                        <td class="px-8 py-6">
                            <p class="font-bold uppercase tracking-wide text-sm">Maya Sari</p>
                            <p class="text-xs text-slate-400">maya@example.com</p>
                        </td>
                        <td class="px-8 py-6 font-medium text-slate-600">AI & Future Workshop</td>
                        <td class="px-8 py-6">
                            <span class="px-3 py-1 bg-orange-100 text-orange-700 rounded-lg text-xs font-bold uppercase">Pending</span>
                        </td>
                        <td class="px-8 py-6 font-black text-indigo-600">Rp 55.000</td>
                    </tr>
                    
                    <tr class="hover:bg-slate-50 transition">
                        <td class="px-8 py-6">
                            <p class="font-bold uppercase tracking-wide text-sm">Budi Santoso</p>
                            <p class="text-xs text-slate-400">budi@example.com</p>
                        </td>
                        <td class="px-8 py-6 font-medium text-slate-600">Hackathon 2026</td>
                        <td class="px-8 py-6">
                            <span class="px-3 py-1 bg-slate-100 text-slate-600 rounded-lg text-xs font-bold uppercase">Free</span>
                        </td>
                        <td class="px-8 py-6 font-black text-indigo-600">Rp 0</td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</main>
@endsection