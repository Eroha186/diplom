<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Work extends Model
{
    public $timestamps = false;
    protected $fillable = ['title', 'user_id', 'annotation'];

    public function user()
    {
        return $this->belongsTo('App\User', 'user_id');
    }

    public function file()
    {
        return $this->hasOne('App\File', 'work_id');
    }

    public function competition() {
        return $this->belongsTo('App\Competition', 'work_id');
    }
}
