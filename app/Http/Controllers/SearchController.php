<?php

namespace App\Http\Controllers;

use App\Competition;
use App\Publication;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SearchController extends Controller
{
    private $relevant = 40;

    public function search($str, Publication $publication = null, Competition $competition = null)
    {
        if ($publication === null && $competition === null) {
            return false;
        }
        $field = 0;
        $model = 0;
        if (!($publication === null)) {
            $model = $publication;
            $field = [
                'author',
                'type',
                'education',
                'theme',
                'kind',
                'files',
            ];
        }
        if (!($competition === null)) {
            $model = $competition;
        }
        $words = explode(" ", trim(preg_replace("/\s(\S{1,2})\s/", " ", preg_replace("/ +/i", " ", "$str"))));
        $trueWords = Array();
        if (count($words)) {
            foreach ($words as $word) {
                if (mb_strlen($word, 'UTF-8') > 3)
                    $word = $this->cropWords($word);
                $trueWords[] = addcslashes(addslashes($word), '%_');
            }
        } else {
            return array();
        }
        $trueWords = array_unique($trueWords);
        if (!count($trueWords)) {
            return array();
        }
        $q = array();
        foreach ($trueWords as $word) {
            $q[] = "IF(`title` LIKE '%" . addslashes($word) . "%'," . mb_strlen($word, 'UTF-8') . ",0)";
        }
        if ($field) {
            $model = $model->with($field);
        }
        $q = "*, (" . implode(' + ', $q) . ") AS `relevant`";
        $res = $model->select(DB::raw($q));
        if ($field) {
            $res = $res->where('moderation', 2);
        }
        $res->having('relevant', '>', round(mb_strlen(implode($trueWords)) * ($this->relevant / 100)))
            ->orderByDesc('relevant');
        return $res->get();
    }

    public function cropWords($word)
    {
        $reg = "/(ый|ой|ая|ое|ые|ому|ему|а|о|у|е|ы|и|я|ого|ство|ых|ох|ия|ий|ь|он|ют|ат|ья)$/i"; //А если в середине слова?!?!
        $word = preg_replace($reg, '', $word);
        return $word;
    }
}
