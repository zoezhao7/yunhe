<?php

namespace App\Http\Controllers\Api\v1;

use App\Models\Commission;
use Illuminate\Http\Request;

class CommissionsController extends Controller
{
    public function calculate()
    {
        $employee = \Auth::guard('api')->user();

        $moneys = Commission::calculate('2018-09', $employee);

        return $this->response->noContent();
    }

    public function index()
    {
        $employee = \Auth::guard('api')->user();

        $commissions = $employee->commissions()->get();

        return $this->response->collection($commissions, new Commission());
    }
}
