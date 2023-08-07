<?php

namespace App\Models;

use App\Models\User;
use App\Models\Mobil;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Sewa extends Model
{
    use HasFactory;

    protected  $table = 'sewa_mobil';

    protected $guarded = ['id'];

    public function user()
    {
        return $this->belongsTo(User::class, 'id_users', 'id');
    }

    public function mobil()
    {
        return $this->belongsTo(Mobil::class, 'mobil_id', 'id');
    }


}
