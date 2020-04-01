<?php

namespace App\Http\Controllers\Reward;

use App\Http\Requests\SubstratesForm;
use App\Substrate;
use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class SubstrateController extends Controller
{
    public function show() {
        $user = User::where('id', Auth::user()->id)->first();
        return view('admin/substrate', [
            'user' => $user
        ]);
    }

    public function addSubstrate(SubstratesForm $request)
    {
        $request->url = $request->file('substrate-file')->store('substrates', 'public');
        $substrite = Substrate::create([
            'name' => $request->name,
            'url' => $request->url,
        ]);
        return redirect(route('a-competitions'));
    }

    public function viewSubstrate(Request $request)
    {
        return response()->json(['url' => $this->getSubstrate($request->val)], 200);
    }

    public function publicationSubstrate(Request $request)
    {
        Substrate::where('active_for_publ', true)->update([
            'active_for_publ' => false
        ]);
        Substrate::where('id', $request->substrate)->update([
            'active_for_publ' => true
        ]);

        return redirect()->back();
    }

    public function getSubstrate($val)
    {
        return Substrate::select('url')->where('id', $val)->get();

    }
}
