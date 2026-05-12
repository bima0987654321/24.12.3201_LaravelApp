@extends('layouts.admin')

@section('content')
    <div class="p-6">
        <div class="mb-6">
            <h2 class="text-2xl font-bold">Tambah Partner Baru</h2>
            <p class="text-gray-600">Silakan isi formulir di bawah untuk mendaftarkan partner pendukung.</p>
        </div>

        <div class="max-w-2xl bg-white p-8 rounded-lg shadow-sm border border-gray-200">
            <form action="{{ route('admin.partners.store') }}" method="POST">
                @csrf
                
                <div class="mb-5">
                    <label for="name" class="block text-sm font-semibold text-gray-700 mb-2">Nama Partner</label>
                    <input type="text" name="name" id="name" required placeholder="Masukkan nama instansi/perusahaan"
                        class="w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 p-2.5 border @error('name') border-red-500 @enderror">
                    @error('name')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div class="mb-6">
                    <label for="logo_url" class="block text-sm font-semibold text-gray-700 mb-2">Logo URL</label>
                    <input type="url" name="logo_url" id="logo_url" required placeholder="https://placehold.co/200x200"
                        class="w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 p-2.5 border @error('logo_url') border-red-500 @enderror">
                    <p class="text-gray-400 text-xs mt-2">Gunakan URL gambar langsung (Direct Link).</p>
                    @error('logo_url')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div class="flex items-center gap-4">
                    <button type="submit" 
                        class="bg-indigo-600 text-white px-6 py-2.5 rounded-md font-bold hover:bg-indigo-700 transition duration-200">
                        Simpan Partner
                    </button>
                    <a href="{{ route('admin.partners.index') }}" class="text-gray-600 hover:underline font-medium">
                        Batal
                    </a>
                </div>
            </form>
        </div>
    </div>
@endsection