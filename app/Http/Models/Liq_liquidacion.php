<?php

namespace App\Http\Models;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Liq_liquidacion extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'com_id', 'liq_id', 'ven_id', 'liq_fecha', 'liq_horainicial', 'liq_horafinal', 'liq_kminicial', 'liq_kmfinal', 'liq_totalventa', 'liq_totalventacr', 'liq_totalventacon', 'liq_totalcobro', 'liq_totalpreventa', 'liq_totalgasto', 'rut_id'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
    ];
}
