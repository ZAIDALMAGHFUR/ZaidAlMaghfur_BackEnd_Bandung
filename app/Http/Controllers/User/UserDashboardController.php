<?php

namespace App\Http\Controllers\User;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\ReqToAgent;
use App\Models\Sewa;
use Illuminate\Support\Facades\Cache;

class UserDashboardController extends Controller
{

    public function __construct()
    {
        $this->middleware(['auth', 'verified']);
    }


    public function index()
    {
        $stats = Cache::remember('card-stats-' . auth()->id(), 60 * 1, fn () => $this->_getStats());
        return view('user.dashboard', compact('stats'));
    }

    private  function _getStats()
    {

        $cek = $this->_getStatus();
        return [
            [
                "label" => "Jumblah Mobil Di Sewa",
                "value" => Sewa::where('id_users', auth()->id())->where('status_pengembalian', 'belum dikembalikan')->count(),
                'icon' => 'clipboard'
            ],
            [
                "label" => "Status Pengajuan Agent",
                "value" => $cek,
                'icon' => 'clipboard'
            ],
        ];
    }

    private function _getStatus()
    {
        $auth = auth()->id();
        $status = ReqToAgent::where('users_id', $auth)->first();

        if ($status) {
            $cek = $status->status_berkas;
        } else {
            $cek = "Belum request";
        }

        return $cek;
    }
}
