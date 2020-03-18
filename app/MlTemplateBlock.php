<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class MlTemplateBlock extends Model
{
    public function template() {
        return $this->belongsTo(MlTemplate::class, 'template_id');
    }
}
