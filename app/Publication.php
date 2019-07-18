<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Publication extends Model
{
  protected $table = 'publications';

  public $timestamps = false;

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

  public function education() {
    return $this->belongsTo('App\Education', 'education_id');
  }


}
