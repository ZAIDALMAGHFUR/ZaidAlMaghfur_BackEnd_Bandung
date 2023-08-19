<?php

namespace App\Http\Controllers\Agent;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Sewa;
use Illuminate\Support\Facades\Cache;

class DashboardController extends Controller
{

    public function __construct()
    {
        $this->middleware(['auth', 'verified']);
    }


    public function index(){
        $stats = Cache::remember('card-stats-' . auth()->id(), 60 * 1, fn () => $this->_getStats());
        return view('agent.dashboard', compact('stats'));
    }

    private  function _getStats(){
        return [

            [
                "label" => "Jumblah Mobil Di Sewa",
                "value" => Sewa::where('id_users', auth()->id())->where('status_pengembalian', 'belum dikembalikan')->count(),
                'icon' => 'clipboard'
            ],

        ];
    }
}
