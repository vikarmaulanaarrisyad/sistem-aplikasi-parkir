<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;

class Parkir extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'parkirs';

    public function petugas()
    {
        return $this->hasOne(Petugas::class, 'id', 'petugas_id');
    }

    public function statusColor()
    {
        $color = '';

        switch ($this->status) {
            case 'Masuk':
                $color = 'primary';
                break;
            case 'Keluar':
                $color = 'dark';
                break;

            default:
                # code...
                break;
        }

        return $color;
    }
}
