@extends('layouts.admin')

@section('content')
    <div class="p-6">
        <div class="flex justify-between items-center mb-6">
            <h2 class="text-2xl font-bold">Manajemen Partner</h2>
            <a href="{{ route('admin.partners.create') }}"
                class="bg-indigo-600 text-white px-4 py-2 rounded font-semibold hover:bg-indigo-700">
                Tambah Partner
            </a>
        </div>

        {{-- Notifikasi Sukses untuk Tugas 4 --}}
        @if (session('success'))
            <div class="bg-green-100 text-green-700 p-4 rounded mb-5 border border-green-200">
                {{ session('success') }}
            </div>
        @endif

        <div class="overflow-x-auto">
            <table class="w-full bg-white rounded-lg shadow-sm border border-gray-200 text-left">
                <thead>
                    <tr class="bg-gray-50 border-b border-gray-200">
                        <th class="p-4 font-semibold text-gray-600">No</th>
                        <th class="p-4 font-semibold text-gray-600">Nama Partner</th>
                        <th class="p-4 font-semibold text-gray-600">Logo</th>
                        <th class="p-4 font-semibold text-gray-600 text-center">Aksi Pilihan</th>
                    </tr>
                </thead>
                <tbody>
                    {{-- Tugas 3: Looping data partner  --}}
                    @foreach ($partners as $partner)
                        <tr class="border-b border-gray-100 hover:bg-gray-50">
                            <td class="p-4 text-gray-800">{{ $loop->iteration }}</td>
                            <td class="p-4 text-gray-800 font-medium">{{ $partner->name }}</td>
                            <td class="p-4">
                                <img src="{{ $partner->logo_url }}" alt="{{ $partner->name }}"
                                    class="h-12 w-12 object-cover rounded border border-gray-200">
                            </td>
                            <td class="p-4 flex gap-2 justify-center">
                                {{-- Placeholder untuk fitur Edit/Hapus jika diperlukan --}}
                                <button
                                    class="bg-blue-50 text-blue-600 border border-blue-200 px-3 py-1.5 rounded text-sm font-semibold">
                                    Edit
                                </button>
                                <button
                                    class="bg-red-100 text-red-600 border border-red-200 px-3 py-1.5 rounded text-sm font-semibold">
                                    Hapus
                                </button>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>

            @if ($partners->isEmpty())
                <div class="text-center p-8 text-gray-500">
                    Belum ada data partner.
                </div>
            @endif
        </div>
    </div>
@endsection
