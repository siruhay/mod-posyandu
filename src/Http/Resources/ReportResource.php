<?php

namespace Module\Posyandu\Http\Resources;

use Module\Posyandu\Models\PosyanduReport;
use Illuminate\Http\Resources\Json\JsonResource;

class ReportResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return PosyanduReport::mapResource($request, $this);
    }
}
