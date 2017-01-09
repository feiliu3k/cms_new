<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class InputTable extends Model
{
    protected $table = 'inputtable';
    protected $primaryKey='id';
    public $timestamps = false;
    protected $fillable = [
        'inputname','nullflag'
    ];
    protected $casts = [
        'nullflag' => 'boolean',
    ];

    public function chaosky()
    {
        return $this->belongsTo('App\ChaoSky','tipid','tipid');
    }
}
