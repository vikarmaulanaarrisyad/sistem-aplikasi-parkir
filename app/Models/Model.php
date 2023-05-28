<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model as ELoquent;

class Model extends ELoquent
{
    use HasFactory;
    protected $guarded = ['id'];
}
