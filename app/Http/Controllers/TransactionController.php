<?php

namespace App\Http\Controllers;

use App\Repositories\UserRepository;
use App\Transaction;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TransactionController extends Controller
{
    public function __construct()
    {
        $this->userRepository = new UserRepository();
    }


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
        if ($this->validationTransfer($infoTransaction)) {
            $transaction = $this->createTransaction($infoTransaction);
            $this->writeDownsCoins($transaction);
        } else {
            return false;
        }
    }

    protected function validationTransfer(array $transfer)
    {
        $user = $this->userRepository->getUserAuth();

        if ($user->coins >= $transfer['value'] && $transfer['value'] <= ceil($transfer['price'] * 0.5)) {
            return true;
        }

        return false;
    }

    protected function writeDownsCoins($transaction) {
        switch ($transaction->type) {
            case '0':
                $coins = $this->userRepository->getUserAuth()->coins;
                $coins -= $transaction->coins;
                $this->userRepository->updateCoinsAuthUser($coins);
                break;
        }
    }

    protected function createTransaction($infoTransaction) {
        return Transaction::create([
            'user_id' => $infoTransaction['user_id'],
            'type' => $infoTransaction['type'],
            'value' => $infoTransaction['coins'],
            'date' => date('Y-m-d H:i:s', time()),
        ]);
    }
}
