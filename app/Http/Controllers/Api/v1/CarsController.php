<?php

namespace App\Http\Controllers\Api\v1;

use App\Http\Requests\Api\CarRequest;
use App\Models\Car;
use App\Models\Member;
use App\Transformers\CarTransformer;
use Illuminate\Http\Request;

class CarsController extends Controller
{

    public function show(Car $car)
    {
        if(!$car->belongsToAuthorizer()) {
            return $this->response->errorMethodNotAllowed('该车辆不属于您的客户，禁止操作！');
        }

        return $this->response->item($car, new CarTransformer());
    }

    public function update(CarRequest $request, Car $car)
    {
        if(!$car->belongsToAuthorizer()) {
            return $this->response->errorMethodNotAllowed('该车辆不属于您的客户，禁止操作！');
        }

        // 禁止变更车辆主人
        $data = $request->all();
        unset($data['member_id']);

        $car->fill($data);
        $car->save();

        return $this->response->item($car, new CarTransformer());
    }

    public function store(CarRequest $request, Car $car)
    {
        $member = Member::find($request->member_id);
        if(!$member->belongsToAuthorizer()) {
            return $this->response->errorMethodNotAllowed('车辆主人不是您的客户，请重新操作！');
        }

        $car->fill($request->all());
        $car->save();

        return $this->response->created();
    }

    public function destroy(Car $car)
    {
        $car->delete();

        return $this->response->noContent();
    }

}
