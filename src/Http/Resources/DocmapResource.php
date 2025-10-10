<?php

namespace Module\Posyandu\Http\Resources;

use Module\Posyandu\Models\PosyanduDocmap;
use Illuminate\Http\Resources\Json\JsonResource;

class DocmapResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return PosyanduDocmap::mapResource($request, $this);
    }
}
