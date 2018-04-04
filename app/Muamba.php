<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Muamba extends Model
{
    protected $table = 'muambas';
    protected $fillable = ['nome', 'codigo_rastreio', 'fl_recebido', 'user_id'];
    protected $guarded = ['id', 'created_at', 'update_at'];
}
