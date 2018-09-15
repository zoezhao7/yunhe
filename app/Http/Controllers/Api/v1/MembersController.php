<?php

namespace App\Http\Controllers\Api\v1;

use App\Http\Resources\MemberResource;
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
}
