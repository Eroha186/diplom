<?php

namespace App\Http\Controllers;

use App\Competition;
use App\Publication;
use App\Diplom;
use App\Work;
use App\ExpressWork;
use App\User;
use App\QuerySearch;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SearchController extends Controller
{
    private $relevant = 40;

    public function search($str, array $modelArray = [])
    {
        if (count($modelArray) == 0) {
            return false;
        }
        $model = 0;
        if (isset($modelArray['publication'])) {
            $model = $modelArray['publication'];
            QuerySearch::insert([
                'query' => $str,
            ]);
        }
        if (isset($modelArray['competition'])) {
            $model = $modelArray['competition'];
        }
        if (empty($str)) {
            return $model;
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
        $q = "*, (" . implode(' + ', $q) . ") AS `relevant`";
        $res = $model->select(DB::raw($q));
        $res->having('relevant', '>', round(mb_strlen(implode($trueWords)) * ($this->relevant / 100)))
            ->orderByDesc('relevant');
        return [
            'model' => $res,
            'query' => $q
        ];
    }

    private function cropWords($word)
    {
        $reg = "/(ый|ой|ая|ое|ые|ому|ему|а|о|у|е|ы|и|я|ого|ство|ых|ох|ия|ий|ь|он|ют|ат|ья)$/i"; //А если в середине слова?!?!
        $word = preg_replace($reg, '', $word);
        return $word;
    }

    public function searchDiplom(Request $request)
    {
        $query = $request->get('query');
        if (ctype_digit($query)) {
            $diplom = Diplom::where('id', $query)->first();
            if(count($diplom) > 0) {
                switch ($diplom->type) {
                    case "publication":
                        $diplom->work = Publication::with('author')->where('id', $diplom->work_id)->first();
                        break;
                    case "competition":
                        $diplom->work = Work::with('user')->where('id', $diplom->work_id)->first();
                        break;
                    case "e-competition":
                        $diplom->work = ExpressWork::with('user')->where('id', $diplom->work_id)->first();
                        break;
                }
                return $diplom;
            }
            return "Нет таких дипломов";
        }
        $user = User::where('f', $query)->get();
    }
}
