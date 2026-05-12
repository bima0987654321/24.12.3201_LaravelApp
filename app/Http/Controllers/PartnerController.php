<?php

namespace App\Http\Controllers;

use App\Models\Partner;
use Illuminate\Http\Request;

class PartnerController extends Controller
{
    public function index()
    {
        // Mengambil semua data dari tabel partners 
        $partners = Partner::all();

        // Mengirim data ke view index di folder admin/partners 
        return view('admin.partners.index', compact('partners'));
    }

    public function store(Request $request)
    {
        // Validasi input
        $request->validate([
            'name' => 'required|string|max:255',
            'logo_url' => 'required|url',
        ]);

        // Simpan data ke database menggunakan Eloquent
        Partner::create([
            'name' => $request->name,
            'logo_url' => $request->logo_url,
        ]);

        // Redirect kembali ke halaman daftar dengan pesan sukses
        return redirect()->route('admin.partners.index')->with('success', 'Partner baru berhasil ditambahkan!');
    }
    
    // Menampilkan halaman form tambah partner
    public function create()
    {
        return view('admin.partners.create');
    }

    // Menampilkan form edit
    public function edit(Partner $partner)
    {
        return view('admin.partners.edit', compact('partner'));
    }

    // Memproses update data
    public function update(Request $request, Partner $partner)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'logo_url' => 'required|url',
        ]);

        $partner->update([
            'name' => $request->name,
            'logo_url' => $request->logo_url,
        ]);

        return redirect()->route('admin.partners.index')->with('success', 'Data partner berhasil diperbarui!');
    }

    // Menghapus data
    public function destroy(Partner $partner)
    {
        $partner->delete();
        return redirect()->route('admin.partners.index')->with('success', 'Partner berhasil dihapus!');
    }
}