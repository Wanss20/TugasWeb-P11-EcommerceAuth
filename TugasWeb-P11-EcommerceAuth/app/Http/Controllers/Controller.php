<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

abstract class Controller
{
    // biar bisa pakai $this->authorize() di controller
    use AuthorizesRequests;
}
