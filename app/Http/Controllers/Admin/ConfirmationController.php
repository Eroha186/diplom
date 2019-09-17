<?php

namespace App\Http\Controllers\Admin;

use App\Publication;
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
    public function confirmation($id, $result, $page) {
        if($result == 1 && $page == 'publication') {
            Publication::where('id', $id)->update([
               'moderation' => 2,
            ]);
        } elseif ($result == 0 && $page == 'publication') {
            Publication::where('id', $id)->update([
                'moderation' => 1,
            ]);
        }
        if($page == 'publication') {
            return redirect(route('a-publication'));
        } elseif($page == 'competition') {
            return redirect(route('a-competition'));
        }
    }
}
