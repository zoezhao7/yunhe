<?php

namespace App\Http\Controllers\Member;

use App\Http\Requests\MemberRequest;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CoinsController extends Controller
{
    public function index(Request $request)
    {
        dd('this is coins index page');
    }
}
