<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ThemesAndPubl extends Model
{
    protected $table = 'themes_and_publ';

    protected $fillable = ['publ_id', 'theme_id'];

    public $timestamps = false;
}
