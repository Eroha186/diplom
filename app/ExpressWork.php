<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ExpressWork extends Model
{
    public function user()
    {
        return $this->belongsTo('App\User', 'user_id');
    }

    public function file()
    {
        return $this->hasOne('App\File', 'work_id');
    }

    public function competition()
    {
        return $this->belongsTo('App\ExpressCompetition', 'competition_id');
    }
}
