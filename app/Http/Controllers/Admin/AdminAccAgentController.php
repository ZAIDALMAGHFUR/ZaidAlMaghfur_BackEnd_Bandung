<?php

namespace App\Http\Controllers\Admin;

use App\Models\ReqToAgent;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class AdminAccAgentController extends Controller
{
    public function index(){
        $acc = ReqToAgent::all();
        return view('admin.acc.index', compact('acc'));
    }

    public function acc(Request $request, $id){
        $acc = ReqToAgent::find($id);
        $acc->status_berkas = 'sudah diverifikasi';
        $acc->save();
        $user = $acc->user;
        if ($user) {
            $user->roles_id = 2;
            $user->save();
        }

        return redirect()->route('admin/user/acc')->with('success', 'Berhasil di acc');
    }
}
