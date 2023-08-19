<?php

namespace App\Http\Controllers;

use App\Models\Mobil;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware(['auth', 'verified']);
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $stats = Cache::remember('card-stats-' . auth()->id(), 60 * 1, fn () => $this->_getStats());
        return view('dashboard.home', compact('stats'));
    }

    private  function _getStats()
    {
        return [

            [
                "label" => "Users",
                "value" => User::count(),
                'icon' => 'users'
            ],
            [
                'label' => 'Mobil',
                'value' => Mobil::count(),
                'icon' => 'clipboard'
            ],
            [
                'label' => 'Mobil Di Sewa',
                'value' => Mobil::where('status_mobil', 'Di Sewa')->count(),
                'icon' => 'grid'
            ],
            [
                'label' => 'Mobil Tersedia',
                'value' => Mobil::where('status_mobil', 'Tersedia')->count(),
                'icon' => 'tag'
            ],
        ];
    }
}
