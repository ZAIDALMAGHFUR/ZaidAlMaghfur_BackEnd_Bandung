<?php

namespace App\Models;

use App\Models\Sewa;
use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Mobil extends Model
{
    use HasFactory;

    protected  $table = 'mobil';

    protected $guarded = ['id'];

    public function user()
    {
        return $this->belongsTo(User::class, 'users_id', 'id');
    }

    public function sewa()
    {
        return $this->hasMany(Sewa::class, 'mobil_id', 'id');
    }


}
