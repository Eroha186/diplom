<?php

namespace App\Http\Controllers\Admin;

use App\Job;
use App\Jobs\SendEmail;
use App\Mailing;
use App\MlTemplateBlock;
use App\MlTemplate;
use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Queue;

class MailingController extends Controller
{

    protected function user()
    {
        return User::where('id', Auth::user()->id)->first();
    }

    public function show() {
        $newMailing = Queue::size('default') <= 1 ? true : false;
        return view('admin.mailing', [
            'templates' => $this->getAllTemplateMail(),
            'user' => $this->user(),
            'items' => Mailing::all(),
            'newMailing' => $newMailing
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

    public function sendMail(Request $request) {
        $users = User::where('mailing', 1)->get();
        $content = $this->renderMail($request->get('template'));
        $idMailing = Mailing::create([
            'theme' => $request->get('theme'),
            'template_id' => $request->get('template'),
            'all_mail' => count($users),
            'number_mail' => 0,
            'status' => 1
        ])->id;

        foreach ($users as $user) {
           $this->dispatch(new SendEmail($user, $content, $idMailing));
        }

        return redirect()->back();
    }

    public function renderMail($idTemplate) {
        $blocks = $this->getTemplateBlocks($idTemplate);
        $layout = '';
        foreach ($blocks as $block) {
            $layout .= implode("", explode('contenteditable="true"',$block->content));
        }
        return $layout;
    }

    public function progressMailing()
    {
        $lastMailing = Mailing::select(['id', 'all_mail', 'number_mail'])->orderBy('id', 'desc')->first();
        return [
            'all' => $lastMailing->all_mail,
            'now' => $lastMailing->number_mail,
        ];
    }

    public function endMailing() {
        $mails = Job::select(['*'])->delete();
        Mailing::orderBy('id', 'desc')->first()->update(['status' => 3]);
        return redirect()->back();
    }
}
