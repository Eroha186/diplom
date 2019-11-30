<?php

namespace App\Http\Controllers\Reward;

use App\Http\Requests\SubstratesForm;
use App\Substrate;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;

class GenerationDiplom extends Controller
{
    public function show() {
        return view('admin.create-diplom');
    }

    public function generate()
    {
        $path = asset(Storage::url('upload/diplom.jpg'));
        $img = Image::make($path);
        $text = 'Hello world';
        $img->text($text, 375, 475, function ($font) {
            $font->file(public_path('font/arial.ttf'));
            $font->size(80);
            $font->color('#000');
            $font->align('center');
            $font->valign('bottom');
        });
        $fileName = str_random(14).'.jpg';
        $img->save('images/diplom/'. $fileName);
    }

}
