<?php

namespace App\Http\Controllers\Api\v1;

use App\Http\Resources\MemberResource;
use Illuminate\Http\Request;
use App\Models\Member;

class MembersController extends Controller
{
    public function index(Request $request)
    {
        $employee = \Auth::guard('api')->user();
        $members = Member::where('employee_id', $employee->id)
            ->select('id', 'name', 'phone', 'letter')->get()->toArray();

        foreach ($members as $member) {
            $member_arr[$member['letter']][] = $member;
        }

        return $this->response->array([
            'members' => $member_arr,
        ]);
    }
}
