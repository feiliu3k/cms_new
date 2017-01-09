<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * App\ChaoComment
 *
 * @property integer $cid
 * @property integer $tipid
 * @property string $comment
 * @property string $localrecord
 * @property string $userip
 * @property string $ctime
 * @property integer $delflag
 * @property integer $verifyflag
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @property-read \App\ChaoSky $chaoSky
 * @method static \Illuminate\Database\Query\Builder|\App\ChaoComment whereCid($value)
 * @method static \Illuminate\Database\Query\Builder|\App\ChaoComment whereTipid($value)
 * @method static \Illuminate\Database\Query\Builder|\App\ChaoComment whereComment($value)
 * @method static \Illuminate\Database\Query\Builder|\App\ChaoComment whereLocalrecord($value)
 * @method static \Illuminate\Database\Query\Builder|\App\ChaoComment whereUserip($value)
 * @method static \Illuminate\Database\Query\Builder|\App\ChaoComment whereCtime($value)
 * @method static \Illuminate\Database\Query\Builder|\App\ChaoComment whereDelflag($value)
 * @method static \Illuminate\Database\Query\Builder|\App\ChaoComment whereVerifyflag($value)
 * @method static \Illuminate\Database\Query\Builder|\App\ChaoComment whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\ChaoComment whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class ChaoComment extends Model
{
    protected $table = 'chaocomment';
    protected $primaryKey='cid';
    protected $dates = ['ctime'];

    public function chaoSky()
    {
        return $this->belongsTo('App\ChaoSky','tipid','tipid');
    }
}
