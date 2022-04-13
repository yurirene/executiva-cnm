<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Traits\Uuids;

class Delegado extends Model
{
    use HasFactory;
    use Uuids;

    protected $table = 'delegados';
    protected $guarded = ['id'];
    public $timestamps = false;
    public $incrementing = false;

    public const ELEGIBILIDADE = [
        1 => 'Sim',
        0 => 'Não'
    ];

    public const STATUS = [
        2 => 'Eleito',
        1 => 'Elegível',
        0 => 'Inelegível'
    ];

    public function getStatusAttribute(){
        return Delegado::STATUS[$this->elegibilidade];
    }

    public function regiao()
    {
        return $this->belongsTo(Regiao::class);
    }

}
