<?php

namespace Module\Posyandu\Http\Resources;

use Module\Posyandu\Models\PosyanduDocument;
use Illuminate\Http\Resources\Json\JsonResource;

class DocumentResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return PosyanduDocument::mapResource($request, $this);
    }
}
