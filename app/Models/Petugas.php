<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;

class Petugas extends Model
{
    use HasFactory;
    protected $table = 'petugas';

    public function user()
    {
        return $this->hasOne(User::class, 'id', 'user_id');
    }
}
