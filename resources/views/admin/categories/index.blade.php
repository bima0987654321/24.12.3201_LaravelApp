@extends('layouts.admin')

@section('content')

    <!-- Alert Messages -->
    @if ($message = Session::get('success'))
        <div class="mb-4 p-4 bg-green-100 border border-green-400 text-green-700 rounded-lg">
            {{ $message }}
        </div>
    @endif

    @if ($errors->any())
        <div class="mb-4 p-4 bg-red-100 border border-red-400 text-red-700 rounded-lg">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <!-- Title -->
    <div class="flex justify-between items-center mb-6">
        <h1 class="text-2xl font-bold">Manajemen Kategori</h1>

        <a href="{{ route('admin.categories.create') }}"
            class="bg-indigo-600 text-white px-4 py-2 rounded-lg hover:bg-indigo-700 transition">
            + Tambah Kategori
        </a>
    </div>

    <!-- Search Form -->
    <div class="bg-white rounded-2xl shadow-sm border p-4 mb-6">
        <form action="{{ route('admin.categories.index') }}" method="GET" class="flex gap-2">
            <input type="text" name="search" placeholder="Cari nama kategori..." value="{{ $search }}"
                class="flex-1 px-4 py-2 border border-slate-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-indigo-600">
            <button type="submit"
                class="bg-indigo-600 text-white px-6 py-2 rounded-lg hover:bg-indigo-700 transition font-medium">
                Cari
            </button>
            @if ($search)
                <a href="{{ route('admin.categories.index') }}"
                    class="bg-slate-300 text-slate-700 px-6 py-2 rounded-lg hover:bg-slate-400 transition font-medium">
                    Reset
                </a>
            @endif
        </form>
    </div>

    <!-- Table -->
    <div class="bg-white rounded-2xl shadow-sm border overflow-hidden">
        <table class="w-full text-left">
            <thead class="bg-slate-100 text-sm uppercase">
                <tr>
                    <th class="px-6 py-3">No</th>
                    <th class="px-6 py-3">Nama Kategori</th>
                    <th class="px-6 py-3">Dibuat</th>
                    <th class="px-6 py-3">Diperbarui</th>
                    <th class="px-6 py-3">Aksi</th>
                </tr>
            </thead>

            <tbody class="divide-y">
                @forelse($categories as $key => $category)
                    <tr>
                        <td class="px-6 py-4">{{ $key + 1 }}</td>
                        <td class="px-6 py-4">{{ $category->name }}</td>
                        <td class="px-6 py-4">{{ $category->created_at->format('d/m/Y H:i') }}</td>
                        <td class="px-6 py-4">{{ $category->updated_at->format('d/m/Y H:i') }}</td>
                        <td class="px-6 py-4 flex gap-2">
                            <a href="{{ route('admin.categories.edit', $category) }}"
                                class="bg-yellow-400 hover:bg-yellow-500 px-3 py-1 rounded text-white transition">Edit</a>
                            <form action="{{ route('admin.categories.destroy', $category) }}" method="POST"
                                style="display:inline;"
                                onsubmit="return confirm('Apakah Anda yakin ingin menghapus kategori ini?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit"
                                    class="bg-red-500 hover:bg-red-600 px-3 py-1 rounded text-white transition">Hapus</button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" class="px-6 py-4 text-center text-slate-500">Tidak ada kategori. <a
                                href="{{ route('admin.categories.create') }}"
                                class="text-indigo-600 hover:text-indigo-700">Buat kategori baru</a></td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

@endsection
