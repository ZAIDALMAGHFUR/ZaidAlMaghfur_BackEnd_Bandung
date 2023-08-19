<?php

namespace App\Http\Controllers\User;

use App\Models\Mobil;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Sewa;

class UserRetruntController extends Controller
{
    public function index()
    {
        return view('user.retrunt-mobil.index');
    }

    public function returnCar(Request $request)
    {
        $platNomor = $request->plat_nomor;
        $tanggalSewa = $request->tanggal_sewa;

        // Temukan mobil_id berdasarkan plat_nomor
        $mobil = Mobil::where('plat_nomor', $platNomor)->first();

        if ($mobil) {
            $mobilId = $mobil->id;

            // Cari data Sewa berdasarkan mobil_id dan tanggal_sewa
            $sewa = Sewa::where('mobil_id', $mobilId)
                ->where('tanggal_sewa', $tanggalSewa)
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
            return redirect()->back()->with('error', 'Mobil tidak ditemukan');
        }
    }
}
