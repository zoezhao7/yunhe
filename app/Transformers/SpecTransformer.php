<?php

namespace App\Transformers;

use App\Models\Product;
use App\Models\Spec;
use League\Fractal\TransformerAbstract;
use phpDocumentor\Reflection\DocBlock\Tags\Formatter\PassthroughFormatter;

class SpecTransformer extends TransformerAbstract
{
    protected  $availableIncludes = ['product'];

    public function transform(Spec $spec)
    {
        return [
            'id' => $spec->id,
            'size' => $spec->size,
            'number' => $spec->idnumber,
            'price' => $spec->price,
            'discount' => $spec->discount>0 ? $spec->discount . '%' : '无',
            'content' => $spec->content,
        ];
    }

    public function includeProduct(Spec $spec)
    {
        return $this->item($spec->product, new ProductTransformer());
    }
}