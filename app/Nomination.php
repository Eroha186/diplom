<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Nomination extends Model
{
    protected $fillable = ['name'];
    public $timestamps = false;

    public function competition()
    {
        return $this->belongsToMany('App\Competition', 'competition_nomination', 'nomination_id', 'competition_id');
    }
}
