<?php

namespace App\Http\Controllers;

use App\File;
use App\Http\Requests\FileUploadRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class UploadFileController extends Controller
{
    public function uploadFile($file, $typeFile, $work_id = 0)
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
        return File::create([
            'publ_id' => $typeFile === 'publication' ? $work_id : 0,
            'url' => $path,
            'type' => $type,
            'work_id' => $typeFile === 'competition' ? $work_id : 0,
        ]);
    }

    public function uploaderPublication(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'file' => 'required|mimes:jpg,png,doc,docx,pdf,ppt,pptx'
        ]);

        if($validator->passes())
        {
            $fileUpload = $this->uploadFile($request->file('file'), 'publication');

            return $fileUpload->id;
        }
        return response()->json(['errors' => $validator->errors()->all()]);
    }

    public function attachPublicationIdForFile($file, $publicationId)
    {
        $fileModel = File::where('id', '=', $file)->first();
        $fileModel->publ_id = $publicationId;
        $fileModel->save();
    }
}
