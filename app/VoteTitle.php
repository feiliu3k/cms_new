<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class VoteTitle extends Model
{
    protected $table = 'votetitle';
    protected $primaryKey='vtid';
    public $timestamps = false;
    protected $fillable = [
        'votetitle','aflag','votenum'
    ];
    protected $casts = [
        'aflag' => 'boolean',

    ];

    public function chaosky()
    {
        return $this->belongsTo('App\ChaoSky','tipid','tipid');
    }

    public function voteItems()
    {
        return $this->hasMany('App\VoteItem','vtid','vtid');
    }
}
