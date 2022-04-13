<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Presenca extends Model
{
    protected $table='presenca';
    protected $guarded = ['id', 'created_at', 'updated_at'];

}
