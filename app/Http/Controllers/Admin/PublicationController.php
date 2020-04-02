<?php

namespace App\Http\Controllers\Admin;

use App\Publication;
use App\Substrate;
use App\User;
use App\Theme;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class PublicationController extends Controller
{
    public function show(Request $request)
    {
        $user = User::where('id', Auth::user()->id)->first();
        $themes = Theme::all();
        $publications = Publication::with('user')->where('moderation', 0)->paginate(5);
        foreach ($publications as $publication) {
            $publication['date_add'] = date("d.m.Y", strtotime($publication['date_add']));
            $publication['user']['i'] = mb_substr($publication['user']['i'], 0, 1);
            $publication['user']['o'] = mb_substr($publication['user']['o'], 0, 1);
            foreach ($publication['files'] as $file) {
                if ($file['type'] == 'doc') {
                    $publication['doc'] = 1;
                }
                if ($file['type'] == 'ppt') {
                    $publication['ppt'] = 1;
                }
            }
        }
        return view('admin.publications', [
            'user' => $user,
            'publications' => $publications,
            'themes' => $themes,
            'substrates' => Substrate::all()
        ]);
    }

    public function formationSnippetForkNewPublication($publicationModel)
    {

        $publications = $publicationModel::with($this->field)->where('moderation', 1)->orderBy('date_add', 'desc')->limit(7)->get();
        foreach ($publications as $publication) {
            $publication['date_add'] = date("d.m.Y", strtotime($publication['date_add']));
            $publication['user']['i'] = mb_substr($publication['user']['i'], 0, 1);
            $publication['user']['o'] = mb_substr($publication['user']['o'], 0, 1);
            $publication['file'] = $publication['files'][0]['type'];
        }

        return $publications;
    }

    /*
        $mode аргумент который говорит о том дейтсвии которое будет совершаться добавление/удаление/редактирование
    */
    public function changeThemes(Request $request, $mode) {
        $themes = $request->all();
        $themes_old = [];
        switch ($mode) {
            case 'add':
                $themes1 = Theme::all();
                foreach ($themes1 as $theme) {
                    $themes_old[] = $theme->name;
                }
                $themes = preg_split('/\\r\\n?|\\n/', $themes['data']);
                $themes = array_unique($themes);
                // удаляем пустые элементы массива, потом удалеям темы которые есть и в массиве и в БД
                $themes = array_diff(array_diff($themes,array('')), $themes_old);
                foreach ($themes as $theme) {
                    Theme::create([
                       'name' => trim($theme)
                    ]);
                }
                break;
            case 'del':
                Theme::where('id', $themes['id'])->delete();
                break;
            case 'change':
                Theme::where('id', $themes['id'])->update([
                    'name' => $themes['val'],
                ]);
                break;
        }
        $themes = Theme::all();
        return $themes;
    }
}
