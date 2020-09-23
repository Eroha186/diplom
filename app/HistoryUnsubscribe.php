<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class HistoryUnsubscribe extends Model
{
    protected $table = 'history_unsubscribe';

    protected $fillable = ['user_id', 'date_add', 'event'];

    public $timestamps = false;

    public function user()
    {
        return $this->belongsTo('App\User');
    }
}
