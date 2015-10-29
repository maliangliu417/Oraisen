<?php

namespace App\Model;

use Illuminate\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Auth\Passwords\CanResetPassword;
use Illuminate\Foundation\Auth\Access\Authorizable;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Contracts\Auth\Access\Authorizable as AuthorizableContract;
use Illuminate\Contracts\Auth\CanResetPassword as CanResetPasswordContract;

class Users extends Model implements AuthenticatableContract,
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
    protected $fillable = ['usrName', 'email', 'usrPwd'];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = ['usrPwd', 'usrRememberToken'];

    protected $guarded = ['usrId'];

    public $timestamps = false;
    
    protected $primaryKey = 'usrId';

    public function getRememberTokenName()
    {
        return null; // not supported
    }
     
    /**
    * Overrides the method to ignore the remember token.
    */
    public function setAttribute($key, $value)
    {
         $isRememberTokenAttribute = $key == $this->getRememberTokenName();

         if (!$isRememberTokenAttribute)
         {
            parent::setAttribute($key, $value);
         }
    }
}
