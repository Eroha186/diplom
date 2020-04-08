<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use JustBetter\PaginationWithHavings\PaginationWithHavings;

class Publication extends Model
{

    use PaginationWithHavings;

    protected $table = 'publications';

    public $timestamps = false;

    protected $fillable = ['user_id', 'title', 'annotation', 'type_id', 'kind_id', 'education_id', 'text', 'moderation',
        'date_add'];

    public function user()
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

    public function themes()
    {
        return $this->belongsToMany('App\Theme', 'themes_and_publ', 'publ_id', 'theme_id');
    }

    public function diplom()
    {
        return $this->belongsTo('App\Diplom','work_id');
    }

}
