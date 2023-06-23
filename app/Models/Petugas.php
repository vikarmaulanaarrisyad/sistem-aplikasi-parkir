<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;

class Petugas extends Model
{
    use HasFactory;
    use SoftDeletes;
    protected $table = 'petugas';

    public function user()
    {
        return $this->hasOne(User::class, 'id', 'user_id');
    }
}
