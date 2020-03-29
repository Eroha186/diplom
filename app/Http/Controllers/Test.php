<?php

namespace App\Http\Controllers;

use App\Diplom;
use App\Education;
use App\Mail\ExpressCompetitionDiplom;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;

class Test extends Controller
{
    public function test()
    {
        // твоя коллекция
        $collect = collect([
            ['amount' => '1000', 'user' => 'alex'],
            ['amount' => '2000', 'user' => 'alex2'],
            ['amount' => '3000', 'user' => 'alex3'],
        ]);

        // массив в котором прописаны условия для where
        $condition = [
            [
                'key' => 'amount',
                'operator' => '=',
                'value' => '1000'
            ]
        ];

        // делаем отбор из нашей коллекции
        foreach ($condition as $item) {
            $collect = $collect->where($item['key'], $item['operator'], $item['value']);
        }
    }

}
