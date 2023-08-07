<?php

namespace App\Http\Controllers\User;

use App\Models\Sewa;
use App\Models\Mobil;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class SewaMobilController extends Controller
{
    public function index()
    {
        $auth = auth()->user();
        $sewa_mobil = Sewa::where('id_users', $auth->id)->get();
        foreach ($sewa_mobil as $sewa) {
            $sewa->total_harga = number_format($sewa->total_harga, 0, ',', '.');
        }

        $tanggal_sewa = Sewa::where('id_users', $auth->id)->pluck('tanggal_sewa');
        $tanggal_kembali = Sewa::where('id_users', $auth->id)->pluck('tanggal_kembali');

        $masa_sewa = [];
        foreach ($tanggal_sewa as $key => $value) {
            $masa_sewa[$key] = (strtotime($tanggal_kembali[$key]) - strtotime($value)) / 86400;
        }

        // dd($masa_sewa);


        return view('user.sewa-mobil.index', compact('sewa_mobil', 'masa_sewa'));
    }

    public function create()
    {
        $auth = auth()->user()->first_name . ' ' . auth()->user()->last_name;
        $mobil = Mobil::all();
        return view('user.sewa-mobil.create', compact('mobil', 'auth'));
    }

    // public function getHarga(Request $request)
    // {
    //     $mobil = Mobil::find($request->mobil_id);
    //     $harga = $mobil->harga_sewa;
    //     $durasi = $request->tanggal_sewa - $request->tanggal_kembali;

    //     $total_harga = $harga * $durasi;

    //     return response()->json($total_harga);

    // }

    public function store(Request $request)
    {
        $auth = auth()->user()->id;

        $request->validate([
            'mobil_id' => 'required',
            'tanggal_sewa' => 'required',
            'tanggal_kembali' => 'required',
        ]);

        $mobil = Mobil::find($request->mobil_id);

        if (!$mobil) {
            return redirect()->back()->with('error', 'Mobil tidak ditemukan');
        }

        if ($mobil->status_mobil === 'Di Sewa') {
            return redirect()->back()->with('error', 'Maaf, mobil sedang disewakan');
        }

        $harga = $mobil->harga_sewa;
        $awal = $request->tanggal_sewa;
        $akhir = $request->tanggal_kembali;
        $durasi = (strtotime($akhir) - strtotime($awal)) / 86400;
        $total_harga = $harga * $durasi;

        Sewa::create([
            'mobil_id' => $request->mobil_id,
            'id_users' => $auth,
            'tanggal_sewa' => $request->tanggal_sewa,
            'tanggal_kembali' => $request->tanggal_kembali,
            'total_harga' => $total_harga,
            'status_sewa' => 'paid',
            'status_pengembalian' => 'belum dikembalikan',
            'bukti_pembayaran' => $request->bukti_pembayaran,
        ]);

        // Ubah status mobil menjadi "Di Sewa"
        $mobil->update(['status_mobil' => 'Di Sewa']);

        return redirect()->route('sewa')->with('success', 'Data berhasil ditambahkan');
    }

}
