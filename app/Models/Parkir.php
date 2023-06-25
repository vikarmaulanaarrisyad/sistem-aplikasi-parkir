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

    //mendapatkan status parkir masuk
    public function scopeParkirMasuk()
    {
        $currentDateTime = $this->tglSekarang();
        
        return $this->where('status', 'Masuk')
            ->where('updated_at', '>=', date('Y-m-d 05:00:00'))
            ->where('updated_at', '<=', $currentDateTime)
            ->count();
    }

    //mendapatkan status parkir keluar
    public function scopeParkirKeluar()
    {
        $currentDateTime = $this->tglSekarang();

        return $this->where('status', 'Keluar')
            ->where('updated_at', '>=', date('Y-m-d 05:00:00'))
            ->where('updated_at', '<=', $currentDateTime)
            ->count();
    }

    function tglSekarang()  {
        return date('Y-m-d H:i:s');
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
