<?php

namespace App;

use Illuminate\Database\Eloquent\Model;


class Theme extends Model
{
    protected $table = 'themes';

    protected $fillable = ['name'];

    public $timestamps = false;

    public function publication()
    {
        return $this->belongsToMany('App\Publication', 'themes_and_publ', 'theme_id', 'publ_id');
    }
}
