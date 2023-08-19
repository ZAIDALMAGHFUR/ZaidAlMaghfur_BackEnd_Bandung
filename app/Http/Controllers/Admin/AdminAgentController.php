<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class AdminAgentController extends Controller
{
    public function index()
    {
        $users = User::where('roles_id', '=', 2)->get();
        return view('admin.agent.index', compact('users'));
    }
}
