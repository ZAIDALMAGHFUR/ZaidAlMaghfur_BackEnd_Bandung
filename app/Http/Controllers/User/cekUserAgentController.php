<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\ReqToAgent;
use Illuminate\Http\Request;

class cekUserAgentController extends Controller
{
    public function index()
    {
        $cek = ReqToAgent::with('user')->where('users_id', auth()->user()->id)->first();
        // dd($cek);
        return view('user.req.cek', compact('cek'));
    }
}
