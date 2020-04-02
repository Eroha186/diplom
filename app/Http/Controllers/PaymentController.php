<?php

namespace App\Http\Controllers;

use App\Diplom;
use App\ExpressWork;
use App\Publication;
use App\Work;
use Illuminate\Http\Request;

class PaymentController extends Controller
{
    public function payment(Request $request)
    {
        if ($request->get('paymentStatus') == 5) {
            $id = $request->get('orderId');
            Diplom::where('id', $id)->update([
                'payment' => 1
            ]);
        }

        return response('OK', 200);
    }

    public function paymentFromAccount($workId, $type)
    {
        $work = [];
        switch ($type) {
            case("work"):
                $work = Work::with('user')->where('id', $workId)->get()[0];
                break;
            case("publication"):
                $work = Publication::with('user')->where('id', $workId)->get()[0];
                break;
            case("expressWork"):
                $work = ExpressWork::with('user')->where('id', $workId)->get()[0];
                break;
        }
        $diplom = Diplom::where([['work_id', $workId], ['type', $type]])->first();
        if(count($diplom->toArray()) == 0) {
            $diplom = Diplom::create([
                'work_id' => $work->id,
                'type' => $type,
            ]);
        }
        $post_data = [
            'userName' => $work->user->f . " " . $work->user->i . " " . $work->user->o,
            'user_email' => $work->user->email,
            'recipientAmount' => "100",
            'orderId' => $diplom->id,
        ];
        return view('payment', ['post_data' => $post_data]);
    }
}
