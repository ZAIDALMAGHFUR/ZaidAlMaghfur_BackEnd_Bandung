<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class AdminUserController extends Controller
{
    public function index()
    {
        $users = User::where('roles_id', '=', 3)->get();
        return view('admin.user.index', compact('users'));
    }
}
