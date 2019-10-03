<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Competition extends Model
{
    public $timestamps = false;
    protected $fillable = ['title', 'annotation', 'cover', 'type_id', 'date_begin', 'date_end'];

    public function nomination()
    {
        return $this->belongsToMany('App\Nomination', 'competition_nomination','competition_id', 'nomination_id');
    }

    public function work() {
        return $this->hasMany('App\Work', 'competition_id');
    }

    public function type() {
        return $this->belongsTo('App\Type_competition', 'type_id');
    }

}
