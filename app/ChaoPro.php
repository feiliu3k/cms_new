<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * App\ChaoPro
 *
 * @property integer $id
 * @property integer $proid
 * @property string $proname
 * @property string $proimg
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\ChaoSky[] $chaoSkies
 * @method static \Illuminate\Database\Query\Builder|\App\ChaoPro whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\ChaoPro whereProid($value)
 * @method static \Illuminate\Database\Query\Builder|\App\ChaoPro whereProname($value)
 * @method static \Illuminate\Database\Query\Builder|\App\ChaoPro whereProimg($value)
 * @method static \Illuminate\Database\Query\Builder|\App\ChaoPro whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\ChaoPro whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class ChaoPro extends Model
{
    //
    protected $table = 'chaopro';

    public function chaoSkies()
    {
        return $this->hasMany('App\ChaoSky','proid','id');
    }

    public function chaoDep()
    {
        return $this->belongsTo('App\ChaoDep','depid','id');
    }

    public function users()
    {
        return $this->belongsToMany('App\User','pro_user','pro_id','user_id');
    }
}
