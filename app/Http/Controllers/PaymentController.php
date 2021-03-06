<?php

namespace App\Http\Controllers;

use App\Diplom;
use App\ExpressWork;
use App\Publication;
use App\Work;
use Illuminate\Http\Request;

class PaymentController extends Controller
{
    public function __construct()
    {
        $this->cash = config('payment_config.cash');
    }

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
                $work = Work::with('user')->where('id', $workId)->get()->first();
                break;
            case("publication"):
                $work = Publication::with('user')->where('id', $workId)->get()->first();
                break;
            case("expressWork"):
                $work = ExpressWork::with('user')->where('id', $workId)->get()->first();
                break;
        }
        $diplom = Diplom::where([['work_id', $workId], ['type', $type]])->first();
        if(is_null($diplom)) {
            $diplom = Diplom::create([
                'work_id' => $work->id,
                'type' => $type,
            ]);
        }
        $post_data = [
            'userName' => $work->user->f . " " . $work->user->i . " " . $work->user->o,
            'user_email' => $work->user->email,
            'recipientAmount' => $this->cash,
            'orderId' => $diplom->id,
        ];
        return view('payment', ['post_data' => $post_data]);
    }
}
