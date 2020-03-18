<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class MlTemplate extends Model
{
    public function templateBlocks() {
        return $this->hasMany(MlTemplateBlock::class, 'template_id');
    }
}
