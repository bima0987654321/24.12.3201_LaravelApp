@extends('layouts.admin')

@section('content')

<!-- Title -->
<div class="flex justify-between items-center mb-6">
    <h1 class="text-2xl font-bold">Manajemen Kategori</h1>

    <button class="bg-indigo-600 text-white px-4 py-2 rounded-lg">
        + Tambah Kategori
    </button>
</div>

<!-- Table -->
<div class="bg-white rounded-2xl shadow-sm border overflow-hidden">
    <table class="w-full text-left">
        <thead class="bg-slate-100 text-sm uppercase">
            <tr>
                <th class="px-6 py-3">No</th>
                <th class="px-6 py-3">Nama Kategori</th>
                <th class="px-6 py-3">Aksi</th>
            </tr>
        </thead>

        <tbody class="divide-y">
            <tr>
                <td class="px-6 py-4">1</td>
                <td class="px-6 py-4">Seminar</td>
                <td class="px-6 py-4 flex gap-2">
                    <button class="bg-yellow-400 px-3 py-1 rounded text-white">Edit</button>
                    <button class="bg-red-500 px-3 py-1 rounded text-white">Hapus</button>
                </td>
            </tr>

            <tr>
                <td class="px-6 py-4">2</td>
                <td class="px-6 py-4">Workshop</td>
                <td class="px-6 py-4 flex gap-2">
                    <button class="bg-yellow-400 px-3 py-1 rounded text-white">Edit</button>
                    <button class="bg-red-500 px-3 py-1 rounded text-white">Hapus</button>
                </td>
            </tr>

            <tr>
                <td class="px-6 py-4">3</td>
                <td class="px-6 py-4">Konser</td>
                <td class="px-6 py-4 flex gap-2">
                    <button class="bg-yellow-400 px-3 py-1 rounded text-white">Edit</button>
                    <button class="bg-red-500 px-3 py-1 rounded text-white">Hapus</button>
                </td>
            </tr>
        </tbody>
    </table>
</div>

@endsection