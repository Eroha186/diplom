<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Competition extends Model
{
    public $timestamps = false;
    protected $fillable = ['name', 'annotation', 'cover'];

    public function nomination()
    {
        return $this->belongsToMany('App\Nomination', 'competition_nomination','competition_id', 'nomination_id');
    }

    public function participant() {
        return $this->hasMany('App\Participant', 'competition_id');
    }
}
