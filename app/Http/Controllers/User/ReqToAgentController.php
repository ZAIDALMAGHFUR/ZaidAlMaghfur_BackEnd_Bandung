<?php

namespace App\Http\Controllers\User;

use App\Models\ReqToAgent;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class ReqToAgentController extends Controller
{
    public function index()
    {
        $auth = Auth::user();
        return view('user.req.index', compact('auth'));
    }

    // users_id 	no_nik 	foto_ktp 	no_sim 	tgl_berakhir_sim 	foto_sim 	jenis_sim 	no_plat_kendaraan 	jenis_kendaraan 	foto_stnk
    // membuat create ke dalam databse dengan isi ini

    public function store(Request $request)
    {
        // dd($request->all());
        $request->validate([
            'no_nik' => 'required|numeric',
            'foto_ktp' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'no_sim' => 'required|numeric',
            'tgl_berakhir_sim' => 'required|date',
            'foto_sim' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'jenis_sim' => 'required|string',
            'no_plat_kendaraan' => 'required|string',
            'jenis_kendaraan' => 'required|string',
            'foto_stnk' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $data = $request->all();
        $data['users_id'] = Auth::user()->id;
        $data['status_berkas'] = 'belum diverifikasi';
        $data['foto_ktp'] = $request->file('foto_ktp')->store(
            'assets/user/req',
            'public'
        );
        $data['foto_sim'] = $request->file('foto_sim')->store(
            'assets/user/req',
            'public'
        );
        $data['foto_stnk'] = $request->file('foto_stnk')->store(
            'assets/user/req',
            'public'
        );

        $req = ReqToAgent::create($data);

        return redirect()->route('user/req')->with([
            'success' => 'Permintaan berhasil dikirim',
            'alert-type' => 'success',
        ]);
    }
}
