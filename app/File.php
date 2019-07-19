<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class File extends Model
{
    protected $fillable = ['publ_id', 'url', 'type'];

    public $timestamps = false;

    public function publication() {
        return $this->belongsTo('App\Publication', 'publ_id');
    }
}
