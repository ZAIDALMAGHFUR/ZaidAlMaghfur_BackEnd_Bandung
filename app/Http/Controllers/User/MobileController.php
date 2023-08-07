<?php

namespace App\Http\Controllers\User;

use App\Models\Sewa;
use App\Models\Mobil;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class MobileController extends Controller
{
    public function index()
    {
        $mobiles = Mobil::all();

        foreach ($mobiles as $mobile) {
            $mobile->harga_sewa = number_format($mobile->harga_sewa, 0, ',', '.');
        }
        return view('user.mobile.index', compact('mobiles'));
    }

    // public function show($id)     optional
    // {
    //     $mobile = Mobil::findOrFail($id);
    //     $mobile->harga_sewa = number_format($mobile->harga_sewa, 0, ',', '.');
    //     return view('user.mobile.show', compact('mobile'));
    // }

    public function create()
    {
        return view('user.mobile.create');
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

        return redirect()->route('mobile')->with('success', 'Data berhasil ditambahkan');
    }

    public function edit($id)
    {
        $mobile = Mobil::findOrFail($id);
        return view('user.mobile.edit', compact('mobile'));
    }


    public function update(Request $request , $id){
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

        $mobile = Mobil::findOrFail($id);
        $mobile->nama_mobil = $request->nama_mobil;
        $mobile->merk_mobil = $request->merk_mobil;
        $mobile->plat_nomor = $request->plat_nomor;
        $mobile->harga_sewa = $request->harga_sewa;
        $mobile->warna_mobil = $request->warna_mobil;
        $mobile->tahun_keluaran = $request->tahun_keluaran;
        $mobile->status_mobil = $request->status_mobil;
        $mobile->gambar_mobils = $namaFile;
        $mobile->save();

        return redirect()->route('mobile')->with('success', 'Data berhasil diupdate');
    }

    public function destroy($id)
    {
        $mobile = Mobil::findOrFail($id);

        if ($mobile->status_mobil == 'Di Sewa') {
            return redirect()->route('mobile')->with('error', 'Mobil tidak bisa dihapus karena sedang disewakan.');
        }

        $mobile->delete();

        return redirect()->route('mobile')->with('success', 'Data berhasil dihapus');
    }

}
