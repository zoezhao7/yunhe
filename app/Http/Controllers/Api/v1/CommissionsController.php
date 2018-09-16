<?php

namespace App\Http\Controllers\Api\v1;

use App\Models\Commission;
use App\Transformers\CommissionTransformer;
use Illuminate\Http\Request;

class CommissionsController extends Controller
{
    public function calculate()
    {
        $employee = \Auth::guard('api')->user();

        $moneys = Commission::calculate('2018-09', $employee);

        return $this->response->noContent();
    }

    public function index(Request $request)
    {
        $employee = \Auth::guard('api')->user();

        $query = $employee->commissions();

        if($request->has('month')) {
            $query->where('month', '=', (string) $request->month);
        }

        $commissions = $query->get();

        return $this->response->collection($commissions, new CommissionTransformer());
    }
}
