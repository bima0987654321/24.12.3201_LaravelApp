@extends('layouts.admin')

@section('content')
    <!-- Back Button -->
    <div class="mb-6">
        <a href="{{ route('admin.partners.index') }}" class="text-indigo-600 hover:text-indigo-700 font-medium">
            ← Kembali ke Partner
        </a>
    </div>

    <!-- Title -->
    <h1 class="text-2xl font-bold mb-6">Edit Partner: {{ $partner->name }}</h1>

    <!-- Form Card -->
    <div class="bg-white rounded-2xl shadow-sm border p-8 max-w-2xl">
        <form action="{{ route('admin.partners.update', $partner) }}" method="POST">
            @csrf
            @method('PUT')

            <!-- Name Field -->
            <div class="mb-6">
                <label for="name" class="block text-sm font-semibold text-slate-700 mb-2">Nama Partner</label>
                <input type="text" id="name" name="name" placeholder="Masukkan nama instansi/perusahaan"
                    class="w-full px-4 py-2 border border-slate-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-indigo-600 @error('name') border-red-500 @enderror"
                    value="{{ old('name', $partner->name) }}">
                @error('name')
                    <p class="text-red-500 text-sm mt-2">{{ $message }}</p>
                @enderror
            </div>

            <!-- Logo URL Field -->
            <div class="mb-6">
                <label for="logo_url" class="block text-sm font-semibold text-slate-700 mb-2">Logo URL</label>
                <div class="mb-3">
                    <img src="{{ $partner->logo_url }}" alt="{{ $partner->name }}"
                        class="h-16 w-16 object-cover rounded border border-gray-300">
                </div>
                <input type="url" id="logo_url" name="logo_url" placeholder="https://example.com/logo.png"
                    class="w-full px-4 py-2 border border-slate-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-indigo-600 @error('logo_url') border-red-500 @enderror"
                    value="{{ old('logo_url', $partner->logo_url) }}">
                <p class="text-slate-500 text-xs mt-2">Gunakan URL gambar langsung (Direct Link)</p>
                @error('logo_url')
                    <p class="text-red-500 text-sm mt-2">{{ $message }}</p>
                @enderror
            </div>

            <!-- Buttons -->
            <div class="flex gap-3">
                <button type="submit"
                    class="bg-indigo-600 text-white px-6 py-2 rounded-lg hover:bg-indigo-700 transition font-medium">
                    Perbarui Partner
                </button>
                <a href="{{ route('admin.partners.index') }}"
                    class="bg-slate-300 text-slate-700 px-6 py-2 rounded-lg hover:bg-slate-400 transition font-medium">
                    Batal
                </a>
            </div>
        </form>
    </div>
@endsection
