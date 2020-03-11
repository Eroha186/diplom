<?php

namespace App\Http\Controllers\Admin;

use App\Jobs\SendEmail;
use App\MlTemplateBlock;
use App\MlTemplate;
use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;

class MailingController extends Controller
{

    protected function user()
    {
        return User::where('id', Auth::user()->id)->first();
    }

    public function show() {
        return view('admin.mailing', [
            'templates' => $this->getAllTemplateMail(),
            'user' => $this->user(),
        ]);
    }

    public function getAllTemplateMail() {
        $templates = MlTemplate::all();
        return $templates;
    }

    public function getTemplateBlocks($id) {
        $id != 0
            ? $blocks = MlTemplate::find($id)->templateBlocks
            : $blocks = [];

        return $blocks;
    }

    public function loadTemplate() {
        $id = \request()->get('val');

        $template = $this->getTemplateBlocks($id);

        return $template;
    }

    public function sendMail($idTemplate) {
        $users = User::where('mailing', 1)->get();
        foreach ($users as $user) {
            Mail::to($user->email)
                ->queue(new SendEmail());
        }
    }

    public function renderMail($idTemplate) {
        $blocks = $this->getTemplateBlocks($idTemplate);
        foreach ($blocks as $block) {

        }
    }
}
