<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
  use Notifiable;

  /**
   * The attributes that are mass assignable.
   *
   * @var array
   */
  protected $fillable = [
      'f','i','o', 'password','email', 'stuff', 'town', 'job', 'confirm'
  ];

  /**
   * The attributes that should be hidden for arrays.
   *
   * @var array
   */
  protected $hidden = [
      'password', 'remember_token',
  ];

  public $timestamps = false;

  public function publications()
  {
    return $this->hasMany('App\Publication', 'user_id');
  }

  public function verifyUser()
  {
    return $this->hasOne('App\VerifyUser');
  }

}
