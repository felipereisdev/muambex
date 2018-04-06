<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;


class Muamba extends Authenticatable
{
    protected $table = 'muambas';
    protected $fillable = ['nome', 'codigo_rastreio', 'fl_recebido', 'user_id'];
    protected $guarded = ['id', 'created_at', 'update_at'];
    
    public function muamba_info()
    {
        return $this->hasMany('App\MuambaInfo', 'muambas_id');
    }
}
