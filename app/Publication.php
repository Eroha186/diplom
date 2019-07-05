<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Publication extends Model
{
  protected $table = 'publications';

  public $timestamps = false;


  /**
   * @param $field
   */
  public function getPublications($field)
  {
    $publications = Publication::select($field)
        ->leftJoin('users', 'publications.user_id', '=', 'users.id')
        ->leftJoin('types', 'publications.type_id', '=', 'types.id')
        ->leftJoin('educations', 'publications.education_id', '=', 'educations.id')
        ->leftJoin('kinds', 'publications.kind_id', '=', 'kinds.id')
        ->latest('date_add')
        ->get();
    return $publications;
  }


}
