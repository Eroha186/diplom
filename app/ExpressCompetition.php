<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ExpressCompetition extends Model

{
    protected $table = 'express_competitions';

    public function type()
    {
        return $this->hasOne('App\Type_competition', 'type_id');
    }
}
