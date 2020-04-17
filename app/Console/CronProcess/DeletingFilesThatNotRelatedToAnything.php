<?php


namespace App\Console\CronProcess;


use App\File;
use Carbon\Carbon;
use Illuminate\Support\Facades\Storage;

class DeletingFilesThatNotRelatedToAnything
{
    static public function deleteFiles()
    {
        $files = File::where([
            ['work_id', 0],
            ['publ_id', 0],
            ['updated_at', '<=', Carbon::now()->subHour(12)]
        ])->get();
        $disk = Storage::disk('public');
        foreach($files as $file) {
            $disk->delete($file->url);
            File::where('id', $file->id)->delete();
        }
    }
}