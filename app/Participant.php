<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Participant extends Model
{
    public $timestamps = false;

    public function competition() {
        return $this->belongsTo('App\Competition', 'competition_id');
    }

    public function work() {
        return $this->hasOne('App\Work', 'work_id');
    }
}
