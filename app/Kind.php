<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Kind extends Model
{
  protected $table = 'kinds';

  public function publications()
  {
    return $this->hasMany('App\Publication', 'kind_id');
  }
}
