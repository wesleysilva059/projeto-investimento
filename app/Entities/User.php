<?php

namespace App\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;

class User extends Authenticatable
{
    use SoftDeletes;
    use Notifiable;


    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    
    /* config timestamps for use
    public $timestamps = false;
    */

    protected $fillable = [
        'cpf', 'name', 'phone', 'birth', 'gender', 'notes', 'email', 'password', 'status', 'permission'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function groups()
    {
        return $this->belongsTo(Group::class, 'user_groups');
    }
    
    public function getPasswordAtrribute($value)
    {
        $this->attributes['password'] = env('PASSWORD_HASH') ? bcrypt('$value') : '$value';
    }

    public function getFormatedCpfAttribute()
    {
        $cpf = $this->attributes['cpf'];

        return substr($cpf, 0, 3) . '.' . substr($cpf, 3,3). '.' . substr($cpf, 6,3). '-' . substr($cpf, 9,2);
    }

    public function getFormatedPhoneAttribute()
    {
        $phone = $this->attributes['phone'];

        if(strlen($phone) == 10)
            return "(" . substr($phone, 0, 2) . ') ' . substr($phone, 2,4). '-' . substr($phone, 6,4);
        else
            return "(" . substr($phone, 0, 2) . ') ' . substr($phone, 2,5). '-' . substr($phone, 7,4);

    }

    public function getFormatedBirthAttribute()
    {
        $birth = explode('-', $this->attributes['birth']);

        if(count($birth) != 3)
            return "";

        $birth = $birth[2]. '/' . $birth[1] . '/' . $birth[0];
        return $birth;
    }
}