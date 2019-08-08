<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    protected $fillable = ['user_id', 'type', 'value', 'date'];

    public $timestamps = false;

    public function user() {
        return $this->belongsTo('App\User');
    }
}
