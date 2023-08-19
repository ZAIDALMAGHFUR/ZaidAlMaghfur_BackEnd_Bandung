<?php

namespace App\Http\Controllers\Admin;

use App\Models\Mobil;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class AdminMobilController extends Controller
{
    public function index()
    {
        $mobiles = Mobil::all();

        foreach ($mobiles as $mobile) {
            $mobile->harga_sewa = number_format($mobile->harga_sewa, 0, ',', '.');
        }
        return view('admin.admin-mobil.index', compact('mobiles'));
    }

    public function create()
    {
        return view('admin.admin-mobil.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_mobil' => 'required',
            'merk_mobil' => 'required',
            'plat_nomor' => 'required',
            'harga_sewa' => 'required',
            'warna_mobil' => 'required',
            'tahun_keluaran' => 'required',
            'status_mobil' => 'required',
            'gambar_mobils' => 'image|mimes:jpeg,png,jpg,gif,svg',
        ]);

        $gambar_mobils = $request->file('gambar_mobils');
        $namaFile = time() . '.' . $gambar_mobils->getClientOriginalExtension();
        $gambar_mobils->move(public_path('img'), $namaFile);

        Mobil::create([
            'nama_mobil' => $request->nama_mobil,
            'merk_mobil' => $request->merk_mobil,
            'plat_nomor' => $request->plat_nomor,
            'harga_sewa' => $request->harga_sewa,
            'warna_mobil' => $request->warna_mobil,
            'tahun_keluaran' => $request->tahun_keluaran,
            'status_mobil' => $request->status_mobil,
            'gambar_mobils' => $namaFile,
        ]);

        return redirect()->route('admin/mobile')->with('success', 'Mobil berhasil ditambahkan');
    }

    public function show($id)
    {
        $mobile = Mobil::findOrFail($id);
        $mobile->harga_sewa = number_format($mobile->harga_sewa, 0, ',', '.');
        return view('admin.admin-mobil.show', compact('mobile'));
    }

    public function edit($id)
    {
        $mobile = Mobil::findOrFail($id);
        return view('admin.admin-mobil.edit', compact('mobile'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'nama_mobil' => 'required',
            'merk_mobil' => 'required',
            'plat_nomor' => 'required',
            'harga_sewa' => 'required',
            'warna_mobil' => 'required',
            'tahun_keluaran' => 'required',
            'status_mobil' => 'required',
            'gambar_mobils' => 'image|mimes:jpeg,png,jpg,gif,svg',
        ]);

        $mobile = Mobil::findOrFail($id);

        if ($request->file('gambar_mobils') == "") {

            $mobile->update([
                'nama_mobil' => $request->nama_mobil,
                'merk_mobil' => $request->merk_mobil,
                'plat_nomor' => $request->plat_nomor,
                'harga_sewa' => $request->harga_sewa,
                'warna_mobil' => $request->warna_mobil,
                'tahun_keluaran' => $request->tahun_keluaran,
                'status_mobil' => $request->status_mobil,
            ]);
        } else {

            $gambar_mobils = $request->file('gambar_mobils');
            $namaFile = time() . '.' . $gambar_mobils->getClientOriginalExtension();
            $gambar_mobils->move(public_path('img'), $namaFile);

            $mobile->update([
                'nama_mobil' => $request->nama_mobil,
                'merk_mobil' => $request->merk_mobil,
                'plat_nomor' => $request->plat_nomor,
                'harga_sewa' => $request->harga_sewa,
                'warna_mobil' => $request->warna_mobil,
                'tahun_keluaran' => $request->tahun_keluaran,
                'status_mobil' => $request->status_mobil,
                'gambar_mobils' => $namaFile,
            ]);
        }

        return redirect()->route('admin/mobile')->with('success', 'Mobil berhasil diupdate');
    }

    public function destroy($id)
    {
        $mobile = Mobil::findOrFail($id);
        $mobile->delete();
        return redirect()->route('admin/mobile')->with('success', 'Mobil berhasil dihapus');
    }
}
