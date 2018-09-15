<?php

namespace App\Transformers;

use App\Models\Store;
use League\Fractal\TransformerAbstract;

class StoreTransformer extends TransformerAbstract
{
    protected  $availableIncludes = ['employees'];

    public function transform(Store $store)
    {
        return [
            'id' => $store->id,
            'name' => $store->name,
            'phone' => $store->phone,
            'address' => $store->address,
            'status' => $store->status == 1 ? '营业' : '未营业',
        ];
    }

    public function includeEmployees(Store $store)
    {
        return $this->collection($store->employees(), new EmployeeTransformer());
    }

}