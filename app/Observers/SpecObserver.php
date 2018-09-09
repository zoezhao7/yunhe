<?php

namespace App\Observers;

use App\Models\Spec;
use App\Models\Product;

// creating, created, updating, updated, saving,
// saved,  deleting, deleted, restoring, restored

class SpecObserver
{

    public function deleting(Spec $spec)
    {
        denied('该产品规格已存在订单， 不允许删除！');
    }
}