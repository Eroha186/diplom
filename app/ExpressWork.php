<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ExpressWork extends Model
{
    protected $fillable = [
        'user_id',
        'competition_id',
        'title',
        'annotation',
        'fc',
        'ic',
        'oc',
        'nomination_id',
        'date_add',
        'age',
        'place'
    ];

    public $timestamps = false;

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
