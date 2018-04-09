<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;

class MuambaInfo extends Authenticatable
{
    protected $table = 'muambas_info';
    protected $fillable = ['data', 'local', 'status', 'encaminhado', 'muambas_id'];
    protected $guarded = ['id'];
    
    public function muambas()
    {
        return $this->belongsTo('App\Muamba', 'muambas_id');
    }
    
    public function getDataAttribute($value)
    {
        $data = new \DateTime($value);
        return $data->format("d/m/Y H:i");
    }
    
    public function setDataAttribute($value)
    {
        $data = new \DateTime($value);
        $this->attributes['data'] = $data->format("Y-m-d H:i:s");
    }
}
