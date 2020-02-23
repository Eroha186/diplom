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

    public function expressWork() {
        return $this->belongsTo('App\ExpressWork', 'work_id', 'id');
    }

    public function publication() {
        return $this->belongsTo('App\Publication', 'work_id', 'id');
    }
}
