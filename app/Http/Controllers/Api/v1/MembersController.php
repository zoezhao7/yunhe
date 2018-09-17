<?php

namespace App\Http\Controllers\Api\v1;

use App\Http\Requests\Api\MemberRequest;
use App\Http\Resources\MemberResource;
use App\Models\Car;
use App\Transformers\MemberTransformer;
use Illuminate\Http\Request;
use App\Models\Member;

class MembersController extends Controller
{
    public function index(Request $request)
    {
        $employee = \Auth::guard('api')->user();
        $members = Member::where('employee_id', $employee->id)
            ->select('id', 'name', 'phone', 'letter', 'idnumber', 'address')
            ->get()
            ->toArray();

        foreach ($members as $member) {
            $member_arr[$member['letter']][] = $member;
        }

        ksort($member_arr);

        return $this->response->array([
            'members' => $member_arr,
        ]);
    }

    public function show(Member $member)
    {
        if(!$member->belongsToAuthorizer()) {
            return $this->response->errorMethodNotAllowed('客户不属于您！');
        }

        return $this->response->item($member, new MemberTransformer());
    }

    public function store(MemberRequest $request, Member $member)
    {
        $employee = \Auth::guard('api')->user();
        $member->fill($request->all());
        $member->employee_id = $employee->id;
        $member->save();

        if($request->has('car_ids') && !empty($request->car_ids)) {
            \DB::table('cars')
                ->whereIn('id', $request->car_ids)
                ->where('member_id', 0)
                ->update(['member_id' => $member->id]);
        }

        return $this->response->created();
    }

    public function update(MemberRequest $request, Member $member)
    {
        $member->fill($request->all());
        $member->save();

        if($car_ids = json_decode($request->car_ids, true)) {
            \DB::table('cars')->whereIn('id', $car_ids)->where('member_id', 0)->update(['member_id' => $member->id]);
        }

        return $this->response->noContent();
    }
}
