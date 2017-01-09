<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ChaoDep extends Model
{
    protected $table = 'chaodep';
    protected $primaryKey='id';
    public $timestamps = false;

    public function users()
    {
        return $this->hasMany('App\User','depid','id');
    }

    public function chaoPros()
    {
        return $this->hasMany('App\ChaoPro','depid','id');
    }

}
