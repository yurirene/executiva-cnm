<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Regiao extends Model
{
    protected $table = 'regioes';
    protected $guarded = ['id'];
    public $timestamps = false;
}
