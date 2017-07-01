<?php

namespace App\Http\Models;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Cli_cliente extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'cli_id', 'cli_nombre', 'cli_ruc', 'cli_dv', 'cli_direccion', 'cli_tel', 'cli_tel2', 'cli_diavisita', 'cli_orden', 'cli_ultimavisita', 'cli_geo', 'per_id', 'sts_id', 'com_id', 'ven_id', 'tdv_id', 'rut_id', 'cpc_id'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
    ];
}
