<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class OrderResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'money' => $this->money,
            'crated_at' => (string) $this->created_at,
            'status' => $this->satus,
            'product' => $this->product,
        ];
    }
}
