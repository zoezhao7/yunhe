<?php

namespace App\Observers;

use App\Models\Store;

// creating, created, updating, updated, saving,
// saved,  deleting, deleted, restoring, restored

class StoreObserver
{
    public function deleting(Store $store)
    {
        if($store->hasEmployee())
        {
            denied('门店下存在员工，禁止删除！');
        }
    }
}