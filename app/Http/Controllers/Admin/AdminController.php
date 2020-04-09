<?php

namespace App\Http\Controllers\Admin;


use App\Repositories\UserRepository;

trait AdminController
{
    function user()
    {
        return (new UserRepository())->getUserAuth();
    }
}
