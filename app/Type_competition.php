<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Type_competition extends Model
{
    protected $table = 'type_competition';

    public function competition() {
        return $this->hasMany('App\Competition', 'type_id');
    }
}