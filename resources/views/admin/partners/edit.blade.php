@extends('layouts.admin')

@section('content')
    <div class="p-6">
        <h2 class="text-2xl font-bold mb-6">Edit Partner: {{ $partner->name }}</h2>

        <div class="max-w-2xl bg-white p-8 rounded-lg shadow-sm border border-gray-200">
            <form action="{{ route('admin.partners.update', $partner->id) }}" method="POST">
                @csrf
                @method('PUT') {{-- Penting untuk proses update --}}
                
                <div class="mb-5">
                    <label class="block text-sm font-semibold text-gray-700 mb-2">Nama Partner</label>
                    <input type="text" name="name" value="{{ $partner->name }}" required
                        class="w-full border-gray-300 rounded-md shadow-sm p-2.5 border">
                </div>

                <div class="mb-6">
                    <label class="block text-sm font-semibold text-gray-700 mb-2">Logo URL</label>
                    <input type="url" name="logo_url" value="{{ $partner->logo_url }}" required
                        class="w-full border-gray-300 rounded-md shadow-sm p-2.5 border">
                </div>

                <div class="flex items-center gap-4">
                    <button type="submit" class="bg-indigo-600 text-white px-6 py-2.5 rounded-md font-bold hover:bg-indigo-700">
                        Perbarui Partner
                    </button>
                    <a href="{{ route('admin.partners.index') }}" class="text-gray-600 hover:underline">Batal</a>
                </div>
            </form>
        </div>
    </div>
@endsection