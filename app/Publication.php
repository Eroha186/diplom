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
    return $this->belongsTo('App\User', 'id');
  }

  public function type()
  {
    return $this->belongsTo('App\Type', 'id');
  }

  public function kind()
  {
    return $this->belongsTo('App\Kind', 'id');
  }

  public function education() {
    return $this->belongsTo('App\Education', 'id');
  }


}
