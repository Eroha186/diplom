<?php

namespace App\Http\Controllers;

use App\Diplom;
use Illuminate\Http\Request;

class PaymentController extends Controller
{
    public function payment(Request $request)
    {
        if($request->get('paymentStatus') == 5) {
            $id = $request->get('orderId');
            Diplom::where('id', $id)->update([
                'payment' => 1
            ]);
        }

        return response('OK', 200);
    }
}
