<?php

namespace Module\Posyandu\Http\Resources;

use Module\Posyandu\Models\PosyanduBeneficiary;
use Illuminate\Http\Resources\Json\JsonResource;

class BeneficiaryResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return PosyanduBeneficiary::mapResource($request, $this);
    }
}
