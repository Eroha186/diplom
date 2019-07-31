<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Publication extends Model
{
    protected $table = 'publications';

    public $timestamps = false;

    protected $fillable = ['user_id', 'title', 'annotation', 'type_id', 'kind_id', 'education_id', 'text', 'moderation',
        'date_add'];

    public function author()
    {
        return $this->belongsTo('App\User', 'user_id');
    }

    public function type()
    {
        return $this->belongsTo('App\Type', 'type_id');
    }

    public function kind()
    {
        return $this->belongsTo('App\Kind', 'kind_id');
    }

    public function education()
    {
        return $this->belongsTo('App\Education', 'education_id');
    }

    public function files()
    {
        return $this->hasMany('App\File', 'publ_id');
    }

    public function theme()
    {
        return $this->belongsToMany('App\Theme', 'themes_and_publ', 'publ_id', 'theme_id');
    }

}
