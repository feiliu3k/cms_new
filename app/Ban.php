<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Ban extends Model
{
    protected $table = 'banrecord';
    protected $primaryKey='banid';
    public $timestamps = false;

    protected $dates=['bantime'];

}
