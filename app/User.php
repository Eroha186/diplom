<?php

namespace App;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'f', 'i', 'o', 'password', 'email', 'stuff', 'town', 'job', 'confirm', 'hash'
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

    public function transactions()
    {
        return $this->hasMany('App\Transaction');
    }

    public function work()
    {
        return $this->hasMany('App\Work');
    }

    public function expressWork()
    {
        return $this->hasMany('App\ExpressWork');
    }

    public function history_unsubscribe()
    {
        return $this->hasMany('App\HistoryUnsubscribe');
    }
}
