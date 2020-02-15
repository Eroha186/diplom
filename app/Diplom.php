<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Diplom extends Model
{
    /*
        type - это публикация(1), конкурс(2) или экспресс конкурс(3)
    */
    protected $fillable = ['type', 'work_id'];

    public function work() {
        return $this->belongsTo('App\Work', 'work_id', 'id');
    }
}
