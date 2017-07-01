<?php

namespace App\Http\Models;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Ffp_factura_pago extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'com_id', 'ffp_id', 'fdp_id', 'rec_id', 'ven_id', 'ban_id', 'ffp_documento', 'ffp_fecha_expira', 'ffp_codigo_autoriza', 'ffp_monto'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
    ];
}
