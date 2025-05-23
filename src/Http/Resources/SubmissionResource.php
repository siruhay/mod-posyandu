<?php

namespace Module\Posyandu\Http\Resources;

use Module\Posyandu\Models\PosyanduSubmission;
use Illuminate\Http\Resources\Json\JsonResource;

class SubmissionResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return PosyanduSubmission::mapResource($request, $this);
    }
}
