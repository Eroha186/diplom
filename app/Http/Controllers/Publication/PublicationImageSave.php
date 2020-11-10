<?php

namespace App\Http\Controllers\Publication;

use App\File;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Intervention\Image\Facades\Image;

class PublicationImageSave extends Controller
{
	public function publicationImageSave(Request $request) {
		$path = $request->file('image')->store('upload', 'public');
		$new_path = storage_path().'/app/public/'.$path;
		
		$resize = Image::make($new_path)->resize(env('IMAGE_WIDTH'), env('IMAGE_HEIGHT'), function ($constraint) {
			$constraint->aspectRatio();
			$constraint->upsize();
		})->save($new_path);

		$file = File::create([
			'publ_id' => 0,
			'url' => $path,
			'type' => 'image',
			'work_id' => 0,
		]);

		
		$id = json_decode($file->id);

		$response = [];
		$response['id'] = $id;
		$response['path'] = $path;
		return $response;

	}
}
