<?php

namespace App\Http\Controllers\User;

use Midtrans\Snap;
use App\Models\Sewa;
use Midtrans\Config;
use App\Models\Mobil;
use Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class UserSewaController extends Controller
{

    public function __construct()
    {
        // Set your Merchant Server Key
        \Midtrans\Config::$serverKey = env('MIDTRANS_SERVERKEY');
        // Set to Development/Sandbox Environment (default). Set to true for Production Environment (accept real transaction).
        \Midtrans\Config::$isProduction = false;
        // Set sanitization on (default)
        \Midtrans\Config::$isSanitized = false;
        // Set 3DS transaction for credit card to true
        \Midtrans\Config::$is3ds = false;
    }



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

        $snapToken = Sewa::where('id_users', $auth->id)->pluck('snap_token');


        return view('user.sewa-mobil.index', compact('sewa_mobil', 'masa_sewa', 'snapToken'));
    }

    public function pay(Request $request, $id)
    {
        $auth = auth()->user();
        $sewa = Sewa::where('id_users', $auth->id)->first();
        $mobil = Mobil::find($sewa->mobil_id);

        $snapToken = Sewa::where('id_users', $auth->id)->where('id', $id)->first();
        $get = $snapToken->snap_token;
        // dd($get);


        return view('user.sewa-mobil.pay', compact('sewa','mobil', 'auth', 'get'));
    }

    public function create()
    {
        $auth = auth()->user()->first_name . ' ' . auth()->user()->last_name;
        $mobil = Mobil::all();

        $user = auth()->user();

        $snapToken = Sewa::where('id_users', $user->id)->pluck('snap_token');

        return view('user.sewa-mobil.create', compact('mobil', 'auth', 'snapToken'));
    }

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

        $sewa = Sewa::create([
            'mobil_id' => $request->mobil_id,
            'id_users' => $auth,
            'tanggal_sewa' => $request->tanggal_sewa,
            'tanggal_kembali' => $request->tanggal_kembali,
            'total_harga' => $total_harga,
            'status_sewa' => 'pending',
            'status_pengembalian' => 'belum dikembalikan',
            'bukti_pembayaran' => $request->bukti_pembayaran,
        ]);

        // Ubah status mobil menjadi "Di Sewa"
        $mobil->update(['status_mobil' => 'Di Sewa']);

        $params = [
            'transaction_details' => [
                'order_id' => $sewa->id . '-' . Str::random(5),
                'gross_amount' => $total_harga,
            ],
        ];

        $snapToken = Snap::getSnapToken($params);

        $sewa->update(['snap_token' => $snapToken]);

        return redirect()->route('user/sewa')->with('success', 'Data berhasil ditambahkan');
    }


    public function updateStatus($mobileId, $sewaId, Request $request)
    {
        $mobile = Mobil::findOrFail($mobileId);
        $sewa = Sewa::findOrFail($sewaId);

        $mobile->status_mobil = $request->input('status_mobil');
        $mobile->save();

        $sewa->status_sewa = $request->input('status_sewa');
        $sewa->payment_status = $request->input('payment_status');
        $sewa->save();

        return response()->json([
            'message' => 'Status updated successfully'
        ]);
    }

    public function midtransCallback(Request $request)
    {
        $transaction = $request->transaction_status;
        $type = $request->payment_type;
        $order_id = $request->order_id;
        $fraud = $request->fraud_status;

        $sewa = Sewa::where('snap_token', $order_id)->first();
        $mobil = Mobil::find($sewa->mobil_id);

        if ($transaction == 'capture') {
            if ($type == 'credit_card') {
                if ($fraud == 'challenge') {
                    $sewa->update(['status_sewa' => 'pending']);
                } else {
                    $sewa->update(['payment_status' => 'paid']);
                    $sewa->update(['status_sewa' => 'paid']);
                    $mobil->update(['status_mobil' => 'Di Sewa']);
                }
            }
        } elseif ($transaction == 'settlement') {
            $sewa->update(['status_sewa' => 'paid']);
            $mobil->update(['status_mobil' => 'Di Sewa']);
        } elseif ($transaction == 'pending') {
            $sewa->update(['status_sewa' => 'pending']);
        } elseif ($transaction == 'deny') {
            $sewa->update(['status_sewa' => 'failed']);
            $mobil->update(['status_mobil' => 'Tersedia']);
        } elseif ($transaction == 'expire') {
            $sewa->update(['status_sewa' => 'failed']);
            $mobil->update(['status_mobil' => 'Tersedia']);
        } elseif ($transaction == 'cancel') {
            $sewa->update(['status_sewa' => 'failed']);
            $mobil->update(['status_mobil' => 'Tersedia']);
        }

        return response()->json('Ok');
    }
}
