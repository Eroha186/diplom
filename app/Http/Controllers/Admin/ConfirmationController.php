<?php

namespace App\Http\Controllers\Admin;

use App\Publication;
use App\Work;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ConfirmationController extends Controller
{
    /*
    result - это флаг, который говорит подтвердить\отклонить
    0 - отколнить
    1 - подтвердить
    id - это id записи которую подтверждает
    page - страница с которой идет запрос
*/
    public function confirmation($id, $result, $page, $competitionId = 0) {
        if($result == 1 && $page == 'publication') {
            Publication::where('id', $id)->update([
               'moderation' => 2,
            ]);
            return redirect(route('a-publication'));
        } elseif ($result == 0 && $page == 'publication') {
            Publication::where('id', $id)->update([
                'moderation' => 1,
            ]);
            return redirect(route('a-publication'));
        }
        if($result == 1 && $page == 'competition') {
            Work::where('id', $id)->update([
                'moderation' => 2,
            ]);
            return redirect(route('a-competition', ['id' => $competitionId]));
        } elseif ($result == 0 && $page == 'competition') {
            Work::where('id', $id)->update([
                'moderation' => 1,
            ]);
            return redirect(route('a-competition', ['id' => $competitionId]));
        }
    }
}
