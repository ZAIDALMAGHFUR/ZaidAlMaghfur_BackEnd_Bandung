<?php

namespace App\Http\Controllers\User;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Cache;

class DashboardController extends Controller
{

    public function __construct()
    {
        $this->middleware(['auth', 'verified']);
    }


    public function index(){
        $stats = Cache::remember('card-stats-' . auth()->id(), 60 * 1, fn () => $this->_getStats());
        return view('user.dashboard', compact('stats'));
    }

    private  function _getStats(){
        return [

            [
                "label" => "Users",
                "value" => User::count(),
                'icon' => 'users'
            ],

        ];
    }
}
