<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Jrsx extends Model
{
    protected $table = 'jrsx';
    protected $primaryKey='id';
    protected $dates = ['postdate'];
    public $timestamps = false;

    protected $guarded = [];

    public function favUsers()
    {
        return $this->hasMany('App\User','jrsxfav','jrsxid','userid');
    }

    public function remarks()
    {
        return $this->hasMany('App\JrsxRemark','jrsxid','id');
    }

    public function getPicAttribute($value)
    {
        $imgs=[];
        if (strlen(trim($value))>0){
            $imgs=explode(',',substr(trim($value),0,-1));            
        }
        // 判断是否是绝对路径，相对路径补全为绝对路径
        $pattern = 'http';
        foreach ($imgs as $key => $img) {  
            if(strpos($img, $pattern) === 0) {
                continue;
            } else {
                $imgs[$key] = config('cms.jrsx.imagePath').$img;
            }     
        }
        return $imgs;
    }

    public function chaoPro()
    {
        return $this->belongsTo('App\ChaoPro','proid','id');
    }

}
