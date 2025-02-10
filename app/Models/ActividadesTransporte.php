<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ActividadesTransporte extends Model
{
    use HasFactory;

    protected $table = 'actividades_transporte';

    protected $fillable = [
        'id_act_tra',
        'nom_con',
        'num_ide',
        'no_act_tra',
        'fec_pub',
    ];
}
