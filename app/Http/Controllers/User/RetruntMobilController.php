<?php

namespace App\Http\Controllers\User;

use App\Models\Mobil;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Sewa;

class RetruntMobilController extends Controller
{
    public function index()
    {
        return view('user.retrunt-mobil.index');
    }

    public function returnCar(Request $request) {
        $mobil = Mobil::find($request->plat_nomor);
        $tgl_sewa = Sewa::where('tanggal_sewa', $request->tanggal_sewa)->first();
        $cek = Mobil::where('plat_nomor', $request->plat_nomor)->first();

        if ($cek && $tgl_sewa) {
            $sewa = Sewa::where('tanggal_sewa', $request->tanggal_sewa)
                ->first();
            $mobil = Mobil::where('plat_nomor', $request->plat_nomor)
                ->first();
            if ($sewa) {
                $sewa->update([
                    'status_pengembalian' => 'sudah dikembalikan'
                ]);

                $mobil->update([
                    'status_mobil' => 'Tersedia'
                ]);
                return redirect()->back()->with('success', 'Mobil berhasil dikembalikan');
            } else {
                return redirect()->back()->with('error', 'Sewa tidak ditemukan');
            }
        } else {
            return redirect()->back()->with('error', 'Mobil atau tanggal sewa tidak ditemukan');
        }
    }

}
