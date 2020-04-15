<?php


namespace App\Console\CronProcess;


use App\File;
use Carbon\Carbon;

class DeletingFilesThatNotRelatedToAnything
{
    static public function deleteFiles()
    {
        File::where([
            ['work_id', 0],
            ['publication_id', 0],
            ['updated_at', '<=', Carbon::now()->subHour(12)]
        ])->delete();
    }
}