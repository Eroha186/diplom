<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Comtition_Nomination extends Model
{
    protected $table = 'competition_nomination';

    protected $fillable = ['competition_id', 'nomination_id'];

    public $timestamps = false;
}
