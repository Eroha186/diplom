<?php

namespace App\Http\Controllers\Reward;

use App\Http\Requests\SubstratesForm;
use App\Substrate;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class SubstrateController extends Controller
{
    public function addSubstrate(SubstratesForm $request) {
        $request->url = $request->file('substrate-file')->store('substrates', 'public');
        $substrite = Substrate::create([
            'name' => $request->name,
            'url' => $request->url,
        ]);
        return redirect(route('a-competitions'));
    }

    public function viewSubstrate(Request $request) {
        $idSubstrate = $request->val;
        $url = Substrate::select('url')->where('id', $idSubstrate)->get();
        return response()->json(['url' => $url], 200);
    }
}
