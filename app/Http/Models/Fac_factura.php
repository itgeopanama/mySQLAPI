<?php

namespace App\Http\Models;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Fac_factura extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'com_id', 'fac_id', 'bod_id', 'fac_fecha', 'cli_id', 'ven_id', 'fac_clinombre', 'fac_subtotal', 'fac_impuesto', 'fac_geo', 'sts_id', 'tdv_id', 'tpt_id'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
    ];
}
