<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class JrsxRemark extends Model
{
    protected $table = 'jrsxremark';
    protected $primaryKey='id';
    protected $dates = ['rtime'];
    public $timestamps = false;

    public function jrsx(){
        return $this->belongsTo('App\Jrsx','jrsxid','id');
    }

    public function user(){
        return $this->belongsTo('App\User','userid','id');
    }
}
