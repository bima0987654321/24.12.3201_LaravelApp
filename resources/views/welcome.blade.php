@extends('layouts.app')

@section('content')
    <section class="max-w-7xl mx-auto px-6 py-20 flex flex-col md:flex-row items-center gap-12">
        <div class="flex-1 space-y-8">
            <span
                class="inline-block px-4 py-1.5 bg-indigo-100 text-indigo-700 rounded-full text-sm font-bold uppercase tracking-wider">
                #1 Event Platform
            </span>
            <h1 class="text-5xl md:text-7xl font-extrabold leading-tight">
                Temukan & Pesan <span class="text-indigo-600">Tiket Event</span> Impianmu.
            </h1>
            <p class="text-lg text-slate-500 max-w-lg leading-relaxed">
                Dari konser musik hingga workshop teknologi, semua ada di genggamanmu. Pesan aman & cepat dengan Midtrans.
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
            <div
                class="absolute -top-10 -left-10 w-64 h-64 bg-indigo-400 rounded-full mix-blend-multiply filter blur-3xl opacity-20 animate-blob">
            </div>
            <div
                class="absolute -bottom-10 -right-10 w-64 h-64 bg-purple-400 rounded-full mix-blend-multiply filter blur-3xl opacity-20 animate-blob animation-delay-2000">
            </div>

            <img src="{{ asset('assets/concert.png') }}" alt="Concert"
                class="rounded-[2rem] shadow-2xl relative z-10 w-full object-cover aspect-[4/5] object-center">

            <div class="absolute -bottom-6 -left-6 glass p-6 rounded-2xl shadow-xl z-20 border border-white">
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

    <section id="events" class="max-w-7xl mx-auto px-6 py-20">
        <div class="flex flex-col md:flex-row justify-between items-end mb-12 gap-6">
            <div>
                <h2 class="text-3xl font-extrabold mb-2">Event Terdekat</h2>
                <p class="text-slate-500 font-medium">Jangan sampai ketinggalan acara seru minggu ini!</p>
            </div>

            <div class="flex gap-3 flex-wrap items-center">
                <a href="/"
                    class="px-6 py-2.5 rounded-full text-sm font-semibold transition-all duration-300 
        {{ !request('category')
            ? 'bg-indigo-600 text-white shadow-lg shadow-indigo-200'
            : 'bg-white text-slate-600 border border-slate-200 hover:border-indigo-600 hover:text-indigo-600' }}">
                    Semua Kategori
                </a>

                @foreach ($categories as $cat)
                    <a href="/?category={{ $cat->slug }}"
                        class="px-6 py-2.5 rounded-full text-sm font-semibold transition-all duration-300
            {{ request('category') == $cat->slug
                ? 'bg-indigo-600 text-white shadow-lg shadow-indigo-200'
                : 'bg-white text-slate-600 border border-slate-200 hover:border-indigo-600 hover:text-indigo-600' }}">
                        {{ $cat->name }}
                    </a>
                @endforeach
            </div>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
            @foreach ($events as $event)
                <div
                    class="group bg-white rounded-3xl border border-slate-100 shadow-sm hover:shadow-2xl transition-all duration-300 overflow-hidden">
                    <div class="relative overflow-hidden aspect-[3/4]">

                        <img src="{{ asset('assets/' . $event->image) }}" alt="{{ $event->title }}"
                            class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-500">

                        <div
                            class="absolute top-4 left-4 px-3 py-1 bg-white/90 backdrop-blur rounded-lg text-xs font-bold uppercase text-indigo-600">
                            {{ $event->category->name }}
                        </div>
                    </div>

                    <div class="p-6">
                        <h3 class="text-xl font-bold mb-2 group-hover:text-indigo-600 transition">
                            {{ $event->title }}
                        </h3>

                        <div class="flex items-center gap-2 text-slate-500 text-sm mb-4">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                            <span>{{ \Carbon\Carbon::parse($event->date)->format('d-m-Y H:i') }}</span>
                        </div>

                        <div class="flex justify-between items-center pt-4 border-t">
                            <span class="text-2xl font-black text-indigo-600">
                                Rp {{ number_format($event->price, 0, ',', '.') }}
                            </span>
                            <a href="{{ url('event/' . $event->id) }}"
                                class="px-5 py-2 bg-indigo-50 text-indigo-600 rounded-xl font-bold hover:bg-indigo-600 hover:text-white transition">
                                Lihat Detail
                            </a>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </section>

    <!-- Partners Section -->
    <section class="max-w-7xl mx-auto px-6 py-20">
        <div class="mb-12">
            <h2 class="text-3xl font-extrabold mb-2">Partner Kami</h2>
            <p class="text-slate-500 font-medium">Dipercaya oleh instansi dan perusahaan terkemuka</p>
        </div>

        <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-5 gap-8 items-center">
            @forelse($partners as $partner)
                <div
                    class="flex items-center justify-center p-6 bg-white rounded-xl border border-slate-100 hover:shadow-lg transition-shadow duration-300">
                    <img src="{{ $partner->logo_url }}" alt="{{ $partner->name }}" class="max-w-full h-16 object-contain"
                        title="{{ $partner->name }}">
                </div>
            @empty
                <div class="col-span-full text-center text-slate-500 py-12">
                    Tidak ada partner yang ditampilkan saat ini.
                </div>
            @endforelse
        </div>
    </section>

    <!-- Categories Section Info -->
    <section class="max-w-7xl mx-auto px-6 py-20 border-t">
        <div class="mb-12">
            <h2 class="text-3xl font-extrabold mb-2">Kategori Event di AmikomEventHub</h2>
            <p class="text-slate-500 font-medium">Berbagai jenis event untuk memenuhi kebutuhan Anda</p>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
            @forelse($categories as $category)
                <div
                    class="p-6 bg-gradient-to-br from-indigo-50 to-indigo-100 rounded-xl border border-indigo-200 hover:shadow-lg transition-shadow duration-300">
                    <div class="flex items-center justify-between mb-3">
                        <h3 class="text-lg font-bold text-slate-800">{{ $category->name }}</h3>
                        <span class="text-2xl">📌</span>
                    </div>
                    <p class="text-slate-600 text-sm">
                        Temukan semua event dalam kategori <strong>{{ $category->name }}</strong> dan jangan lewatkan
                        kesempatan emas ini.
                    </p>
                    <a href="/?category={{ $category->slug }}"
                        class="inline-block mt-4 px-4 py-2 bg-indigo-600 text-white rounded-lg text-sm font-bold hover:bg-indigo-700 transition">
                        Lihat Event →
                    </a>
                </div>
            @empty
                <div class="col-span-full text-center text-slate-500 py-12">
                    Tidak ada kategori yang ditampilkan saat ini.
                </div>
            @endforelse
        </div>
    </section>
@endsection
