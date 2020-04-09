<?php

namespace App\Http\Controllers\Admin;

use App\Publication;
use App\Repositories\PublicationRepository;
use App\Repositories\UserRepository;
use App\Substrate;
use App\User;
use App\Theme;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class PublicationController extends Controller
{
    public function __construct()
    {
        $this->publicationRepository = new PublicationRepository();
        $this->userRepository = new UserRepository();
    }


    public function show()
    {
        return view('admin.publications', [
            'user' => $this->userRepository->getUserAuth(),
            'publications' => $this->publicationRepository->getAllNotConfirmedPublications(),
            'themes' => Theme::all(),
            'substrates' => Substrate::all()
        ]);
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
