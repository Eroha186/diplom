<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Type_competition extends Model
{
    protected $table = 'type_competition';

    public $timestamps = false;

    protected $fillable = ['name'];

    public function competition() {
        return $this->hasMany('App\Competition', 'type_id');
    }

    public function expressCompetition() {
        return $this->hasMany('App\ExpressCompetition', 'type_id');
    }
}
