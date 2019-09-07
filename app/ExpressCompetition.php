<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ExpressCompetition extends Model

{
    protected $table = 'express_competitions';

    public function type()
    {
        return $this->belongsTo('App\Type_competition', 'type_id');
    }

    public function nomination()
    {
        return $this->belongsToMany('App\Nomination', 'competition_nomination', 'express_competition_id', 'nomination_id');
    }

    public function work()
    {
        return $this->hasMany('App\ExpressWork', 'competition_id');
    }
}
