<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class File extends Model
{
    protected $fillable = ['publ_id', 'work_id', 'url', 'type'];

    public $timestamps = false;

    public function publication() {
        return $this->belongsTo('App\Publication', 'publ_id');
    }

    public function work() {
        return $this->belongsTo('App\Work', 'work_id');
    }
}
