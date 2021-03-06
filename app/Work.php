<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Work extends Model
{
    public $timestamps = false;
    protected $fillable = ['title', 'user_id', 'annotation', 'nomination_id', 'fc', 'ic', 'oc', 'age', 'competition_id', 'date_add', 'place'];

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
        return $this->belongsTo('App\Competition', 'competition_id');
    }

    public function diplom()
    {
        return $this->hasOne('App\Diplom', 'work_id');
    }

}
