<?php


namespace App\Http\Controllers\Account;


use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Controller;
use App\Http\Requests\UpdatePersonalData;
use App\Repositories\UserRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class PersonalDataController extends Controller
{
    public function __construct()
    {
        $this->userRepository = new UserRepository();
    }

    public function show()
    {
        return view('account/personal-data', [
            'data' => $this->userRepository->getUserAuth(),
        ]);
    }

    public function update(Request $request)
    {
        $this->validator($request->all())->validate();

        if ($request->get('email') !== Auth::user()->email) {

            $this->userRepository->updatePersonalDataWithChangeEmail($request->all());

            (new RegisterController())->verifyCreate($this->userRepository->getUserAuth());
            Auth::guard()->logout();

            return redirect('/login')->with('status', 'Мы отправили вам код активации. Проверьте свою электронную почту и нажмите на ссылку, чтобы подтвердить.');
        }

        $this->userRepository->updatePersonalDataWithoutChangingEmail($request->all());

        return $this->show();
    }

    protected function validator(array $data)
    {
        $validate = [
            'f' => 'required|string|max:30',
            'i' => 'required|string|max:30',
            'o' => 'required|string|max:30',
            'town' => 'required|string',
            'job' => 'required|string',
            'stuff' => 'required|string',
        ];
        if ($data['email'] !== Auth::user()->email) {
            $validate['email'] = 'required|email|max:60|unique:users';
        }

        return Validator::make($data, $validate);
    }
}