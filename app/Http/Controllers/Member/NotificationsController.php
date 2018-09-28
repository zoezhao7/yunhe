<?php

namespace App\Http\Controllers\Member;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class NotificationsController extends Controller
{
    public function index(Request $request)
    {
        dd('this is notifications index page');
    }
}
