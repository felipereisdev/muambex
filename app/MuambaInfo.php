<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;

class MuambaInfo extends Authenticatable
{
    protected $table = 'muambas_info';
    protected $fillable = ['dh_evento', 'ds_local', 'ds_status', 'ds_encaminhado', 'muambas_id'];
    protected $guarded = ['id'];
}
