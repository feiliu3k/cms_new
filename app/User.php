<?php

namespace App;

use Illuminate\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Auth\Passwords\CanResetPassword;
use Illuminate\Foundation\Auth\Access\Authorizable;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Contracts\Auth\Access\Authorizable as AuthorizableContract;
use Illuminate\Contracts\Auth\CanResetPassword as CanResetPasswordContract;

/**
 * App\User
 *
 * @property integer $id
 * @property string $name
 * @property string $email
 * @property string $password
 * @property string $remember_token
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\ChaoSky[] $creatChaoSkies
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\ChaoSky[] $postChaoSkies
 * @method static \Illuminate\Database\Query\Builder|\App\User whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\User whereName($value)
 * @method static \Illuminate\Database\Query\Builder|\App\User whereEmail($value)
 * @method static \Illuminate\Database\Query\Builder|\App\User wherePassword($value)
 * @method static \Illuminate\Database\Query\Builder|\App\User whereRememberToken($value)
 * @method static \Illuminate\Database\Query\Builder|\App\User whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\User whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class User extends Model implements AuthenticatableContract,
                                    AuthorizableContract,
                                    CanResetPasswordContract
{
    use Authenticatable, Authorizable, CanResetPassword;

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'users';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['name', 'email', 'password'];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = ['password', 'remember_token'];

    public function creatChaoSkies()
    {
        return $this->hasMany('App\ChaoSky','userid','id');
    }

    public function postChaoSkies()
    {
        return $this->hasMany('App\ChaoSky','post_user','id');
    }

    public function roles()
    {
        return $this->belongsToMany(Role::class);
    }
    // 判断用户是否具有某个角色
    public function hasRole($role)
    {
        if (is_string($role)) {
            return $this->roles->contains('name', $role);
        }

        return !! $role->intersect($this->roles)->count();
    }
    // 判断用户是否具有某权限
    public function hasPermission($permission)
    {
        return $this->hasRole($permission->roles);
    }
    // 给用户分配角色
    public function assignRole($role)
    {
        return $this->roles()->save(
            Role::whereName($role)->firstOrFail()
        );
    }

    public function jrsxes()
    {
       return $this->belongsToMany('App\Jrsx','jrsxfav','userid','jrsxid');
    }

    public function jrsxRemarks()
    {
        return $this->hasMany('App\JrsxRemark','userid','id');
    }

    public function jrsxesRemarks()
    {
       return $this->belongsToMany('App\Jrsx','jrsxremark','userid','jrsxid')->where('delflag',0)->orderBy('postdate', 'desc');
    }

    public function chaoDep()
    {
       return $this->belongsTo('App\ChaoDep','dept_id','id');
    }

    public function chaoPros()
    {
       return $this->belongsToMany('App\ChaoPro','pro_user','user_id','pro_id');
    }

    // 给用户分配栏目
    public function assignPro($pro)
    {
        return $this->chaoPros()->save(
            chaoPro::whereProname($pro)->firstOrFail()
        );
    }

    // 给用户分配栏目
    public function fav($jrsxid)
    {
        return $this->jrsxes()->save(
            Jrsx::find($jrsxid)
        );
    }

}
