@extends('layouts.app')

@section('content')

<section class="max-w-7xl mx-auto px-6 py-20 flex flex-col md:flex-row items-center gap-12">
    <div class="flex-1 space-y-8">
        <span class="inline-block px-4 py-1.5 bg-indigo-100 text-indigo-700 rounded-full text-sm font-bold uppercase tracking-wider">
            #1 Event Platform
        </span>

        <h1 class="text-5xl md:text-7xl font-extrabold leading-tight">
            Temukan & Pesan <span class="text-indigo-600">Tiket Event</span> Impianmu.
        </h1>

        <p class="text-lg text-slate-500 max-w-lg leading-relaxed">
            Dari konser musik hingga workshop teknologi, semua ada di genggamanmu.
            Pesan aman & cepat dengan Midtrans.
        </p>

        <div class="flex gap-4">
            <a href="#events"
                class="px-8 py-4 bg-indigo-600 text-white rounded-2xl font-bold text-lg shadow-xl shadow-indigo-200 hover:scale-105 transition-transform">
                Mulai Jelajah
            </a>

            <a href="#"
                class="px-8 py-4 border-2 border-slate-200 rounded-2xl font-bold text-lg hover:border-indigo-600 hover:text-indigo-600 transition">
                Cara Pesan
            </a>
        </div>
    </div>

    <div class="flex-1 relative">
        <div class="absolute -top-10 -left-10 w-64 h-64 bg-indigo-400 rounded-full mix-blend-multiply filter blur-3xl opacity-20 animate-blob">
        </div>

        <div class="absolute -bottom-10 -right-10 w-64 h-64 bg-purple-400 rounded-full mix-blend-multiply filter blur-3xl opacity-20 animate-blob animation-delay-2000">
        </div>

        <img src="{{ asset('storage/posters/event-2.png') }}" alt="test"
            class="rounded-[2rem] shadow-2xl relative z-10 w-full object-cover aspect-[4/5] object-center">

        <div class="absolute -bottom-6 -left-6 glass p-6 rounded-2xl shadow-xl z-20 border border-white bg-white/80 backdrop-blur-md">
            <div class="flex items-center gap-4">
                <div class="w-12 h-12 bg-green-100 rounded-full flex items-center justify-center text-green-600">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                    </svg>
                </div>
                <div>
                    <p class="text-xs text-slate-500 font-bold uppercase">Terverifikasi</p>
                    <p class="font-bold">Pembayaran Aman via Midtrans</p>
                </div>
            </div>
        </div>
    </div>
</section>

<section class="py-16 bg-white border-t border-b border-slate-50">
    <div class="max-w-7xl mx-auto px-6">
        <div class="text-center mb-12">
            <h2 class="text-3xl font-black text-slate-900 tracking-tight">Jelajahi Kategori Event</h2>
            <p class="text-slate-500 mt-2 font-medium">Temukan berbagai macam event menarik sesuai dengan minatmu di AmikomEventHub</p>
        </div>

        <div class="grid grid-cols-2 md:grid-cols-4 lg:grid-cols-6 gap-4">
            @forelse($categories as $category)
                @php
                    $isActive = request('category') === $category->slug;
                @endphp
                <a href="?category={{ $category->slug ?? '' }}#events" 
                   class="p-6 border rounded-2xl text-center transition group flex flex-col items-center justify-center
                          {{ $isActive ? 'bg-indigo-600 border-indigo-600 text-white shadow-lg shadow-indigo-100' : 'bg-slate-50 border-slate-100 hover:bg-indigo-50 hover:border-indigo-200' }}">
                    
                    <div class="w-12 h-12 rounded-xl shadow-sm flex items-center justify-center mb-4 group-hover:scale-110 transition
                                {{ $isActive ? 'bg-white text-indigo-600' : 'bg-white text-indigo-600' }}">
                        <span class="font-black text-lg uppercase">
                            {{ substr($category->name, 0, 1) }}
                        </span>
                    </div>
                    <span class="block font-bold text-sm transition
                                 {{ $isActive ? 'text-white' : 'text-slate-700 group-hover:text-indigo-700' }}">
                        {{ $category->name }}
                    </span>
                </a>
            @empty
                <div class="col-span-full text-center text-slate-400 py-4">Belum ada kategori event tersedia.</div>
            @endforelse
        </div>
    </div>
</section>

<section id="events" class="max-w-7xl mx-auto px-6 py-20">
    <div class="flex justify-between items-end mb-12">
        <div>
            <h2 class="text-3xl font-extrabold mb-2">
                @if(request('category'))
                    Event Kategori: <span class="text-indigo-600 capitalize">{{ str_replace('-', ' ', request('category')) }}</span>
                @else
                    Event Terdekat
                @endif
            </h2>
            <p class="text-slate-500 font-medium">Jangan sampai ketinggalan acara seru minggu ini!</p>
        </div>
        <div class="flex gap-2">
            <a href="{{ url('/') }}#events" class="p-3 border rounded-xl bg-slate-50 hover:bg-white hover:shadow-md text-sm font-bold text-slate-700 transition">
                Semua Kategori
            </a>
        </div>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
        @forelse($events as $event)
            <div class="group bg-white rounded-3xl border border-slate-100 shadow-sm hover:shadow-2xl transition-all duration-300 overflow-hidden flex flex-col">
                <div class="relative overflow-hidden aspect-[3/4]">
                    @if(isset($event->poster_path) && $event->poster_path)
                        <img src="{{ asset('storage/' . $event->poster_path) }}" alt="{{ $event->title }}" class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-500">
                    @else
                        <div class="w-full h-full bg-slate-100 flex items-center justify-center text-slate-400 font-bold uppercase">No Image</div>
                    @endif
                    
                    <div class="absolute top-4 left-4 px-3 py-1 bg-white/90 backdrop-blur rounded-lg text-xs font-bold uppercase text-indigo-600">
                        {{ $event->category->name ?? 'Umum' }}
                    </div>
                </div>
                
                <div class="p-6 flex-1 flex flex-col">
                    <h3 class="text-xl font-bold mb-2 group-hover:text-indigo-600 transition">{{ $event->title }}</h3>
                    <div class="flex items-center gap-2 text-slate-500 text-sm mb-4">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                        <span>{{ \Carbon\Carbon::parse($event->date)->translatedFormat('d F Y') }}</span>
                    </div>
                    
                    <div class="flex justify-between items-center pt-4 border-t mt-auto">
                        <span class="text-2xl font-black text-indigo-600">
                            @if($event->price == 0)
                                Gratis
                            @else
                                Rp {{ number_format($event->price, 0, ',', '.') }}
                            @endif
                        </span>
                        
                        <a href="{{ route('event.detail', ['id' => $event->id]) }}" class="px-5 py-2 bg-indigo-50 text-indigo-600 rounded-xl font-bold hover:bg-indigo-600 hover:text-white transition whitespace-nowrap">
                            Lihat Detail
                        </a>
                    </div>
                </div>
            </div>
        @empty
            <div class="col-span-full text-center text-slate-400 py-12 bg-slate-50 rounded-3xl border border-dashed">
                Belum ada event untuk kategori ini.
            </div>
        @endforelse
    </div>
</section>

<section class="py-16 bg-slate-50/70 border-t border-slate-100">
    <div class="max-w-7xl mx-auto px-6">
        <div class="text-center mb-12">
            <span class="text-xs font-black tracking-widest text-indigo-600 uppercase bg-indigo-50 px-3 py-1 rounded-full">Our Partners</span>
            <h2 class="text-2xl font-extrabold text-slate-800 mt-3">Didukung Oleh Partner Resmi</h2>
            <p class="text-slate-500 text-sm mt-1">AmikomEventHub bekerja sama dengan berbagai instansi terpercaya</p>
        </div>

        <div class="flex flex-wrap items-center justify-center gap-8 md:gap-16">
            @forelse($partners as $partner)
                <div class="grayscale hover:grayscale-0 opacity-60 hover:opacity-100 transition duration-300 transform hover:scale-105" title="{{ $partner->name }}">
                    <img src="{{ asset('storage/' . $partner->logo_url) }}" 
                         alt="Logo {{ $partner->name }}" 
                         class="h-12 md:h-14 w-auto object-contain max-w-[150px]">
                </div>
            @empty
                <div class="text-center text-slate-400 text-sm py-4">Mari bergabung menjadi partner event kami.</div>
            @endforelse
        </div>
    </div>
</section>

@endsection