<?php

namespace App\Http\Controllers\Admin;

use App\Models\Sewa;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class AdminUserSewaController extends Controller
{
    public function index()
    {
        $sewa = Sewa::with('user', 'mobil')->get();

        $tanggal_sewa = Sewa::pluck('tanggal_sewa');
        $tanggal_kembali = Sewa::pluck('tanggal_kembali');

        $masa_sewa = [];
        foreach ($tanggal_sewa as $key => $value) {
            $masa_sewa[$key] = (strtotime($tanggal_kembali[$key]) - strtotime($value)) / 86400;
        }
        return view('admin.sewamobil.sewa.index', compact('sewa', 'masa_sewa'));
    }
}
