<?php

namespace App\Http\Controllers;

use App\Transaction;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TransactionController extends Controller
{

    /*
     * infoTransaction содержит
     * coins - кол-во бонусов которое мы списываем
     * user_id - id пользователя который совершает транзакцию
     * type - тип транзакции
     *  0 - списание бонусов
     *  1 - зачисление бонусов
    */
    public function transferCoins(array $infoTransaction)
    {
        $transfer = Transaction::create([
            'user_id' => $infoTransaction['user_id'],
            'type' => $infoTransaction['type'],
            'value' => $infoTransaction['coins'],
            'date' => date('Y-m-d H:i:s'),
        ]);
        if ($transfer) {
            switch ($infoTransaction['type']) {
                case '0':
                    $coins = User::where('id', $infoTransaction['user_id'])->pluck('coins')->first();
                    $coins -= $infoTransaction['coins'];
                    User::where('id', $infoTransaction['user_id'])->update(['coins' => $coins]);
                    break;
            }
        } else {
            return false;
        }
    }

   
}
