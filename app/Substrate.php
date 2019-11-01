<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Substrate extends Model
{
    public $timestamps = false;
    public $fillable = ['url', 'name'];
}