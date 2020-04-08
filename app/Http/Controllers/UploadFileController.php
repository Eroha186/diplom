<?php

namespace App\Http\Controllers;

use App\File;
use Illuminate\Http\Request;

class UploadFileController extends Controller
{
    static function uploadFile($file, $work_id, $typeFile)
    {
        $type = $file->getMimeType();
        switch ($type) {
            case ('application/pdf'):
                $type = 'pdf';
                break;
            case ('image/jpeg'):
            case ('image/png'):
                $type = 'image';
                break;
            case ('application/vnd.openxmlformats-officedocument.wordprocessingml.document'):
            case ('application/msword'):
                $type = 'doc';
                break;
            case ('application/vnd.openxmlformats-officedocument.presentationml.presentation'):
            case ('application/vnd.ms-powerpoint'):
                $type = 'ppt';
                break;
        }
        $path = $file->store('upload', 'public');
        File::create([
            'publ_id' => $typeFile === 'publication' ? $work_id : 0,
            'url' => $path,
            'type' => $type,
            'work_id' => $typeFile === 'competition' ? $work_id : 0,
        ]);
    }
}
