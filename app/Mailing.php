<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class Mailing extends Model
{
    protected $fillable = ['theme', 'template_id', 'number_mail', 'status', 'all_mail'];

    public function getCreatedAtAttribute($value)
    {
        return date('d.m.Y', strtotime($value));
    }

    public function getStatusAttribute($value) {
        switch ($value) {
            case(1):
                return "В работе";
                break;
            case(2):
                return "Завершена";
                break;
            case(3):
                return "Отменена";
                break;
        }
    }
}
