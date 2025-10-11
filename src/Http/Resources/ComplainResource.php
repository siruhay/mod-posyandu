<?php

namespace Module\Posyandu\Http\Resources;

use Module\Posyandu\Models\PosyanduComplain;
use Illuminate\Http\Resources\Json\JsonResource;

class ComplainResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return PosyanduComplain::mapResource($request, $this);
    }
}
