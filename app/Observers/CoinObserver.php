<?php

namespace App\Observers;

use App\Models\Coin;

// creating, created, updating, updated, saving,
// saved,  deleting, deleted, restoring, restored

class CoinObserver
{
    public function creating(Coin $coin)
    {
        //
    }

    public function created(Coin $coin)
    {
        // 添加消息记录
        $member = $coin->member;
        $member->notify(new CoinChanged($coin));
        $member->increment('notification_count');
    }

    public function updating(Coin $coin)
    {
        //
    }
}