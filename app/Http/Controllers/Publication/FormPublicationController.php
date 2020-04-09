<?php

namespace App\Http\Controllers\Publication;

use App\Education;
use App\Http\Controllers\Auth\RandomPassword;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\TransactionController;
use App\Http\Controllers\UploadFileController;
use App\Http\Requests\FormPublicationRequest;
use App\Kind;
use App\Repositories\DiplomRepository;
use App\Repositories\PublicationRepository;
use App\Repositories\UserRepository;
use App\Theme;
use App\Type;
use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class FormPublicationController extends Controller
{
    public function __construct()
    {
        $this->userRepository = new UserRepository();
        $this->publicationRepository = new PublicationRepository();
        $this->diplomRepository = new DiplomRepository();
        $this->cash = config('payment_config.cash');
    }


    /**
     * Отображение формы для добавления публикации.
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function show()
    {
        $types = Type::all();
        $kinds = Kind::all();
        $themes = Theme::orderBy('name', 'ASC')->get();
        $educations = Education::all();

        if (Auth::check()) {
            $data = [
                'user' => $this->userRepository->getUserAuth(),
                'types' => $types,
                'kinds' => $kinds,
                'themes' => $themes,
                'educations' => $educations,
                'cash' => $this->cash,
            ];
        } else {
            $data = [
                'types' => $types,
                'kinds' => $kinds,
                'themes' => $themes,
                'educations' => $educations,
                'cash' => $this->cash,
            ];
        }
        return view('publication/form-publication', $data);
    }


    /**
     * Сохранение публикации.
     *
     * @param FormPublicationRequest $formRequest
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector|\Illuminate\View\View
     */
    public function save(FormPublicationRequest $formRequest)
    {
        $data = $formRequest->all();

        if(Auth::check()) {
            $data['user_id'] = Auth::user()->id;
        } else {
            $pass = RandomPassword::randomPassword();
            $formRequest['password'] = $pass;
            $formRequest['password_confirmation'] = $pass;
            $data['user_id'] = (new RegisterController())->registerFromPublicationForm($formRequest)->id;
        }

        $publication = $this->publicationRepository->createPublication($data);

        if(isset($data['distribution']) && $data['distribution'] == 'on') {
            $this->userRepository->subscribeMailing($data['user_id']);
        }

        foreach ($formRequest->file('files') as $file) {
            UploadFileController::uploadFile($file, $publication->id, 'publication');
        }

        if ($formRequest['placement-method']) {
            if($formRequest['uses-coins']) {
                (new TransactionController())->transferCoins([
                    'coins' => $formRequest['coins'],
                    'user_id' => $data['user_id'],
                    'type' => 0,
                ]);
            }

            $diplom = $this->diplomRepository->create($publication->id, $publication);

            $post_data = [
                'userName' => $data['f'] . " " . $data['i'] . " " . $data['o'],
                'user_email' => $data['email'],
                'recipientAmount' => $data['cash'],
                'orderId' => $diplom->id,
            ];

            return view('payment', ['post_data' => $post_data]);
        }

        return redirect(route('home'));
    }


    /**
     * Ajax подгрузка видов работы в зависимости от выбранного ур-ня образование.
     *
     * @param $education_id
     * @return mixed
     */
    public function ajaxLoadKinds($education_id)
    {
        $condition = $education_id != 0 ? ['education_id', $education_id] : [];
        return $education_id == 0 ?
            Kind::all()           :
            Kind::where('education_id', $education_id)->get()->toArray();
    }

    /**
     * Ajax подгрузка максимального кол-во символов для полного текста работы.
     *
     * @param $type_id
     * @return
     */
    public function ajaxLoadNumberSymbolsInRelationOnType($type_id)
    {
        return Type::where('id', $type_id)->first();
    }
}