<?php

namespace App\Observers;

use App\Models\Member;
use Dingo\Api\Routing\Helpers;

// creating, created, updating, updated, saving,
// saved,  deleting, deleted, restoring, restored

class MemberObserver
{
    use Helpers;

    public function saving(Member $member)
    {
        $member->letter = strtoupper(substr(pinyin_abbr($member->name), 0, 1));

        if($member->coin_count < 0) {
            denied('客户积分不能小于0！');
        }
    }

    public function deleting(Member $member)
    {
        if($member->hasOrder()) {
            if(request()->ajax() || request()->wantsJson() || request()->isJson()) {
                return $this->response->errorForbidden('客户名下有订单，禁止删除！');
            } else {
                denied('客户名下有订单，禁止删除！');
            }
        }
    }
}