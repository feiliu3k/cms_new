<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class VoteItem extends Model
{
    protected $table = 'voteitem';
    protected $primaryKey='id';
    public $timestamps = false;
    protected $fillable = [
        'itemcontent'
    ];
    protected $casts = [
        'rflag' => 'boolean',

    ];
    public function chaosky()
    {
        return $this->belongsTo('App\ChaoSky','tipid','tipid');
    }

    public function voteTitle()
    {
        return $this->belongsTo('App\voteTitle','vtid','vtid');
    }


}
