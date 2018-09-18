<?php

namespace App\Transformers;

use App\Models\Member;
use App\Models\Product;
use App\Models\Spec;
use League\Fractal\TransformerAbstract;

class MemberTransformer extends TransformerAbstract
{
    protected  $availableIncludes = ['cars'];

    public function transform(Member $member)
    {
        return [
            'id' => $member->id,
            'name' => $member->name,
            'phone' => $member->phone,
            'idnumber' => $member->idnumber,
            'address' => $member->address,
            'remark' => $member->remark,
        ];
    }

    public function includeCars(Member $member)
    {
        return $this->collection($member->cars, new CarTransformer());
    }

}