<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Tymon\JWTAuth\Contracts\JWTSubject;

/**
 * Class User
 * @package App\Models
 * @mixin Builder
 */
class User extends Authenticatable implements JWTSubject
{
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];


    public static $registerRules=[
      'name'=>['required','unique:users'],
      'email'=>['required','unique:users','email'],
      'password'=>['required','confirmed'],
    ];

    public static $loginRules=[
        'email'=>['required','email'],
        'password'=>['required'],
    ];


    public static $errorMsg=[
      'name.required'=>'THIS NAME MUST NOT BE EMPTY',
      'name.unique'=>'THIS NAME IS USED',
      'email.required'=>'THIS MAIL MUST NOT BE EMPTY',
      'email.unique'=>'THIS MAIL IS USED',
      'password.required'=>'THIS PASSWORD MUST NOT BE EMPTY',
      'password.confirmed'=>'PASSWORD MUST BE SAME',
    ];

    public function getJWTIdentifier()
    {
        return $this->getKey();
    }

    public function getJWTCustomClaims()
    {
        return [];
    }
}
